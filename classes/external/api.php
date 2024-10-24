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

use curl;
use local_geniai\markdown\parse_markdown;

/**
 * Global api file.
 *
 * @package     local_geniai
 * @copyright   2024 Eduardo Kraus https://eduardokraus.com/
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class api {

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

            $result = new parse_markdown();
            $message['content'] = $result->markdown_text($message['content']);
            $message['format'] = 'html';

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
    public static function chat_api($courseid, $message) {
        global $CFG, $DB, $USER, $SITE;

        if (isset($_SESSION["messages-{$courseid}"][0])) {
            $messages = $_SESSION["messages-{$courseid}"];
        } else {

            $prompt = get_config('local_geniai', 'prompt');
            $prompt = str_replace("{geniainame}", get_config('local_geniai', 'geniainame'), $prompt);
            $prompt = str_replace("{user-lang}", $USER->lang, $prompt);
            $prompt = str_replace("{moodle-name}", $SITE->fullname, $prompt);

            $replace = [
                'wwwroot' => $CFG->wwwroot,
                'fullname' => $SITE->fullname,
            ];
            $messages = [
                [
                    'role' => 'system',
                    'content' => $prompt . ' and you only format in MARKDOWN.',
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
                            ['course' => $course->fullname]),
                    ];
                }
            } else {
                $messages[] = [
                    'role' => 'system',
                    'content' => get_string('course_home', 'local_geniai'),
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
            $result = new parse_markdown();
            $content = $result->markdown_text($gpt['error']['message']);
            return [
                'result' => false,
                'format' => 'text',
                'content' => $content,
            ];
        }

        if (isset($gpt['choices'][0]['message']['content'])) {
            $content = $gpt['choices'][0]['message']['content'];

            $messages[] = [
                'role' => 'system',
                'content' => $content,
            ];
            $_SESSION["messages-{$courseid}"] = $messages;

            $result = new parse_markdown();
            $content = $result->markdown_text($content);

            $format = 'html';
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
     * @throws \coding_exception
     */
    public static function chat_completions($messages) {
        global $DB, $CFG;

        $apikey = get_config('local_geniai', 'apikey');
        $model = get_config('local_geniai', 'model');
        $maxtokens = get_config('local_geniai', 'max_tokens');
        $frequencypenalty = get_config('local_geniai', 'frequency_penalty');
        $presencepenalty = get_config('local_geniai', 'presence_penalty');

        switch (get_config('local_geniai', 'case')) {
            case 'text_code_generation':
                $temperature = .1;
                $topp = .1;
                break;
            case 'data_analysis_script':
                $temperature = .2;
                $topp = .1;
                break;
            case 'text_comment_generation':
                $temperature = .3;
                $topp = .2;
                break;
            case 'chatbot':
                $temperature = .5;
                $topp = .5;
                break;
            case 'exploratory_writing':
                $temperature = .6;
                $topp = .7;
                break;
            case 'creative_writing':
                $temperature = .7;
                $topp = .8;
                break;
            case 'idea_brainstorming':
                $temperature = .8;
                $topp = .9;
                break;
            case 'fictitious_dialogue_generation':
                $temperature = .9;
                $topp = .95;
                break;
            case 'surreal_story_generation':
                $temperature = 1.0;
                $topp = 1.0;
                break;
            default:
                $temperature = .5;
                $topp = .5;
        }

        $post = (object)[
            'model' => $model,
            'messages' => $messages,
            'temperature' => $temperature,
            'top_p' => $topp,
            'max_tokens' => intval($maxtokens),
            'frequency_penalty' => floatval($frequencypenalty),
            'presence_penalty' => floatval($presencepenalty),
        ];

        require_once("{$CFG->libdir}/filelib.php");
        $curl = new curl();
        $curl->setopt([
            'CURLOPT_HTTPHEADER' => [
                'Content-Type: application/json',
                "Authorization: Bearer {$apikey}",
            ],
        ]);
        $result = $curl->post('https://api.openai.com/v1/chat/completions', json_encode($post));
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
