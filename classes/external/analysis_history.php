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
 * External service for reading activity analysis history.
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
use local_geniai\analyzer\analysis_repository;
use local_geniai\markdown\parse_markdown;

defined("MOODLE_INTERNAL") || die;
global $CFG;
require_once("{$CFG->dirroot}/lib/externallib.php");

/**
 * Class analysis_history
 */
class analysis_history extends external_api {
    /**
     * Parameters received by the webservice.
     *
     * @return external_function_parameters
     */
    public static function api_parameters() {
        return new external_function_parameters([
            "courseid" => new external_value(PARAM_INT, 'Course ID'),
            "cmid" => new external_value(PARAM_INT, 'Course module ID, or 0 for all', VALUE_DEFAULT, 0),
            "limit" => new external_value(PARAM_INT, 'History limit', VALUE_DEFAULT, 50),
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
            "cmid" => new external_value(PARAM_INT, 'Course module ID filter', VALUE_REQUIRED),
            "items" => new external_multiple_structure(new external_single_structure([
                "id" => new external_value(PARAM_INT, 'Analysis ID', VALUE_REQUIRED),
                "cmid" => new external_value(PARAM_INT, 'Course module ID', VALUE_REQUIRED),
                "userid" => new external_value(PARAM_INT, 'User ID', VALUE_REQUIRED),
                "analysis_type" => new external_value(PARAM_TEXT, 'Analysis type', VALUE_REQUIRED),
                "status" => new external_value(PARAM_TEXT, 'Final status', VALUE_OPTIONAL),
                "status_key" => new external_value(PARAM_TEXT, 'Final status key', VALUE_OPTIONAL),
                "bloom_level" => new external_value(PARAM_TEXT, 'Bloom taxonomy level', VALUE_OPTIONAL),
                "recommendations" => new external_multiple_structure(
                    new external_value(PARAM_RAW, "Recommendation"),
                    'Practical recommendations',
                    VALUE_OPTIONAL
                ),
                "model" => new external_value(PARAM_TEXT, 'AI model', VALUE_OPTIONAL),
                "prompt_tokens" => new external_value(PARAM_INT, 'Prompt tokens', VALUE_OPTIONAL),
                "completion_tokens" => new external_value(PARAM_INT, 'Completion tokens', VALUE_OPTIONAL),
                "contenthash" => new external_value(PARAM_ALPHANUMEXT, 'Content hash', VALUE_OPTIONAL),
                "content" => new external_value(PARAM_RAW, 'Raw markdown analysis', VALUE_REQUIRED),
                "content_html" => new external_value(PARAM_RAW, 'HTML analysis', VALUE_REQUIRED),
                "timecreated" => new external_value(PARAM_INT, 'Created time', VALUE_REQUIRED),
            ]), 'History items', VALUE_REQUIRED),
        ]);
    }

    /**
     * Return history for one course or one activity.
     *
     * @param int $courseid Course ID.
     * @param int $cmid Course module ID.
     * @param int $limit History limit.
     * @return array
     * @throws \coding_exception
     * @throws \core_external\restricted_context_exception
     * @throws \dml_exception
     * @throws \invalid_parameter_exception
     * @throws \moodle_exception
     * @throws \require_login_exception
     * @throws \required_capability_exception
     */
    public static function api($courseid, $cmid = 0, $limit = 50) {
        $params = self::validate_parameters(self::api_parameters(), [
            "courseid" => $courseid,
            "cmid" => $cmid,
            "limit" => $limit,
        ]);

        $course = get_course($params["courseid"]);
        require_login($course);

        $coursecontext = context_course::instance($course->id);
        self::validate_context($coursecontext);
        require_capability('local/geniai:analyzeactivity', $coursecontext);

        $records = analysis_repository::list_history($course->id, $params["cmid"], min(200, max(1, $params["limit"])));
        $parsemarkdown = new parse_markdown();
        $items = [];

        foreach ($records as $record) {
            $content = $record->resulttext ?? "";
            $recommendations = [];
            if (!empty($record->recommendations)) {
                $decoded = json_decode($record->recommendations, true);
                if (is_array($decoded)) {
                    $recommendations = array_values(array_filter(array_map("strval", $decoded)));
                }
            }

            $items[] = [
                "id" => (int) $record->id,
                "cmid" => (int) $record->cmid,
                "userid" => (int) $record->userid,
                "analysis_type" => $record->analysis_type,
                "status" => $record->status,
                "status_key" => isset($record->statuskey) ? $record->statuskey : "",
                "bloom_level" => $record->bloomlevel,
                "recommendations" => $recommendations,
                "model" => $record->model,
                "prompt_tokens" => (int) $record->prompttokens,
                "completion_tokens" => (int) $record->completiontokens,
                "contenthash" => $record->contenthash,
                "content" => $content,
                "content_html" => $parsemarkdown->markdown_text($content),
                "timecreated" => (int) $record->timecreated,
            ];
        }

        return [
            "result" => true,
            "courseid" => (int) $course->id,
            "cmid" => (int) $params["cmid"],
            "items" => $items,
        ];
    }
}
