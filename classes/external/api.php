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
