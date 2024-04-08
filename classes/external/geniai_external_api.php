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

namespace local_geniai\external;

/**
 * Global external_api file.
 *
 * @package     local_geniai
 * @copyright   2024 Eduardo Kraus https://eduardokraus.com/
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class geniai_external_api {
    /**
     * History api function.
     *
     * @param int $courseid
     * @param string $action
     *
     * @return array
     */
    public static function history_api($courseid, $action) {
        if ($action == "clear") {
            $_SESSION["messages-{$courseid}"] = [];
            return [
                'result' => true,
                'content' => "[]",
            ];
        }

        if (isset($_SESSION["messages-{$courseid}"])) {
            $messages = $_SESSION["messages-{$courseid}"];
            unset($messages[0]);
            unset($messages[1]);
            unset($messages[2]);
        } else {
            $messages = [];
        }

        $returnmessage = [];
        foreach ($messages as $message) {
            $message->format = 'text';
            if (preg_match('/<\w+>/', $message->content)) {
                $message->format = 'html';
            }
            $returnmessage[] = $message;
        }

        return [
            'result' => true,
            'content' => json_encode($returnmessage),
        ];
    }

    /**
     * Chat api function.
     *
     * @param string $message
     * @param int $courseid
     *
     * @return array
     *
     * @throws \coding_exception
     * @throws \dml_exception
     */
    public static function chat_api($message, $courseid) {
        global $CFG, $DB, $USER, $SITE;

        if (isset($_SESSION["messages-{$courseid}"][0])) {
            $messages = $_SESSION["messages-{$courseid}"];
        } else {

            $content = get_config('local_geniai', 'prompt');
            $content = str_replace("{user-lang}", $USER->lang, $content);

            $replace = [
                'wwwroot' => $CFG->wwwroot,
                'fullname' => $SITE->fullname,
            ];
            $messages = [
                [
                    'role' => 'system',
                    'content' => $content . ' and you only respond in HTML, and do not return any kind of JavaScript.',
                ], [
                    'role' => 'system',
                    'content' => get_string('url_moodle', 'local_geniai', $replace),
                ],
            ];
            if ($courseid) {
                if ($course = $DB->get_record('course', ['id' => $courseid])) {
                    $messages[] = [
                        'role' => 'system',
                        'content' => get_string('course_user', 'local_geniai',
                            ['course' => $course->fullname, 'userfullname' => fullname($USER)]),
                    ];
                }
            } else {
                $messages[] = [
                    'role' => 'system',
                    'content' => get_string('course_home', 'local_geniai', ['userfullname' => fullname($USER)]),
                ];
            }
        }
        $messages[] = [
            'role' => 'user',
            'content' => strip_tags(trim($message)),
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
                'content' => $gpt['error']['message'],
            ];
        }

        if (isset($gpt['choices'][0]['message']['content'])) {
            $content = $gpt['choices'][0]['message']['content'];

            $messages[] = [
                'role' => 'system',
                'content' => $content,
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
            'content' => 'Error...',
        ];
    }

    /**
     * Chat completions function.
     *
     * @param array $messages
     *
     * @return mixed
     *
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
            'presence_penalty' => floatval($presencepenalty),
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://api.openai.com/v1/chat/completions');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post));

        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            "Authorization: Bearer {$apikey}",
        ]);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            return [
                'error' => [
                    'message' => 'http error: ' . curl_error($ch),
                ],
            ];
        }
        curl_close($ch);

        $gpt = json_decode($result, true);

        $usage = (object)[
            'send' => json_encode($post, JSON_PRETTY_PRINT),
            'receive' => $result,
            'model' => $model,
            'prompt_tokens' => intval($gpt['usage']['prompt_tokens']),
            'completion_tokens' => intval($gpt['usage']['completion_tokens']),
            'timecreated' => time(),
            'datecreated' => date("Y-m-d", time()),
        ];
        try {
            $DB->insert_record('local_geniai_usage', $usage);
        } catch (\dml_exception $e) {
            echo $e->getMessage();
        }

        return $gpt;
    }
}
