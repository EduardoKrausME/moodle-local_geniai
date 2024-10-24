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
 * lib file.
 *
 * @package    local_geniai
 * @copyright  2024 Eduardo Kraus {@link http://eduardokraus.com}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

use local_geniai\local\util\release;

/**
 * Before footer.
 *
 * @throws coding_exception
 * @throws dml_exception
 * @throws moodle_exception
 */
function local_geniai_before_footer() {
    global $DB, $OUTPUT, $PAGE, $COURSE, $USER, $SITE;

    if (!isset(get_config("local_geniai", "apikey")[5])) {
        return;
    } else if (guest_user()->id == $USER->id) {
        return;
    } else if ($USER->id < 2) {
        return;
    }

    $capability = has_capability("local/geniai:manage", context_system::instance());
    if (!$capability) {
        $modules = explode(",", get_config("local_geniai", "modules"));
        foreach ($modules as $module) {
            if (strpos($_SERVER["REQUEST_URI"], "mod/{$module}/") >= 1) {
                return;
            }
        }
    }

    require_once(__DIR__ . "/classes/events/event_observers.php");
    $data = [
        "message_01" => get_string("message_01", "local_geniai", fullname($USER)),
        "manage_capability" => $capability,
        "geniainame" => get_config("local_geniai", "geniainame"),
    ];

    if (has_capability("local/geniai:view", context_system::instance())) {
        $geniainame = get_config("local_geniai", "geniainame");
        if ($COURSE->id) {
            $course = $DB->get_record("course", ["id" => $COURSE->id]);
            $data["message_02"] = get_string("message_02_course", "local_geniai",
                ["geniainame" => $geniainame, "moodlename" => $SITE->fullname, "coursename" => $course->fullname]);
        } else {
            $data["message_02"] = get_string("message_02_home", "local_geniai", $geniainame);
        }

        echo $OUTPUT->render_from_template("local_geniai/chat", $data);
        $PAGE->requires->js_call_amd('local_geniai/chat', 'init', [$COURSE->id, release::version()]);
    }
}
