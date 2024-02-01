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
 * User: Eduardo Kraus
 * Date: 26/10/17
 * Time: 22:46
 */

namespace local_geniai\events;


class event_observers {

    public static $courseid = 0;

    /**
     * @param \core\event\base $event
     *
     * @throws \coding_exception
     * @throws \dml_exception
     */
    public static function course_viewed(\core\event\base $event) {
        $data = $event->get_data();
        self::$courseid = $data['courseid'];
    }
}
