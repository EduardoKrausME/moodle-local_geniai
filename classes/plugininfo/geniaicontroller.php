<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.

namespace local_geniai\plugininfo;

use core\plugininfo\base;

/**
 * Plugin information for GenAI controller subplugins.
 *
 * @package   local_geniai
 * @copyright 2026 Eduardo Kraus
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class geniaicontroller extends base {

    /**
     * Allows controller subplugins to be uninstalled.
     *
     * @return bool
     */
    public function is_uninstall_allowed() {
        return true;
    }
}