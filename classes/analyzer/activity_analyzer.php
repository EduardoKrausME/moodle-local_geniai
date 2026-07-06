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
 * Central service responsible for analyzing a Moodle activity.
 *
 * @package   local_geniai
 * @copyright 2024 Eduardo Kraus {@link https://eduardokraus.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace local_geniai\analyzer;

use local_geniai\extractor\extractor_manager;
use local_geniai\gpt\util\ai_client;

/**
 * Class activity_analyzer
 */
class activity_analyzer {
    /**
     * Analyze an activity using the current GeniAI provider.
     *
     * @param int $cmid Course module ID.
     * @param int|null $userid User ID used by get_fast_modinfo.
     * @param string $analysis Analysis type.
     * @param bool $force Force a new provider call, ignoring cache.
     * @return activity_analysis_result
     * @throws \moodle_exception
     */
    public function analyze($cmid, $userid = null, $analysis = "full", $force = false) {
        global $USER;

        if ($userid === null) {
            $userid = $USER->id ?? 0;
        }

        [$course, $cm] = get_course_and_cm_from_cmid($cmid, "", 0, false);

        if (!analysis_availability::can_analyze_cm($cm)) {
            return activity_analysis_result::error(get_string("analysis_not_supported", "local_geniai"));
        }

        $content = extractor_manager::extract($cm, $course, $userid);
        $contenthash = $content->content_hash();

        if (!$force) {
            $cached = analysis_repository::get_latest_by_hash($cm->id, $analysis, $contenthash);
            if ($cached !== null) {
                return $cached;
            }
        }

        $messages = prompt_builder::build_messages($content, $analysis);
        $schema = prompt_builder::structured_schema();
        $response = ai_client::generate_json($messages, $schema);

        if (!$response->success) {
            return activity_analysis_result::error($response->error, $contenthash, $response->raw);
        }

        $parsed = result_parser::parse($response->content);
        $parsed["model"] = $response->model;
        $parsed["prompttokens"] = $response->prompttokens;
        $parsed["completiontokens"] = $response->completiontokens;

        $analysisresult = activity_analysis_result::success(
            $response->content,
            $contenthash,
            $response->raw,
            $parsed
        );

        analysis_repository::save($course->id, $cm->id, $userid, $analysis, $analysisresult);

        return $analysisresult;
    }
}
