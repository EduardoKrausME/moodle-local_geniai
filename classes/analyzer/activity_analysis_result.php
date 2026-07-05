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
 * Result object returned by the activity analyzer.
 *
 * @package   local_geniai
 * @copyright 2024 Eduardo Kraus {@link https://eduardokraus.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace local_geniai\analyzer;

use stdClass;

/**
 * Class activity_analysis_result
 */
class activity_analysis_result {
    /** @var bool Operation status. */
    public $result = false;

    /** @var int Stored analysis ID. */
    public $id = 0;

    /** @var bool Whether this result came from cache/history. */
    public $cached = false;

    /** @var string Markdown content returned by the AI model. */
    public $content = "";

    /** @var string Final pedagogical status. */
    public $status = "";

    /** @var string Machine-readable status key. */
    public $statuskey = "";

    /** @var string Bloom taxonomy level. */
    public $bloomlevel = "";

    /** @var array Practical recommendations extracted from structured output. */
    public $recommendations = [];

    /** @var string Content hash used for cache/history support. */
    public $contenthash = "";

    /** @var string Model used by provider. */
    public $model = "";

    /** @var int Prompt tokens. */
    public $prompttokens = 0;

    /** @var int Completion tokens. */
    public $completiontokens = 0;

    /** @var array Structured result extracted from the AI response. */
    public $resultjson = [];

    /** @var array Raw provider response. */
    public $rawresponse = [];

    /**
     * Create a success result.
     *
     * @param string $content Markdown content.
     * @param string $contenthash Content hash.
     * @param array $rawresponse Raw provider response.
     * @param array $metadata Parsed metadata.
     * @return activity_analysis_result
     */
    public static function success($content, $contenthash, array $rawresponse = [], array $metadata = []) {
        $parsed = result_parser::parse($content);

        $result = new self();
        $result->result = true;
        $result->content = $metadata["displaytext"] ?? $parsed["displaytext"];
        $result->contenthash = $contenthash;
        $result->rawresponse = $rawresponse;
        $result->resultjson = $metadata["json"] ?? $parsed["json"];
        $result->status = $metadata["status"] ?? $parsed["status"];
        $result->statuskey = $metadata["statuskey"] ?? $parsed["statuskey"];
        $result->bloomlevel = $metadata["bloomlevel"] ?? $parsed["bloomlevel"];
        $result->recommendations = $metadata["recommendations"] ?? $parsed["recommendations"];

        if (isset($metadata["model"])) {
            $result->model = $metadata["model"];
        }
        if (isset($metadata["prompttokens"])) {
            $result->prompttokens = (int) $metadata["prompttokens"];
        }
        if (isset($metadata["completiontokens"])) {
            $result->completiontokens = (int) $metadata["completiontokens"];
        }

        return $result;
    }

    /**
     * Create an error result.
     *
     * @param string $message Error message.
     * @param string $contenthash Content hash.
     * @param array $rawresponse Raw provider response.
     * @return activity_analysis_result
     */
    public static function error($message, $contenthash = "", array $rawresponse = []) {
        $result = new self();
        $result->result = false;
        $result->content = $message;
        $result->contenthash = $contenthash;
        $result->rawresponse = $rawresponse;

        return $result;
    }

    /**
     * Create a result object from a stored DB record.
     *
     * @param \stdClass $record Database record.
     * @return activity_analysis_result
     */
    public static function from_record(stdClass $record) {
        $result = new self();
        $result->result = true;
        $result->id = isset($record->id) ? (int) $record->id : 0;
        $result->cached = true;
        $result->content = isset($record->resulttext) ? $record->resulttext : "";
        $result->status = isset($record->status) ? $record->status : "";
        $result->statuskey = isset($record->statuskey) ? $record->statuskey : "";
        $result->bloomlevel = isset($record->bloomlevel) ? $record->bloomlevel : "";
        $result->contenthash = isset($record->contenthash) ? $record->contenthash : "";
        $result->model = isset($record->model) ? $record->model : "";
        $result->prompttokens = isset($record->prompttokens) ? (int) $record->prompttokens : 0;
        $result->completiontokens = isset($record->completiontokens) ? (int) $record->completiontokens : 0;

        if (!empty($record->resultjson)) {
            $decoded = json_decode($record->resultjson, true);
            $result->resultjson = is_array($decoded) ? $decoded : [];
        }
        if (!empty($record->recommendations)) {
            $decoded = json_decode($record->recommendations, true);
            $result->recommendations = is_array($decoded) ? $decoded : [];
        }

        return $result;
    }

    /**
     * Export for AJAX responses.
     *
     * @return array
     */
    public function to_array() {
        return [
            "result" => $this->result,
            "id" => $this->id,
            "cached" => $this->cached,
            "content" => $this->content,
            "status" => $this->status,
            "status_key" => $this->statuskey,
            "bloom_level" => $this->bloomlevel,
            "recommendations" => $this->recommendations,
            "contenthash" => $this->contenthash,
            "model" => $this->model,
            "prompt_tokens" => $this->prompttokens,
            "completion_tokens" => $this->completiontokens,
        ];
    }
}
