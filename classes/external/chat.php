<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * @package     local_geniai
 * @copyright   2024 Eduardo Kraus https://eduardokraus.com/
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @Date        31/01/2024 20:35
 */

namespace local_geniai\external;

use external_api;
use external_value;
use external_single_structure;
use external_function_parameters;

class chat extends external_api {
    /**
     * Parâmetros recebidos pelo webservice
     * @return external_function_parameters
     */
    public static function api_parameters() {
        return new external_function_parameters([
            'message' => new external_value(PARAM_RAW, 'The message value'),
            'courseid' => new external_value(PARAM_TEXT, 'The Course ID'),
        ]);
    }

    /**
     * Identificador do retorno do webservice
     * @return external_single_structure
     */
    public static function api_returns() {
        return new external_single_structure([
            'result' => new external_value(PARAM_TEXT, 'Sucesso da operação', VALUE_REQUIRED),
            'format' => new external_value(PARAM_TEXT, 'Formato da resposta', VALUE_REQUIRED),
            'content' => new external_value(PARAM_RAW, 'The content result', VALUE_REQUIRED)
        ]);
    }

    /**
     * API para contabilizar o tempo gasto na plataforma pelos usuários
     *
     * @param $message
     *
     * @return array
     * @throws \dml_exception
     * @throws \coding_exception
     */
    public static function api($message, $courseid) {
        global $CFG, $DB, $USER, $SITE;

        if (isset($_SESSION["messages-{$courseid}"][0])) {
            $messages = $_SESSION["messages-{$courseid}"];
        } else {

            $content = get_config('local_geniai', 'prompt');
            $content = str_replace("{user-lang}", $USER->lang, $content);

            $messages = [
                [
                    'role' => 'system',
                    'content' => $content . ' and you only reply in HTML'
                ], [
                    'role' => 'system',
                    'content' => get_string('url_moodle', 'local_geniai',
                        ['wwwroot' => $CFG->wwwroot, 'fullname' => $SITE->fullname])
                ]
            ];
            if ($courseid) {
                if ($course = $DB->get_record('course', ['id' => $courseid])) {
                    $messages[] = [
                        'role' => 'system',
                        'content' => get_string('course_user', 'local_geniai',
                            ['course' => $course->fullname, 'userfullname' => fullname($USER)])
                    ];
                }
            } else {
                $messages[] = [
                    'role' => 'system',
                    'content' => get_string('course_home', 'local_geniai',
                        ['userfullname' => fullname($USER)])
                ];
            }
        }
        $messages[] = [
            'role' => 'user',
            'content' => trim($message)
        ];

        if (count($messages) > 10) {
            unset($messages[4]);
            unset($messages[3]);
            $messages = array_values($messages);
        }

        $gpt = self::chat_completions($messages);
        if (isset($gpt['error'])) {
            return [
                'result' => false,
                'format' => 'text',
                'content' => $gpt['error']['message']
            ];
        }

        if (isset($gpt['choices'][0]['message']['content'])) {
            $content = $gpt['choices'][0]['message']['content'];

            $messages[] = [
                'role' => 'system',
                'content' => $content
            ];
            $_SESSION["messages-{$courseid}"] = $messages;

            $format = 'text';
            if (preg_match('/<\w+>/', $content)) {
                $format = 'html';
            }
            return [
                'result' => true,
                'format' => $format,
                'content' => $content,
            ];
        }

        return [
            'result' => false,
            'format' => 'text',
            'content' => 'Error...'
        ];
    }

    /**
     * @param $messages
     * @return mixed
     * @throws \dml_exception
     */
    public static function chat_completions($messages) {
        global $DB;

        $apikey = get_config('local_geniai', 'apikey');
        $model = get_config('local_geniai', 'model');
        $temperature = get_config('local_geniai', 'temperature');
        $topp = get_config('local_geniai', 'top_p');
        $maxtokens = get_config('local_geniai', 'max_tokens');
        $frequencypenalty = get_config('local_geniai', 'frequency_penalty');
        $presencepenalty = get_config('local_geniai', 'presence_penalty');

        $post = (object)[
            'model' => $model,
            'messages' => $messages,
            'temperature' => floatval($temperature),
            'top_p' => floatval($topp),
            'max_tokens' => intval($maxtokens),
            'frequency_penalty' => floatval($frequencypenalty),
            'presence_penalty' => floatval($presencepenalty)
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://api.openai.com/v1/chat/completions');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post));

        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            "Authorization: Bearer {$apikey}"
        ]);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            return [
                'error' => [
                    'message' => 'http error: ' . curl_error($ch)
                ]
            ];
        }
        curl_close($ch);

        $gpt = json_decode($result, true);

        $usage = (object)[
            'send' => json_encode($post, JSON_PRETTY_PRINT),
            'receive' => $result,
            'model' => $model,
            'prompt_tokens' => $gpt['usage']['prompt_tokens'],
            'completion_tokens' => $gpt['usage']['completion_tokens'],
            'timecreated' => time()
        ];
        $DB->insert_record('local_geniai_usage', $usage);

        return $gpt;
    }
}
