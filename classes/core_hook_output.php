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
 * Output hook integrations used by local_geniai.
 *
 * @package   local_geniai
 * @copyright 2024 Eduardo Kraus {@link https://eduardokraus.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace local_geniai;

defined("MOODLE_INTERNAL") || die;
require_once(__DIR__ . "/../lib.php");

use context_course;
use context_system;
use Exception;
use local_geniai\util\release;
use moodle_url;

/**
 * Class core_hook_output
 *
 * @package local_geniai
 */
class core_hook_output {
    /**
     * Function before_footer_html_generation
     */
    public static function before_footer_html_generation() {
        self::local_geniai_addchat();
        self::local_geniai_addh5p();
        self::local_geniai_add_activity_analyzer();
    }

    /**
     * Add the floating GeniAI chat.
     *
     * @return void
     * @throws Exception
     */
    private static function local_geniai_addchat() {
        global $OUTPUT, $PAGE, $COURSE, $SITE, $USER, $CFG;

        $apikey = (string) get_config("local_geniai", "apikey");

        if (get_config("local_geniai", "mode") === "none") {
            return;
        } else if (!isset($apikey[5])) {
            return;
        } else if ($COURSE->id < 2) {
            return;
        } else if ($USER->id < 2) {
            return;
        } else if (strpos($_SERVER["REQUEST_URI"], 'mod/geniai/') >= 1) {
            return;
        } else if (!$PAGE->get_popup_notification_allowed()) {
            return;
        }

        $context = context_system::instance();
        $capability = has_capability('local/geniai:manage', $context);

        if (!$capability) {
            $modules = explode(',', (string) get_config("local_geniai", "modules"));
            foreach ($modules as $module) {
                $module = trim($module);

                if ($module === "") {
                    continue;
                }

                if (strpos($_SERVER["REQUEST_URI"], "mod/{$module}/") >= 1) {
                    return;
                }
            }
        }

        $agentphotourl = $OUTPUT->image_url('chat/tutor', "local_geniai");

        if ($filepath = get_config("local_geniai", "agentphoto")) {
            $syscontext = context_system::instance();
            $agentphotourl = moodle_url::make_file_url(
                $CFG->wwwroot . '/pluginfile.php',
                "/{$syscontext->id}/local_geniai/agentphoto/0/{$filepath}"
            );
        }

        $a = [
            "coursename" => $COURSE->fullname,
            "geniainame" => get_config("local_geniai", "geniainame"),
            "moodlename" => $SITE->fullname,
        ];

        $data = [
            "message_01" => get_string("message_01", "local_geniai", fullname($USER)),
            "message_02" => get_string("message_02", "local_geniai", $a),
            "manage_capability" => $capability,
            "geniainame" => get_config("local_geniai", "geniainame"),
            "talk_geniai" => get_string("talk_geniai", "local_geniai", get_config("local_geniai", "geniainame")),
            "agentphotourl" => $agentphotourl,
        ];

        echo $OUTPUT->render_from_template('local_geniai/chat', $data);
        $PAGE->requires->js_call_amd('local_geniai/chat', "init", [$COURSE->id, release::version()]);
    }

    /**
     * Add H5P helper scripts in content bank and module edit pages.
     *
     * @return void
     */
    private static function local_geniai_addh5p() {
        global $PAGE, $COURSE;

        if (!isset($_SERVER["REQUEST_URI"])) {
            return;
        }

        if (strpos($_SERVER["REQUEST_URI"], 'contentbank/') === false
                && strpos($_SERVER["REQUEST_URI"], 'course/modedit.php') === false) {
            return;
        }

        if (empty($COURSE->id) || $COURSE->id < 2) {
            return;
        }

        $contextid = context_course::instance($COURSE->id)->id;

        $PAGE->requires->strings_for_js([
            'h5p-manager',
            'h5p-manager-scorm',
        ], "local_geniai");

        $PAGE->requires->js_call_amd('local_geniai/h5p', "init", [$contextid]);
    }

    /**
     * Add the activity analyzer UI to course pages.
     *
     * The buttons are injected by AMD because course formats may render activities differently.
     * This keeps the feature compatible with topics, weeks and most custom formats that keep
     * Moodle's standard module id attribute, for example id="module-123".
     *
     * @return void
     */
    private static function local_geniai_add_activity_analyzer() {
        global $OUTPUT, $PAGE, $COURSE, $USER;

        $apikey = (string) get_config("local_geniai", "apikey");

        if (!isset($apikey[5])) {
            return;
        }

        if (empty($COURSE->id) || $COURSE->id < 2) {
            return;
        }

        if (empty($USER->id) || $USER->id < 2) {
            return;
        }

        if (strpos($PAGE->pagetype, 'course-view-') !== 0) {
            return;
        }

        if (!$PAGE->get_popup_notification_allowed()) {
            return;
        }

        $context = context_course::instance($COURSE->id);

        if (!has_capability('local/geniai:analyzeactivity', $context)) {
            return;
        }

        $PAGE->requires->strings_for_js([
            "analyzing_activity",
            "analysis_result",
            "analysis_error",
            "analysis_print_popup_blocked",
            "analysis_no_content",
            "analysis_recommendations",
            "analysis_model_warning",
            "analysis_last",
            "analysis_print",
        ], "local_geniai");

        echo $OUTPUT->render_from_template('local_geniai/activity_analyzer_modal', [
            "courseid" => (int) $COURSE->id,
        ]);

        $PAGE->requires->js_call_amd('local_geniai/activity-analyzer', "init", [(int) $COURSE->id]);
    }
}
