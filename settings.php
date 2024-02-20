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
 * @package    local_geniai
 * @copyright  2024 Eduardo Kraus {@link http://eduardokraus.com}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

if ($hassiteconfig) {

    global $CFG, $PAGE;

    $settings = new admin_settingpage('local_geniai', get_string('pluginname', 'local_geniai'));

    $ADMIN->add('localplugins', $settings);

    $setting = new admin_setting_configtext(
        'local_geniai/apikey',
        get_string('apikey', 'local_geniai'),
        get_string('apikeydesc', 'local_geniai'),
        '');
    $settings->add($setting);

    $models = [
        'gpt-4' => 'gpt-4',
        'gpt-4-32k' => 'gpt-4-32k',
        'gpt-4-turbo-preview' => 'gpt-4-turbo-preview',
        'gpt-3.5-turbo' => 'gpt-3.5-turbo',
        'gpt-3.5-turbo-16k' => 'gpt-3.5-turbo-16k',
    ];
    $setting = new admin_setting_configselect(
        'local_geniai/model',
        get_string('model', 'local_geniai'),
        get_string('modeldesc', 'local_geniai'),
        'gpt-4', $models
    );
    $settings->add($setting);

    $settings->add(new admin_setting_configtextarea(
        'local_geniai/prompt',
        get_string('prompt', 'local_geniai'),
        get_string('promptdesc', 'local_geniai'),
        get_string('model_default', 'local_geniai'),
        PARAM_TEXT
    ));

    $temperatures = [
        "0.1" => "0.1",
        "0.2" => "0.2",
        "0.3" => "0.3",
        "0.4" => "0.4",
        "0.5" => "0.5",
        "0.6" => "0.6",
        "0.7" => "0.7",
        "0.8" => "0.8",
        "0.9" => "0.9",
        "1" => "1",
    ];
    $settings->add(new admin_setting_configselect(
        'local_geniai/temperature',
        get_string('temperature', 'local_geniai'),
        get_string('temperaturedesc', 'local_geniai'),
        "0.5",
        $temperatures
    ));

    $topp = [
        "0.1" => "0.1",
        "0.2" => "0.2",
        "0.3" => "0.3",
        "0.4" => "0.4",
        "0.5" => "0.5",
        "0.6" => "0.6",
        "0.7" => "0.7",
        "0.8" => "0.8",
        "0.9" => "0.9",
        "1" => "1",
    ];
    $settings->add(new admin_setting_configselect(
        'local_geniai/top_p',
        get_string('top_p', 'local_geniai'),
        get_string('top_pdesc', 'local_geniai'),
        "0.5",
        $topp
    ));

    $setting = new admin_setting_configtext(
        'local_geniai/max_tokens',
        get_string('max_tokens', 'local_geniai'),
        get_string('max_tokensdesc', 'local_geniai'),
        200, PARAM_INT);
    $settings->add($setting);

    $penalty = [
        "-2.0" => "-2.0",
        "-1.9" => "-1.9",
        "-1.8" => "-1.8",
        "-1.7" => "-1.7",
        "-1.6" => "-1.6",
        "-1.5" => "-1.5",
        "-1.4" => "-1.4",
        "-1.3" => "-1.3",
        "-1.2" => "-1.2",
        "-1.1" => "-1.1",
        "-1.0" => "-1.0",
        "-0.9" => "-0.9",
        "-0.8" => "-0.8",
        "-0.7" => "-0.7",
        "-0.6" => "-0.6",
        "-0.5" => "-0.5",
        "-0.4" => "-0.4",
        "-0.3" => "-0.3",
        "-0.2" => "-0.2",
        "-0.1" => "-0.1",
        "0.0" => "0.0",
        "0.1" => "0.1",
        "0.2" => "0.2",
        "0.3" => "0.3",
        "0.4" => "0.4",
        "0.5" => "0.5",
        "0.6" => "0.6",
        "0.7" => "0.7",
        "0.8" => "0.8",
        "0.9" => "0.9",
        "1.0" => "1.0",
        "1.1" => "1.1",
        "1.2" => "1.2",
        "1.3" => "1.3",
        "1.4" => "1.4",
        "1.5" => "1.5",
        "1.6" => "1.6",
        "1.7" => "1.7",
        "1.8" => "1.8",
        "1.9" => "1.9",
        "2.0" => "2.0",
    ];
    $setting = new admin_setting_configselect(
        'local_geniai/frequency_penalty',
        get_string('frequency_penalty', 'local_geniai'),
        get_string('frequency_penaltydesc', 'local_geniai'),
        "0.0", $penalty);
    $settings->add($setting);

    $setting = new admin_setting_configselect(
        'local_geniai/presence_penalty',
        get_string('presence_penalty', 'local_geniai'),
        get_string('presence_penaltydesc', 'local_geniai'),
        "0.0", $penalty);
    $settings->add($setting);
}
