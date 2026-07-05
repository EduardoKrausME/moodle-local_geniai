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
 * Small value object for AI provider responses.
 *
 * @package   local_geniai
 * @copyright 2024 Eduardo Kraus {@link https://eduardokraus.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace local_geniai\gpt\util;

/**
 * Class ai_response
 */
class ai_response {
    /** @var bool Whether the provider returned content. */
    public $success = false;

    /** @var string Provider text content. */
    public $content = "";

    /** @var string Error message. */
    public $error = "";

    /** @var string Model used by the provider. */
    public $model = "";

    /** @var int Prompt tokens, when available. */
    public $prompttokens = 0;

    /** @var int Completion tokens, when available. */
    public $completiontokens = 0;

    /** @var int Total tokens, when available. */
    public $totaltokens = 0;

    /** @var array Raw response. */
    public $raw = [];

    /**
     * Build a response object from a Chat Completions-like payload.
     *
     * @param array $payload Raw provider payload.
     * @return ai_response
     */
    public static function from_chatgpt_completions(array $payload) {
        $response = new self();
        $response->raw = $payload;

        if (isset($payload["model"])) {
            $response->model = $payload["model"];
        }

        if (isset($payload["usage"]["prompt_tokens"])) {
            $response->prompttokens = (int) $payload["usage"]["prompt_tokens"];
        }
        if (isset($payload["usage"]["completion_tokens"])) {
            $response->completiontokens = (int) $payload["usage"]["completion_tokens"];
        }
        if (isset($payload["usage"]["total_tokens"])) {
            $response->totaltokens = (int) $payload["usage"]["total_tokens"];
        }

        if (isset($payload["error"]["message"])) {
            $response->success = false;
            $response->error = $payload["error"]["message"];
            return $response;
        }

        if (!isset($payload["choices"][0]["message"]["content"])) {
            $response->success = false;
            $response->error = 'The AI provider did not return a valid message.';
            return $response;
        }

        $response->success = true;
        $response->content = $payload["choices"][0]["message"]["content"];

        return $response;
    }

    /**
     * Build an error response.
     *
     * @param string $message Error message.
     * @return ai_response
     */
    public static function error($message) {
        $response = new self();
        $response->success = false;
        $response->error = $message;

        return $response;
    }
}
