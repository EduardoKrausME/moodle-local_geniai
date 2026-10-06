<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.

/**
 * Access definitions.
 *
 * @package   local_geniai
 * @copyright 2024 Eduardo Kraus {@link https://eduardokraus.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

$capabilities = [
    'local/geniai:view' => [
        "riskbitmask" => RISK_PERSONAL,
        "captype" => "read",
        "contextlevel" => CONTEXT_COURSE,
        "archetypes" => [
            "student" => CAP_ALLOW,
            "teacher" => CAP_ALLOW,
            "editingteacher" => CAP_ALLOW,
            "manager" => CAP_ALLOW,
        ],
    ],
    'local/geniai:manage' => [
        "riskbitmask" => RISK_CONFIG,
        "captype" => "write",
        "contextlevel" => CONTEXT_SYSTEM,
        "archetypes" => [
            "manager" => CAP_ALLOW,
        ],
    ],
];
