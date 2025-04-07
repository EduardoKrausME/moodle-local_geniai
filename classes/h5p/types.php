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
 * Types create file.
 *
 * @package   local_geniai
 * @copyright 2024 Eduardo Kraus {@link http://eduardokraus.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace local_geniai\h5p;

/**
 * Class types
 *
 * @package local_geniai\h5p
 */
class types {
    /**
     * Function get_types
     *
     * @param int $contextid
     *
     * @return array
     * @throws \coding_exception
     */
    public static function get_types($contextid) {
        global $CFG;

        $data = [
            "return-url" => "{$CFG->wwwroot}/contentbank/index.php?contextid={$contextid}",
            "contextid" => $contextid,
            "unique" => [
                "id" => "InteractiveBook",
                "title" => get_string("h5p-interactivebook-title", "local_geniai"),
                "desc" => get_string("h5p-interactivebook-desc", "local_geniai"),
                "exe" => "https://h5p.org/content-types/interactive-book",
                "create" => "{$CFG->wwwroot}/local/geniai/h5p/create.php?contextid={$contextid}&type=InteractiveBook",
            ],
            "h5ps" => [
                [
                    "id" => "AdvancedText",
                    "title" => get_string("h5p-advancedtext-title", "local_geniai"),
                    "desc" => get_string("h5p-advancedtext-desc", "local_geniai"),
                    "exe" => "https://h5p.org/advancedText",
                    "create" => "{$CFG->wwwroot}/local/geniai/h5p/create.php?contextid={$contextid}&type=AdvancedText",
                ],
                [
                    "id" => "Accordion",
                    "title" => get_string("h5p-accordion-title", "local_geniai"),
                    "desc" => get_string("h5p-accordion-desc", "local_geniai"),
                    "exe" => "https://h5p.org/accordion",
                    "create" => "{$CFG->wwwroot}/local/geniai/h5p/create.php?contextid={$contextid}&type=Accordion",
                ],
                [
                    "id" => "Dialogcards",
                    "title" => get_string("h5p-dialogcards-title", "local_geniai"),
                    "desc" => get_string("h5p-dialogcards-desc", "local_geniai"),
                    "exe" => "https://h5p.org/dialog-cards",
                    "create" => "{$CFG->wwwroot}/local/geniai/h5p/create.php?contextid={$contextid}&type=Dialogcards",
                ],
                [
                    "id" => "QuestionSet",
                    "title" => get_string("h5p-questionset-title", "local_geniai"),
                    "desc" => get_string("h5p-questionset-desc", "local_geniai"),
                    "exe" => "https://h5p.org/question-set",
                    "create" => "{$CFG->wwwroot}/local/geniai/h5p/create.php?contextid={$contextid}&type=QuestionSet",
                ],
                [
                    "id" => "DragText",
                    "title" => get_string("h5p-dragtext-title", "local_geniai"),
                    "desc" => get_string("h5p-dragtext-desc", "local_geniai"),
                    "exe" => "https://h5p.org/drag-the-words",
                    "create" => "{$CFG->wwwroot}/local/geniai/h5p/create.php?contextid={$contextid}&type=DragText",
                ],
            ],
        ];

        return $data;
    }
}
