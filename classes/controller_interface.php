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

namespace local_geniai;

/**
 * Contract implemented by GeniAI controller subplugins.
 *
 * @package   local_geniai
 * @copyright 2026 Eduardo Kraus
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
interface controller_interface {
    /**
     * Generate a completion.
     *
     * @param array $messages
     * @param string $replacemodel
     * @return array
     */
    public function completions(array $messages, $replacemodel = "");

    /**
     * Return whether this controller has the minimum required configuration.
     *
     * @return bool
     */
    public function is_configured();
}
