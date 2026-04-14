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
 * History file.
 *
 * @package     local_geniai
 * @copyright   2024 Eduardo Kraus https://eduardokraus.com/
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace local_geniai\external;

use context_course;
use external_api;
use external_function_parameters;
use external_single_structure;
use external_value;
use local_geniai\markdown\parse_markdown;

defined('MOODLE_INTERNAL') || die;
global $CFG;
require_once("{$CFG->dirroot}/lib/externallib.php");

/**
 * History file.
 *
 * @package     local_geniai
 * @copyright   2024 Eduardo Kraus https://eduardokraus.com/
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class history extends external_api {
    /**
     * Parameters received by the webservice.
     *
     * @return external_function_parameters
     */
    public static function api_parameters() {
        return new external_function_parameters([
            "courseid" => new external_value(PARAM_INT, "The Course ID"),
            "action" => new external_value(PARAM_ALPHA, "The action"),
        ]);
    }

    /**
     * Return structure for the webservice.
     *
     * @return external_single_structure
     */
    public static function api_returns() {
        return new external_single_structure([
            "result" => new external_value(PARAM_BOOL, "Operation status", VALUE_REQUIRED),
            "content_html" => new external_value(PARAM_RAW, "The content result", VALUE_REQUIRED),
        ]);
    }

    /**
     * History API.
     *
     * @param int $courseid
     * @param string $action
     * @return array
     */
    public static function api($courseid, $action) {
        global $DB, $USER;

        $params = self::validate_parameters(self::api_parameters(), [
            "courseid" => $courseid,
            "action" => $action,
        ]);

        $course = $DB->get_record("course", ["id" => $params["courseid"]], "*", MUST_EXIST);
        require_login($course);

        $context = context_course::instance($course->id);
        self::validate_context($context);

        if ($params["action"] === "clear") {
            $USER->geniai[$course->id] = [];
            return [
                "result" => true,
                "content_html" => "[]",
            ];
        }

        $messages = $USER->geniai[$course->id] ?? [];

        $returnmessage = [];
        foreach ($messages as $message) {
            $parsemarkdown = new parse_markdown();
            $content = "";

            if (!empty($message["content_html"])) {
                $content = $message["content_html"];
            } else if (($message["role"] ?? "") === "system") {
                $content = $parsemarkdown->markdown_text($message["content"] ?? "");
            } else {
                $content = s($message["content"] ?? "");
            }

            $message["content_html"] = $content;
            $message["format"] = "html";
            $returnmessage[] = $message;
        }

        return [
            "result" => true,
            "content_html" => json_encode(array_values($returnmessage)),
        ];
    }
}
