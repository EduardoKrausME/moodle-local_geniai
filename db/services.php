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
 * services file.
 *
 * @package   local_geniai
 * @copyright 2024 Eduardo Kraus {@link https://eduardokraus.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

$functions = [
    "local_geniai_chat" => [
        "classpath" => "local/geniai/classes/external/chat.php",
        "classname" => "\\local_geniai\\external\\chat",
        "methodname" => "api",
        "description" => "ChatGPT API",
        "type" => "write",
        "ajax" => true,
    ],
    "local_geniai_history" => [
        "classpath" => "local/geniai/classes/external/history.php",
        "classname" => "\\local_geniai\\external\\history",
        "methodname" => "api",
        "description" => "Brings the conversation history",
        "type" => "write",
        "ajax" => true,
    ],
];
