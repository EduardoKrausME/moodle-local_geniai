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
 * @copyright 2024 Eduardo Kraus {@link http://eduardokraus.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

if ($hassiteconfig) {

    global $CFG, $PAGE;

    $settings = new admin_settingpage("local_geniai", get_string("pluginname", "local_geniai"));

    $ADMIN->add("localplugins", $settings);

    $models = [
        "none" => get_string("mode_name_none", "local_geniai"),
        "assistant" => get_string("mode_name_assistant", "local_geniai"),
        "geniai" => get_string("mode_name_geniai", "local_geniai"),
    ];
    $setting = new admin_setting_configselect(
        "local_geniai/mode",
        get_string("mode", "local_geniai"),
        get_string("mode_desc", "local_geniai"),
        "none", $models
    );
    $settings->add($setting);


    $apikey = get_config("local_geniai", "apikey");
    if (isset($apikey[12])) {
        $setting = new admin_setting_configpasswordunmask(
            "local_geniai/apikey",
            get_string("apikey", "local_geniai"),
            get_string("apikey_desc", "local_geniai"),
            "");
        $settings->add($setting);
    } else {
        $setting = new admin_setting_configtext(
            "local_geniai/apikey",
            get_string("apikey", "local_geniai"),
            get_string("apikey_desc", "local_geniai"),
            "");
        $settings->add($setting);
    }

    $geniainame = get_config("local_geniai", "geniainame");
    if (!isset($geniainame[2])) {
        $geniainame = "Tutor GeniAI";
    }
    $setting = new admin_setting_configtext(
        "local_geniai/geniainame",
        get_string("geniainame", "local_geniai"),
        get_string("geniainame_desc", "local_geniai"),
        "Tutor GeniAI");
    $settings->add($setting);

    $models = [
        "gpt-4" => "gpt-4",
        "gpt-4o-mini"=>"gpt-4o-mini",
        "gpt-4-32k" => "gpt-4-32k",
        "gpt-4-turbo" => "gpt-4-turbo",
    ];
    $setting = new admin_setting_configselect(
        "local_geniai/model",
        get_string("model", "local_geniai"),
        get_string("model_desc", "local_geniai"),
        "gpt-4o-mini", $models
    );
    $settings->add($setting);

    $voices = [
        "alloy" => "Alloy",
        "echo" => "Echo",
        "fable" => "Fable",
        "onyx" => "Onyx",
        "nova" => "Nova",
        "shimmer" => "Shimmer",
    ];
    $voicedesc = preg_replace('/\s+</s', "<", '
            <table>
                <tr>
                    <th style="text-align: right;">Alloy:</th>
                    <td><audio src="https://cdn.openai.com/API/docs/audio/alloy.wav" controls></audio></td>
                </tr>
                <tr>
                    <th style="text-align: right;">Echo:</th>
                    <td><audio src="https://cdn.openai.com/API/docs/audio/echo.wav" controls></audio></td>
                </tr>
                <tr>
                    <th style="text-align: right;">Fable:</th>
                    <td><audio src="https://cdn.openai.com/API/docs/audio/fable.wav" controls></audio></td>
                </tr>
                <tr>
                    <th style="text-align: right;">Onyx:</th>
                    <td><audio src="https://cdn.openai.com/API/docs/audio/onyx.wav" controls></audio></td>
                </tr>
                <tr>
                    <th style="text-align: right;">Nova:</th>
                    <td><audio src="https://cdn.openai.com/API/docs/audio/nova.wav" controls></audio></td>
                </tr>
                <tr>
                    <th style="text-align: right;">Shimmer:</th>
                    <td><audio src="https://cdn.openai.com/API/docs/audio/shimmer.wav" controls></audio></td>
                </tr>
            </table>');
    $setting = new admin_setting_configselect(
        "local_geniai/voice",
        get_string("voice", "local_geniai"),
        $voicedesc,
        "alloy", $voices
    );
    $settings->add($setting);

    $cases = [
        "chatbot" => get_string("caseuse_chatbot", "local_geniai"),
        "creative" => get_string("caseuse_creative", "local_geniai"),
        "balanced" => get_string("caseuse_balanced", "local_geniai"),
        "precise" => get_string("caseuse_precise", "local_geniai"),
        "exploration" => get_string("caseuse_exploration", "local_geniai"),
        "formal" => get_string("caseuse_formal", "local_geniai"),
        "informal" => get_string("caseuse_informal", "local_geniai"),
    ];
    $casedesc = $OUTPUT->render_from_template("local_geniai/settings_casedesc", []);
    $settings->add(new admin_setting_configselect(
        "local_geniai/case",
        get_string("case", "local_geniai"),
        $casedesc,
        "chatbot",
        $cases
    ));

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

    $setting = new admin_setting_configtext(
        "local_geniai/max_tokens",
        get_string("max_tokens", "local_geniai"),
        get_string("max_tokens_desc", "local_geniai"),
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
        "local_geniai/frequency_penalty",
        get_string("frequency_penalty", "local_geniai"),
        get_string("frequency_penalty_desc", "local_geniai"),
        "0.0", $penalty);
    $settings->add($setting);

    $setting = new admin_setting_configselect(
        "local_geniai/presence_penalty",
        get_string("presence_penalty", "local_geniai"),
        get_string("presence_penalty_desc", "local_geniai"),
        "0.0", $penalty);
    $settings->add($setting);
}
