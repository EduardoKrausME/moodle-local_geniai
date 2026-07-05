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
 * Builds prompts for activity analysis.
 *
 * @package   local_geniai
 * @copyright 2024 Eduardo Kraus {@link https://eduardokraus.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace local_geniai\analyzer;

/**
 * Class prompt_builder
 */
class prompt_builder {
    /**
     * Build chat messages for the current activity analysis.
     *
     * @param activity_content $content Activity content.
     * @param string $analysis Analysis type.
     * @return array
     */
    public static function build_messages(activity_content $content, $analysis = "full") {
        $system = self::system_prompt($analysis);
        $user = self::user_prompt($content);

        return [
            [
                "role" => "system",
                "content" => $system,
            ],
            [
                "role" => "user",
                "content" => $user,
            ],
        ];
    }

    /**
     * Structured schema used by ai_client::generate_json().
     *
     * @return array
     */
    public static function structured_schema() {
        return [
            "status_key" => get_string("prompt_activity_schema_status_key", "local_geniai"),
            "status" => get_string("prompt_activity_schema_status", "local_geniai"),
            "bloom_level" => get_string("prompt_activity_schema_bloom_level", "local_geniai"),
            "diagnosis" => get_string("prompt_activity_schema_diagnosis", "local_geniai"),
            "recommendations" => [
                get_string("prompt_activity_schema_recommendation_1", "local_geniai"),
                get_string("prompt_activity_schema_recommendation_2", "local_geniai"),
            ],
        ];
    }

    /**
     * Build the system prompt.
     *
     * @param string $analysis Analysis type.
     * @return string
     */
    private static function system_prompt($analysis) {
        $promptdata = (object) [
            "focus" => self::analysis_focus($analysis),
            "analysis" => $analysis,
            "lang" => current_language(),
        ];

        return get_string("prompt_activity_system", "local_geniai", $promptdata);
    }

    /**
     * Build the user prompt.
     *
     * @param activity_content $content Activity content.
     * @return string
     */
    private static function user_prompt(activity_content $content) {
        return get_string("prompt_activity_user", "local_geniai", $content->to_prompt_text());
    }

    /**
     * Describe the analysis focus.
     *
     * @param string $analysis Analysis type.
     * @return string
     */
    private static function analysis_focus($analysis) {
        $analysis = trim($analysis);

        $focus = [
            "full" => get_string("prompt_activity_focus_full", "local_geniai"),
            "spelling" => get_string("prompt_activity_focus_spelling", "local_geniai"),
            "alignment" => get_string("prompt_activity_focus_alignment", "local_geniai"),
            "bloom" => get_string("prompt_activity_focus_bloom", "local_geniai"),
            "pedagogy" => get_string("prompt_activity_focus_pedagogy", "local_geniai"),
        ];

        return $focus[$analysis] ?? $focus["full"];
    }
}
