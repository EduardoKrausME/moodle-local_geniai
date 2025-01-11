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
 * Itens file.
 *
 * @package     local_geniai
 * @copyright   2024 Eduardo Kraus https://eduardokraus.com/
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace local_geniai\local\h5p;

/**
 * Class itens
 *
 * @package local_geniai\local\h5p
 */
class itens {
    /**
     * Function get_itens
     *
     * @param int $contextid
     *
     * @return array
     * @throws \dml_exception
     */
    public static function get_itens($contextid) {
        global $DB;

        $h5ps = $DB->get_records("local_geniai_h5p",
            ["contextid" => $contextid],
            "title ASC", "id, contextid, contentbanktid, title, type");

        $h5ps = array_values($h5ps);

        return $h5ps;
    }
}
