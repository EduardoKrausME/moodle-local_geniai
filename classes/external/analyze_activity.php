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
 * External service to analyze one Moodle activity.
 *
 * @package   local_geniai
 * @copyright 2024 Eduardo Kraus {@link https://eduardokraus.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace local_geniai\external;

use context_course;
use context_module;
use external_api;
use external_function_parameters;
use external_multiple_structure;
use external_single_structure;
use external_value;
use local_geniai\analyzer\activity_analyzer;
use local_geniai\markdown\parse_markdown;

defined("MOODLE_INTERNAL") || die;
global $CFG;
require_once("{$CFG->dirroot}/lib/externallib.php");

/**
 * Class analyze_activity
 */
class analyze_activity extends external_api {
    /**
     * Parameters received by the webservice.
     *
     * @return external_function_parameters
     */
    public static function api_parameters() {
        return new external_function_parameters([
            "cmid" => new external_value(PARAM_INT, 'Course module ID'),
            "analysis" => new external_value(PARAM_ALPHAEXT, 'Analysis type', VALUE_DEFAULT, "full"),
            "force" => new external_value(PARAM_BOOL, 'Force a new analysis', VALUE_DEFAULT, false),
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
            "format" => new external_value(PARAM_TEXT, 'Response format', VALUE_REQUIRED),
            "content" => new external_value(PARAM_RAW, 'Raw markdown content', VALUE_REQUIRED),
            "content_html" => new external_value(PARAM_RAW, 'HTML content', VALUE_REQUIRED),
            "status" => new external_value(PARAM_TEXT, 'Final status', VALUE_OPTIONAL),
            "status_key" => new external_value(PARAM_TEXT, 'Final status key', VALUE_OPTIONAL),
            "bloom_level" => new external_value(PARAM_TEXT, 'Bloom taxonomy level', VALUE_OPTIONAL),
            "recommendations" => new external_multiple_structure(
                new external_value(PARAM_RAW, "Recommendation"),
                'Practical recommendations',
                VALUE_OPTIONAL
            ),
            "cmid" => new external_value(PARAM_INT, 'Course module ID', VALUE_REQUIRED),
            "analysis_id" => new external_value(PARAM_INT, 'Stored analysis ID', VALUE_OPTIONAL),
            "cached" => new external_value(PARAM_BOOL, 'Whether this result came from cache', VALUE_OPTIONAL),
            "model" => new external_value(PARAM_TEXT, 'AI model', VALUE_OPTIONAL),
            "prompt_tokens" => new external_value(PARAM_INT, 'Prompt tokens', VALUE_OPTIONAL),
            "completion_tokens" => new external_value(PARAM_INT, 'Completion tokens', VALUE_OPTIONAL),
            "contenthash" => new external_value(PARAM_ALPHANUMEXT, 'Content hash', VALUE_OPTIONAL),
        ]);
    }

    /**
     * Analyze one activity.
     *
     * @param int $cmid Course module ID.
     * @param string $analysis Analysis type.
     * @param bool $force Force a new provider call.
     * @return array
     * @throws \coding_exception
     * @throws \core_external\restricted_context_exception
     * @throws \invalid_parameter_exception
     * @throws \moodle_exception
     * @throws \require_login_exception
     * @throws \required_capability_exception
     */
    public static function api($cmid, $analysis = "full", $force = false) {
        $params = self::validate_parameters(self::api_parameters(), [
            "cmid" => $cmid,
            "analysis" => $analysis,
            "force" => $force,
        ]);

        [$course, $cm] = get_course_and_cm_from_cmid($params["cmid"], "", 0, false);
        require_login($course, false, $cm);

        $modulecontext = context_module::instance($cm->id);
        self::validate_context($modulecontext);

        $coursecontext = context_course::instance($course->id);
        require_capability('local/geniai:analyzeactivity', $coursecontext);

        $analyzer = new activity_analyzer();
        $analysisresult = $analyzer->analyze($cm->id, null, $params["analysis"], $params["force"]);

        $parsemarkdown = new parse_markdown();
        $contenthtml = $parsemarkdown->markdown_text($analysisresult->content);

        return [
            "result" => $analysisresult->result,
            "format" => "html",
            "content" => $analysisresult->content,
            "content_html" => $contenthtml,
            "status" => $analysisresult->status,
            "status_key" => $analysisresult->statuskey,
            "bloom_level" => $analysisresult->bloomlevel,
            "recommendations" => $analysisresult->recommendations,
            "cmid" => (int) $params["cmid"],
            "analysis_id" => $analysisresult->id,
            "cached" => $analysisresult->cached,
            "model" => $analysisresult->model,
            "prompt_tokens" => $analysisresult->prompttokens,
            "completion_tokens" => $analysisresult->completiontokens,
            "contenthash" => $analysisresult->contenthash,
        ];
    }
}
