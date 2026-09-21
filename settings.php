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
 * Settings file.
 *
 * @package   local_geniai
 * @copyright 2024 Eduardo Kraus {@link https://eduardokraus.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

use local_geniai\controller;

defined('MOODLE_INTERNAL') || die;

if ($hassiteconfig) {

    global $CFG, $PAGE, $ADMIN;

    $settings = new admin_settingpage("local_geniai", get_string("pluginname", "local_geniai"));
    $ADMIN->add("localplugins", $settings);

    $models = [
        "none" => get_string("mode_name_none", "local_geniai"),
        "geniai" => get_string("mode_name_geniai", "local_geniai"),
    ];
    $setting = new admin_setting_configselect(
        "local_geniai/mode",
        get_string("mode", "local_geniai"),
        get_string("mode_desc", "local_geniai"),
        "none", $models
    );
    $settings->add($setting);

    $controllers = controller::get_options();
    if (!empty($controllers)) {
        $defaultcontroller = isset($controllers["chatgpt"]) ? "chatgpt" : (string) key($controllers);
        $settings->add(new admin_setting_configselect(
            "local_geniai/controller",
            get_string("controller", "local_geniai"),
            get_string("controller_desc", "local_geniai"),
            $defaultcontroller,
            $controllers
        ));

        // The selected controller is responsible for its own connection/generation settings.
        controller::load_settings($settings);
    }

    // Tutor name.
    $geniainame = get_config("local_geniai", "geniainame");
    if (!isset($geniainame[2])) {
        $geniainame = "Nestor";
    }
    $setting = new admin_setting_configtext(
        "local_geniai/geniainame",
        get_string("geniainame", "local_geniai"),
        get_string("geniainame_desc", "local_geniai"),
        $geniainame);
    $settings->add($setting);

    // Photo agent.
    $setting = new admin_setting_configstoredfile("local_geniai/agentphoto",
        get_string("agentphoto", "local_geniai"),
        get_string("agentphoto_desc", "local_geniai"),
        "agentphoto", 0, ["maxfiles" => 1, "accepted_types" => [".jpeg .jpg .png .svg .tif .tiff .webm"]]);
    $settings->add($setting);

    $modules = [];
    $records = $DB->get_records("modules", ["visible" => 1], "name", "name");
    foreach ($records as $record) {
        if (file_exists("{$CFG->dirroot}/mod/{$record->name}/lib.php")) {
            if (!(plugin_supports("mod", $record->name, FEATURE_MOD_ARCHETYPE) === MOD_ARCHETYPE_SYSTEM)) {
                $modules[$record->name] = get_string("pluginname", $record->name);
            }
        }
    }
    $settings->add(new admin_setting_configmultiselect(
        "local_geniai/modules",
        get_string("modules", "local_geniai", $geniainame),
        get_string("modules_desc", "local_geniai", $geniainame),
        ["glossary", "lesson", "forum", "scorm", "feedback", "survey", "quiz", "assign", "wiki", "lti", "workshop"],
        $modules
    ));

    $settings->add(new admin_setting_configmultiselect(
        "local_geniai/analysis_excluded_plugins",
        get_string("analysis_excluded_plugins", "local_geniai"),
        get_string("analysis_excluded_plugins_desc", "local_geniai"),
        ["chat"],
        $modules
    ));
}
