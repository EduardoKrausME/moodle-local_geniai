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
 * local_geniai_h5p file.
 *
 * @package    local_geniai
 * @copyright  2024 Eduardo Kraus {@link http://eduardokraus.com}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace local_geniai\local\vo;


/**
 * Class local_geniai_h5p
 *
 * @package local_geniai\local\vo
 */
class local_geniai_h5p {

    /** @var int */
    public $id = 0;

    /** @var int */
    public $contextid = 0;

    /** @var int */
    public $contentbanktid = 0;

    /** @var string */
    public $title = "";

    /** @var int */
    public $filebase = 0;

    /** @var string */
    public $textbase = "";

    /** @var int */
    public $modulebase = "";

    /** @var string */
    public $startbase = "";

    /** @var string */
    public $type = "";

    /** @var string */
    public $timecreated = "";
}
