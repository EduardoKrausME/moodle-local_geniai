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
     * Chat completions function using OpenAI Responses API.
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
        $maxtokens = (int)get_config("local_geniai", "max_tokens");

        if (isset($replacemodel[3])) {
            $model = $replacemodel;
        }

        $input = self::build_responses_input($messages);

        $post = [
            "model" => $model,
            "input" => $input,
            "store" => false,
        ];

        if (!$ignoremaxtoken && $maxtokens > 0) {
            $post["max_output_tokens"] = $maxtokens;
        }

        if (self::is_reasoning_model($model)) {
            $post["reasoning"] = [
                "effort" => "low",
            ];
        } else {
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

            $post["temperature"] = $temperature;
            $post["top_p"] = $topp;
            $post["frequency_penalty"] = (float)get_config("local_geniai", "frequency_penalty");
            $post["presence_penalty"] = (float)get_config("local_geniai", "presence_penalty");
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.openai.com/v1/responses");
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

        if (!is_array($gpt)) {
            return [
                "error" => [
                    "message" => "Invalid JSON response from OpenAI.",
                ],
            ];
        }

        $content = self::extract_response_text($gpt);

        if ($content !== "") {
            // Keep the old Chat Completions response shape to avoid changing all callers.
            $gpt["choices"] = [
                [
                    "message" => [
                        "role" => "assistant",
                        "content" => $content,
                    ],
                    "finish_reason" => $gpt["status"] ?? "completed",
                ],
            ];
        } else if (($gpt["status"] ?? "") === "incomplete") {
            $reason = $gpt["incomplete_details"]["reason"] ?? "unknown";

            $gpt["error"] = [
                "message" => "OpenAI response incomplete: {$reason}",
            ];
        } else if (!empty($gpt["error"]["message"])) {
            // Keep OpenAI error as-is.
        } else {
            $gpt["error"] = [
                "message" => "OpenAI returned no text output.",
            ];
        }

        $usage = (object)[
            "send" => json_encode([
                "endpoint" => "responses",
                "model" => $model,
                "messagecount" => count($input),
                "roles" => array_values(array_unique(array_column($input, "role"))),
                "max_output_tokens" => $ignoremaxtoken ? null : $maxtokens,
                "reasoning" => $post["reasoning"] ?? null,
            ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE),
            "receive" => json_encode([
                "id" => $gpt["id"] ?? null,
                "object" => $gpt["object"] ?? null,
                "model" => $gpt["model"] ?? $model,
                "status" => $gpt["status"] ?? null,
                "finish_reason" => $gpt["choices"][0]["finish_reason"] ?? null,
                "usage" => $gpt["usage"] ?? null,
                "error" => $gpt["error"]["message"] ?? null,
            ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE),
            "model" => $model,
            "prompt_tokens" => (int)($gpt["usage"]["input_tokens"] ?? 0),
            "completion_tokens" => (int)($gpt["usage"]["output_tokens"] ?? 0),
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
     * Build Responses API input from legacy messages.
     *
     * @param array $messages
     * @return array
     */
    private static function build_responses_input(array $messages): array {
        $input = [];

        foreach ($messages as $index => $message) {
            $role = $message["role"] ?? "user";
            $content = trim(strip_tags($message["content"] ?? ""));

            if ($content === "") {
                continue;
            }

            // In this plugin, the first system message is the instruction prompt.
            // Old assistant answers were stored as "system", so map later system messages to assistant.
            if ($role === "system") {
                $role = $index === 0 ? "developer" : "assistant";
            }

            if (!in_array($role, ["developer", "system", "user", "assistant"], true)) {
                $role = "user";
            }

            $input[] = [
                "role" => $role,
                "content" => $content,
            ];
        }

        return $input;
    }

    /**
     * Extract plain output text from a Responses API response.
     *
     * @param array $response
     * @return string
     */
    private static function extract_response_text(array $response): string {
        if (!empty($response["output_text"])) {
            return trim($response["output_text"]);
        }

        $texts = [];

        foreach (($response["output"] ?? []) as $item) {
            foreach (($item["content"] ?? []) as $content) {
                if (($content["type"] ?? "") === "output_text" && isset($content["text"])) {
                    $texts[] = $content["text"];
                }
            }
        }

        return trim(implode("\n", $texts));
    }

    /**
     * Detect models that should avoid legacy sampling parameters.
     *
     * @param string $model
     * @return bool
     */
    private static function is_reasoning_model(string $model): bool {
        return (bool)preg_match('/^(gpt-5|o[0-9])/i', $model);
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
