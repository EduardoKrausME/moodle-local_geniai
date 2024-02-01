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
 * User: Eduardo Kraus
 * Date: 31/01/2024
 * Time: 20:35
 */

namespace local_geniai\external;

use external_api;
use external_value;
use external_single_structure;
use external_function_parameters;
use tool_brickfield\local\areas\core_course\fullname;

class chat extends external_api {
    /**
     * Parâmetros recebidos pelo webservice
     * @return external_function_parameters
     */
    public static function api_parameters() {
        return new external_function_parameters([
            'message' => new external_value(PARAM_TEXT, 'The message value'),
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
            'content' => new external_value(PARAM_TEXT, 'The content result', VALUE_REQUIRED),
            'return-send' => new external_value(PARAM_RAW, 'The content result', VALUE_OPTIONAL),
            'return-receive' => new external_value(PARAM_RAW, 'The content result', VALUE_OPTIONAL),
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
            $messages = [
                [
                    'role' => 'system',
                    'content' => get_config('local_geniai', 'prompt')
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

        $gpt = self::chat_completions($messages);
        if (isset($gpt['error'])) {
            return [
                'result' => false,
                'content' => $gpt['error']['message'],
                'return-send' => $gpt['$post'],
                'return-receive' => $gpt['$result']
            ];
        }

        $content = $gpt['choices'][0]['message']['content'];

        $messages[] = [
            'role' => 'system',
            'content' => $content
        ];
        $_SESSION["messages-{$courseid}"] = $messages;

        return [
            'result' => true,
            'content' => $content,
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

        $post = (object)[
            "model" => $model,
            "messages" => $messages,
            "temperature" => 0.2,
            "max_tokens" => 200,
            "top_p" => 1,
            "frequency_penalty" => 1,
            "presence_penalty" => 1,
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://api.openai.com/v1/chat/completions');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post));

        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Content-Type: application/json",
            "Authorization: Bearer {$apikey}"
        ]);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);

        $gpt = json_decode($result, true);

        $usage = (object)[
            'send' => json_encode($post, JSON_PRETTY_PRINT),
            'receive' => $result,
            'prompt_tokens' => $gpt['usage']['prompt_tokens'],
            'completion_tokens' => $gpt['usage']['completion_tokens'],
            'timecreated' => time()
        ];
        $DB->insert_record("local_geniai_usage", $usage);

        return $gpt;
    }
}