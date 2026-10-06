<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.

/**
 * Services file.
 *
 * @package   local_geniai
 * @copyright 2026 Eduardo Kraus {@link https://eduardokraus.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

$functions = [
    "local_geniai_chat" => [
        "classpath" => 'local/geniai/classes/external/chat.php',
        "classname" => '\\local_geniai\\external\\chat',
        "methodname" => "api",
        "description" => 'ChatGPT API',
        "type" => "write",
        "ajax" => true,
    ],
    "local_geniai_history" => [
        "classpath" => 'local/geniai/classes/external/history.php',
        "classname" => '\\local_geniai\\external\\history',
        "methodname" => "api",
        "description" => 'Brings the conversation history',
        "type" => "write",
        "ajax" => true,
    ],
];
