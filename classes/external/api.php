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

use dml_exception;

/**
 * Global api file.
 *
 * @package     local_geniai
 * @copyright   2024 Eduardo Kraus https://eduardokraus.com/
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class api {

    /**
     * Chat completions function.
     *
     * @param array $messages
     * @param bool $ignoremaxtoken
     * @param string $replacemodel
     * @return mixed
     * @throws dml_exception
     */
    public static function chat_completions($messages, $ignoremaxtoken = false, $replacemodel = "") {
        global $DB;

        $apikey = get_config("local_geniai", "apikey");
        $model = get_config("local_geniai", "model");
        $maxtokens = get_config("local_geniai", "max_tokens");
        $frequencypenalty = get_config("local_geniai", "frequency_penalty");
        $presencepenalty = get_config("local_geniai", "presence_penalty");

        if (isset($replacemodel[3])) {
            $model = $replacemodel;
        }

        switch (get_config("local_geniai", "case")) {
            case "creative":
                $temperature = .7;
                $topp = .8;
                break;
            case "balanced":
                $temperature = .5;
                $topp = .7;
                break;
            case "precise":
                $temperature = .0;
                $topp = 1.0;
                break;
            case "exploration":
                $temperature = .8;
                $topp = .9;
                break;
            case "formal":
                $temperature = .3;
                $topp = .6;
                break;
            case "informal":
                $temperature = .7;
                $topp = .8;
                break;
            case "chatbot":
                $temperature = .2;
                $topp = .8;
                break;
            default:
                $temperature = .5;
                $topp = .5;
        }

        $messagesok = [];
        foreach ($messages as $message) {
            $messagesok[] = [
                "role" => $message["role"],
                "content" => strip_tags($message["content"]),
            ];
        }

        $post = (object) [
            "model" => $model,
            "messages" => $messagesok,
            "temperature" => $temperature,
            "top_p" => $topp,
            "frequency_penalty" => (float) $frequencypenalty,
            "presence_penalty" => (float) $presencepenalty,
        ];

        if (!$ignoremaxtoken) {
            $post->max_tokens = (int) $maxtokens;
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.openai.com/v1/chat/completions");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post));
        curl_setopt($ch, CURLOPT_TIMEOUT, 120);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Content-Type: application/json",
            "Authorization: Bearer {$apikey}",
        ]);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            return [
                "error" => [
                    "message" => "http error: " . curl_error($ch),
                ],
            ];
        }
        curl_close($ch);

        $gpt = json_decode($result, true);

        $usage = (object) [
            "send" => json_encode([
                "model" => $model,
                "messagecount" => count($messagesok),
                "roles" => array_values(array_unique(array_column($messagesok, "role"))),
                "temperature" => $temperature,
                "top_p" => $topp,
                "max_tokens" => $ignoremaxtoken ? null : (int) $maxtokens,
            ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE),
            "receive" => json_encode([
                "id" => $gpt["id"] ?? null,
                "object" => $gpt["object"] ?? null,
                "model" => $gpt["model"] ?? $model,
                "finish_reason" => $gpt["choices"][0]["finish_reason"] ?? null,
                "usage" => $gpt["usage"] ?? null,
                "error" => $gpt["error"]["message"] ?? null,
            ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE),
            "model" => $model,
            "prompt_tokens" => (int) ($gpt["usage"]["prompt_tokens"] ?? 0),
            "completion_tokens" => (int) ($gpt["usage"]["completion_tokens"] ?? 0),
            "timecreated" => time(),
            "datecreated" => date("Y-m-d"),
        ];
        try {
            $DB->insert_record("local_geniai_usage", $usage);
        } catch (dml_exception $e) {
            echo $e->getMessage();
        }

        return $gpt;
    }

    /**
     * Function transcriptions
     *
     * @param string $audio
     * @param string $lang
     * @return array
     * @throws dml_exception
     */
    public static function transcriptions_base64($audio, $lang) {
        global $CFG, $USER;

        $audio = str_replace("data:audio/mp3;base64,", "", $audio);
        $audiodata = base64_decode($audio, true);
        if ($audiodata === false) {
            return [
                "text" => "",
                "language" => $lang,
                "filename" => null,
                "error" => "Invalid audio payload.",
            ];
        }

        $filename = uniqid();
        $filepath = "{$CFG->dataroot}/temp/{$filename}.mp3";
        file_put_contents($filepath, $audiodata);

        if (!isset($USER->local_geniai_audiofiles) || !is_array($USER->local_geniai_audiofiles)) {
            $USER->local_geniai_audiofiles = [];
        }
        $USER->local_geniai_audiofiles[$filename] = time();

        $transcription = self::transcriptions($filepath, $lang);
        $transcription["filename"] = $filename;

        return $transcription;
    }

    /**
     * transcriptions
     *
     * @param string $filepath
     * @param string $lang
     * @return array
     * @throws dml_exception
     */
    public static function transcriptions($filepath, $lang) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.openai.com/v1/audio/transcriptions");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, [
            "file" => curl_file_create($filepath),
            "model" => "whisper-1",
            "response_format" => "verbose_json",
            "language" => $lang,
        ]);
        curl_setopt($ch, CURLOPT_TIMEOUT, 120);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Content-Type: multipart/form-data",
            "Authorization: Bearer " . get_config("local_geniai", "apikey"),
        ]);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            $message = curl_error($ch);
            curl_close($ch);

            return [
                "text" => "",
                "language" => $lang,
                "error" => "http error: {$message}",
            ];
        }
        curl_close($ch);

        $result = json_decode($result);

        return [
            "text" => $result->text ?? "",
            "language" => $result->language ?? $lang,
        ];
    }
}
