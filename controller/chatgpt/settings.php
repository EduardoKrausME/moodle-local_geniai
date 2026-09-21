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
 * settings.php
 *
 * @package   geniaicontroller_chatgpt
 * @copyright 2026 Eduardo Kraus {@link https://eduardokraus.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

if (!isset($settings) || !($settings instanceof admin_settingpage)) {
    return;
}

$settings->add(new admin_setting_heading(
    "geniaicontroller_chatgpt/heading",
    get_string("pluginname", "geniaicontroller_chatgpt"),
    get_string("settings_desc", "geniaicontroller_chatgpt")
));

$apikey = get_config("local_geniai", "apikey");
if (isset($apikey[12])) {
    $settings->add(new admin_setting_configpasswordunmask(
        "local_geniai/apikey",
        get_string("apikey", "local_geniai"),
        get_string("apikey_desc", "local_geniai"),
        ""
    ));
} else {
    $settings->add(new admin_setting_configtext(
        "local_geniai/apikey",
        get_string("apikey", "local_geniai"),
        get_string("apikey_desc", "local_geniai"),
        ""
    ));
}

$models = [
    "gpt-5.4" => "gpt-5.4",
    "gpt-5.4-mini" => "gpt-5.4-mini",
    "gpt-5.4-nano" => "gpt-5.4-nano",
    "gpt-4" => "gpt-4",
    "gpt-4o-mini" => "gpt-4o-mini",
    "gpt-4-32k" => "gpt-4-32k",
    "gpt-4-turbo" => "gpt-4-turbo",
];
$settings->add(new admin_setting_configselect(
    "local_geniai/model",
    get_string("model", "local_geniai"),
    get_string("model_desc", "local_geniai"),
    "gpt-5.4-mini",
    $models
));

$cases = [
    "chatbot" => get_string("caseuse_chatbot", "local_geniai"),
    "creative" => get_string("caseuse_creative", "local_geniai"),
    "balanced" => get_string("caseuse_balanced", "local_geniai"),
    "precise" => get_string("caseuse_precise", "local_geniai"),
    "exploration" => get_string("caseuse_exploration", "local_geniai"),
    "formal" => get_string("caseuse_formal", "local_geniai"),
    "informal" => get_string("caseuse_informal", "local_geniai"),
];
if (isset($OUTPUT)) {
    $casedesc = $OUTPUT->render_from_template("local_geniai/settings_casedesc", []);
    $settings->add(new admin_setting_configselect(
        "local_geniai/case",
        get_string("case", "local_geniai"),
        $casedesc,
        "chatbot",
        $cases
    ));
}

$penalty = [];
for ($value = -20; $value <= 20; $value++) {
    $formatted = number_format($value / 10, 1, ".", "");
    $penalty[$formatted] = $formatted;
}

$settings->add(new admin_setting_configselect(
    "local_geniai/frequency_penalty",
    get_string("frequency_penalty", "local_geniai"),
    get_string("frequency_penalty_desc", "local_geniai"),
    "0.0",
    $penalty
));

$settings->add(new admin_setting_configselect(
    "local_geniai/presence_penalty",
    get_string("presence_penalty", "local_geniai"),
    get_string("presence_penalty_desc", "local_geniai"),
    "0.0",
    $penalty
));
