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

defined('MOODLE_INTERNAL') || die;
ob_start();

if ($hassiteconfig) {

    global $CFG, $PAGE;

    if (!$PAGE->requires->is_head_done()) {
        $PAGE->requires->jquery();
    }

    $settings = new admin_settingpage('local_geniai', get_string('pluginname', 'local_geniai'));

    $ADMIN->add('localplugins', $settings);

    $setting = new admin_setting_configtext(
        'local_geniai/apikey',
        get_string('apikey', 'local_geniai'),
        get_string('apikeydesc', 'local_geniai'),
        '');
    $settings->add($setting);

    $setting = new admin_setting_configtext(
        'local_geniai/model',
        get_string('model', 'local_geniai'),
        get_string('modeldesc', 'local_geniai'),
        'gpt-4'
    );
    $settings->add($setting);

    $settings->add(new admin_setting_configtextarea(
        'local_geniai/prompt',
        get_string('prompt', 'local_geniai'),
        get_string('promptdesc', 'local_geniai'),
        get_string('model_default', 'local_geniai'),
        PARAM_TEXT
    ));
}
