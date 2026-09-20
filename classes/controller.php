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

use coding_exception;
use core_component;

/**
 * Connects local_geniai to the selected controller subplugin.
 *
 * @package   local_geniai
 * @copyright 2026 Eduardo Kraus
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class controller {
    /** @var string Subplugin type. */
    const PLUGIN_TYPE = "geniaicontroller";

    /** @var controller_interface|null Cached controller instance. */
    private static $instance = null;

    /**
     * Return installed controller subplugins.
     *
     * @return array
     */
    public static function get_plugins() {
        return core_component::get_plugin_list(self::PLUGIN_TYPE);
    }

    /**
     * Return controller options for admin settings.
     *
     * @return array
     */
    public static function get_options() {
        $options = [];

        foreach (self::get_plugins() as $name => $path) {
            $component = self::PLUGIN_TYPE . "_" . $name;
            $options[$name] = get_string("pluginname", $component);
        }

        return $options;
    }

    /**
     * Return the selected controller name.
     *
     * @return string
     */
    public static function get_name() {
        $plugins = self::get_plugins();
        $name = (string) get_config("local_geniai", "controller");

        if ($name !== "" && isset($plugins[$name])) {
            return $name;
        }

        if (isset($plugins["chatgpt"])) {
            return "chatgpt";
        }

        if (!empty($plugins)) {
            reset($plugins);
            return (string) key($plugins);
        }

        return "";
    }

    /**
     * Return the selected controller instance.
     *
     * @return controller_interface
     * @throws coding_exception
     */
    public static function get_instance() {
        $name = self::get_name();

        if ($name === "") {
            throw new coding_exception("No GeniAI controller subplugin is installed.");
        }

        if (self::$instance !== null) {
            return self::$instance;
        }

        $classname = "\\" . self::PLUGIN_TYPE . "_" . $name . "\\controller";
        if (!class_exists($classname)) {
            throw new coding_exception("Invalid GeniAI controller class: {$classname}");
        }

        $instance = new $classname();
        if (!($instance instanceof controller_interface)) {
            throw new coding_exception("The GeniAI controller {$classname} must implement \\local_geniai\\controller_interface.");
        }

        self::$instance = $instance;
        return self::$instance;
    }

    /**
     * Generate a completion using the selected controller.
     *
     * @param array $messages
     * @param string $replacemodel
     * @return array
     */
    public static function completions(array $messages, $replacemodel = "") {
        return self::get_instance()->completions($messages, $replacemodel);
    }

    /**
     * Check whether the selected controller is configured.
     *
     * @return bool
     */
    public static function is_configured() {
        try {
            return self::get_instance()->is_configured();
        } catch (\Throwable $e) {
            return false;
        }
    }

    /**
     * Load settings.php from the selected controller.
     *
     * The required file receives the parent admin_settingpage in $settings.
     *
     * @param \admin_settingpage $settings
     * @return void
     */
    public static function load_settings(\admin_settingpage $settings) {
        $name = self::get_name();
        $plugins = self::get_plugins();

        if ($name === "" || !isset($plugins[$name])) {
            return;
        }

        $settingsfile = $plugins[$name] . "/settings.php";
        if (is_readable($settingsfile)) {
            require_once($settingsfile);
        }
    }
}
