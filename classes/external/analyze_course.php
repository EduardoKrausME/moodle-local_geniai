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
 * External service to analyze visible activities from a course.
 *
 * @package   local_geniai
 * @copyright 2024 Eduardo Kraus {@link https://eduardokraus.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace local_geniai\external;

use context_course;
use external_api;
use external_function_parameters;
use external_multiple_structure;
use external_single_structure;
use external_value;
use local_geniai\analyzer\course_analyzer;
use local_geniai\markdown\parse_markdown;

defined("MOODLE_INTERNAL") || die;
global $CFG;
require_once("{$CFG->dirroot}/lib/externallib.php");

/**
 * Class analyze_course
 */
class analyze_course extends external_api {
    /**
     * Parameters received by the webservice.
     *
     * @return external_function_parameters
     */
    public static function api_parameters() {
        return new external_function_parameters([
            "courseid" => new external_value(PARAM_INT, 'Course ID'),
            "analysis" => new external_value(PARAM_ALPHAEXT, 'Analysis type', VALUE_DEFAULT, "full"),
            "force" => new external_value(PARAM_BOOL, 'Force a new analysis', VALUE_DEFAULT, false),
            "limit" => new external_value(PARAM_INT,
                'Max activities analyzed in this request', VALUE_DEFAULT, course_analyzer::DEFAULT_LIMIT),
        ]);
    }

    /**
     * Return structure for the webservice.
     *
     * @return external_single_structure
     */
    public static function api_returns() {
        return new external_single_structure([
            "result" => new external_value(PARAM_BOOL, 'Operation status', VALUE_REQUIRED),
            "courseid" => new external_value(PARAM_INT, 'Course ID', VALUE_REQUIRED),
            "processed" => new external_value(PARAM_INT, 'Processed activities', VALUE_REQUIRED),
            "limit" => new external_value(PARAM_INT, 'Limit used by request', VALUE_REQUIRED),
            "summary" => new external_single_structure([
                "total" => new external_value(PARAM_INT, 'Total processed', VALUE_REQUIRED),
                "ok" => new external_value(PARAM_INT, 'OK count', VALUE_REQUIRED),
                "ok_minor" => new external_value(PARAM_INT, 'OK with minor adjustments count', VALUE_REQUIRED),
                "needs_review" => new external_value(PARAM_INT, 'Needs review count', VALUE_REQUIRED),
                "insufficient" => new external_value(PARAM_INT, 'Insufficient count', VALUE_REQUIRED),
                "unknown" => new external_value(PARAM_INT, 'Unknown status count', VALUE_REQUIRED),
                "bloom_remember" => new external_value(PARAM_INT, 'Bloom remember count', VALUE_REQUIRED),
                "bloom_understand" => new external_value(PARAM_INT, 'Bloom understand count', VALUE_REQUIRED),
                "bloom_apply" => new external_value(PARAM_INT, 'Bloom apply count', VALUE_REQUIRED),
                "bloom_analyze" => new external_value(PARAM_INT, 'Bloom analyze count', VALUE_REQUIRED),
                "bloom_evaluate" => new external_value(PARAM_INT, 'Bloom evaluate count', VALUE_REQUIRED),
                "bloom_create" => new external_value(PARAM_INT, 'Bloom create count', VALUE_REQUIRED),
            ], "Summary", VALUE_REQUIRED),
            "items" => new external_multiple_structure(new external_single_structure([
                "cmid" => new external_value(PARAM_INT, 'Course module ID', VALUE_REQUIRED),
                "name" => new external_value(PARAM_TEXT, 'Activity name', VALUE_REQUIRED),
                "modname" => new external_value(PARAM_TEXT, 'Module type', VALUE_REQUIRED),
                "result" => new external_value(PARAM_BOOL, 'Operation status', VALUE_REQUIRED),
                "cached" => new external_value(PARAM_BOOL, 'Whether result came from cache', VALUE_REQUIRED),
                "analysis_id" => new external_value(PARAM_INT, 'Stored analysis ID', VALUE_OPTIONAL),
                "status" => new external_value(PARAM_TEXT, 'Final status', VALUE_OPTIONAL),
                "status_key" => new external_value(PARAM_TEXT, 'Final status key', VALUE_OPTIONAL),
                "bloom_level" => new external_value(PARAM_TEXT, 'Bloom taxonomy level', VALUE_OPTIONAL),
                "content" => new external_value(PARAM_RAW, 'Raw markdown analysis', VALUE_REQUIRED),
                "content_html" => new external_value(PARAM_RAW, 'HTML analysis', VALUE_REQUIRED),
                "contenthash" => new external_value(PARAM_ALPHANUMEXT, 'Content hash', VALUE_OPTIONAL),
            ]), 'Activity analyses', VALUE_REQUIRED),
        ]);
    }

    /**
     * Analyze visible activities from one course.
     *
     * @param int $courseid Course ID.
     * @param string $analysis Analysis type.
     * @param bool $force Force a new provider call.
     * @param int $limit Activity limit.
     * @return array
     * @throws \coding_exception
     * @throws \core_external\restricted_context_exception
     * @throws \dml_exception
     * @throws \invalid_parameter_exception
     * @throws \moodle_exception
     * @throws \require_login_exception
     * @throws \required_capability_exception
     */
    public static function api($courseid, $analysis = "full", $force = false, $limit = course_analyzer::DEFAULT_LIMIT) {
        global $USER;

        $params = self::validate_parameters(self::api_parameters(), [
            "courseid" => $courseid,
            "analysis" => $analysis,
            "force" => $force,
            "limit" => $limit,
        ]);

        $course = get_course($params["courseid"]);
        require_login($course);

        $coursecontext = context_course::instance($course->id);
        self::validate_context($coursecontext);
        require_capability('local/geniai:analyzeactivity', $coursecontext);

        $service = new course_analyzer();
        $data = $service->analyze_course($course->id, $USER->id, $params["analysis"], $params["force"], $params["limit"]);

        $parsemarkdown = new parse_markdown();
        foreach ($data["items"] as $index => $item) {
            $data["items"][$index]["content_html"] = $parsemarkdown->markdown_text($item["content"]);
        }

        return [
            "result" => true,
            "courseid" => $data["courseid"],
            "processed" => $data["processed"],
            "limit" => $data["limit"],
            "summary" => $data["summary"],
            "items" => $data["items"],
        ];
    }
}
