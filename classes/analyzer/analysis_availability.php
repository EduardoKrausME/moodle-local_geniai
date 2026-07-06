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
 * Central rules that decide whether an activity can be analyzed.
 *
 * @package   local_geniai
 * @copyright 2024 Eduardo Kraus {@link https://eduardokraus.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace local_geniai\analyzer;

use cm_info;
use core_text;
use stdClass;

/**
 * Class analysis_availability
 */
class analysis_availability {
    /**
     * Decide whether a course module should be analyzed.
     *
     * @param \cm_info $cm Course module info.
     * @return bool
     * @throws \coding_exception
     * @throws \dml_exception
     */
    public static function can_analyze_cm(cm_info $cm) {
        if (empty($cm->uservisible)) {
            return false;
        }

        if (!empty($cm->deletioninprogress)) {
            return false;
        }

        if (self::is_excluded_plugin($cm->modname)) {
            return false;
        }

        if (!self::plugin_supports_analysis($cm->modname)) {
            return false;
        }

        return true;
    }

    /**
     * Return all analyzable course module IDs for the current course view.
     *
     * @param \stdClass $course Course record.
     * @param int $userid User ID.
     * @return int[]
     * @throws \moodle_exception
     */
    public static function get_analyzable_cmids(stdClass $course, $userid) {
        $modinfo = get_fast_modinfo($course, $userid);
        $cmids = [];

        foreach ($modinfo->get_cms() as $cm) {
            if (self::can_analyze_cm($cm)) {
                $cmids[] = (int) $cm->id;
            }
        }

        return $cmids;
    }

    /**
     * Check if a mod plugin explicitly disabled GeniAI analysis.
     *
     * @param string $modname Module name, with or without mod_ prefix.
     * @return bool
     * @throws \coding_exception
     */
    public static function plugin_supports_analysis($modname) {
        $modname = self::normalize_plugin_name($modname);

        if ($modname === "") {
            return false;
        }

        if (plugin_supports("mod", $modname, FEATURE_MOD_ARCHETYPE) === MOD_ARCHETYPE_SYSTEM) {
            return false;
        }

        return plugin_supports("mod", $modname, "local_geniai_analysis", true) !== false;
    }

    /**
     * Check if the activity type is excluded by the admin setting.
     *
     * @param string $modname Module name, with or without mod_ prefix.
     * @return bool
     * @throws \dml_exception
     */
    public static function is_excluded_plugin($modname) {
        $modname = self::normalize_plugin_name($modname);

        if ($modname === "") {
            return true;
        }

        return in_array($modname, self::get_excluded_plugins(), true);
    }

    /**
     * Get the normalized plugin names excluded by configuration.
     *
     * @return string[]
     * @throws \dml_exception
     */
    public static function get_excluded_plugins() {
        static $analysisexcludedplugins;
        if ($analysisexcludedplugins) {
            return $analysisexcludedplugins;
        }

        $analysisexcludedplugins = [
            "chat",
            "certificatebeautiful",
            "childcourse",
            "folder",
            "lti",
            "pdfprotect",
            "resource",
            "scorm",
            "supervideo",
            "url",
            "feedback",
        ];

        $configanalysisexcludedplugins = get_config("local_geniai", "analysis_excluded_plugins");
        $analysisexcludedplugins += explode(",", $configanalysisexcludedplugins);

        $clean = [];
        foreach ($analysisexcludedplugins as $plugin) {
            $plugin = self::normalize_plugin_name($plugin);
            if ($plugin !== "") {
                $clean[$plugin] = true;
            }
        }

        $analysisexcludedplugins = array_keys($clean);
        return $analysisexcludedplugins;
    }

    /**
     * Normalize a module/plugin name for comparison.
     *
     * @param string $modname Module name.
     * @return string
     */
    private static function normalize_plugin_name($modname) {
        $modname = trim(core_text::strtolower((string) $modname));

        if (strpos($modname, "mod_") === 0) {
            $modname = substr($modname, 4);
        }

        return $modname;
    }
}
