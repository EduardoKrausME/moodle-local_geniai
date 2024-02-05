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

function local_geniai_before_footer() {
    global $OUTPUT, $USER, $DB, $SITE;

    if (!isset(get_config('local_geniai', 'apikey')[5])) {
        return;
    } else if (guest_user()->id == $USER->id) {
        return;
    } else if ($USER->id < 2) {
        return;
    }

    $data = [
        'courseid' => \local_geniai\events\event_observers::$courseid,
        'message_01' => get_string('message_01', 'local_geniai', fullname($USER)),
        'manage_capability' => has_capability('local/geniai:manage', context_system::instance())
    ];
    if (\local_geniai\events\event_observers::$courseid) {
        $course = $DB->get_record('course', ['id' => \local_geniai\events\event_observers::$courseid]);
        $data['message_02'] = get_string('message_02_course', 'local_geniai',
            ['moodlename' => $SITE->fullname, 'coursename' => $course->fullname]);
    } else {
        $data['message_02'] = get_string('message_02_home', 'local_geniai');
    }

    echo $OUTPUT->render_from_template("local_geniai/chat", $data);
}
