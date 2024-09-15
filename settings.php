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
 * @package    local_geniai
 * @copyright  2024 Eduardo Kraus {@link http://eduardokraus.com}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

if ($hassiteconfig) {

    global $CFG, $PAGE;

    $settings = new admin_settingpage('local_geniai', get_string('pluginname', 'local_geniai'));

    $ADMIN->add('localplugins', $settings);

    $setting = new admin_setting_configpasswordunmask(
        'local_geniai/apikey',
        get_string('apikey', 'local_geniai'),
        get_string('apikeydesc', 'local_geniai'),
        '');
    $settings->add($setting);

    $geniainame = get_config('local_geniai', 'geniainame');
    if (!isset($geniainame[2])) {
        $geniainame = "GeniAI";
    }
    $setting = new admin_setting_configtext(
        'local_geniai/geniainame',
        get_string('geniainame', 'local_geniai'),
        get_string('geniainamedesc', 'local_geniai'),
        'GeniAI');
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

    $cases = [
        'text_code_generation' => get_string('case_text_code_generation', 'local_geniai'),
        'data_analysis_script' => get_string('case_data_analysis_script', 'local_geniai'),
        'text_comment_generation' => get_string('case_text_comment_generation', 'local_geniai'),
        'chatbot' => get_string('case_chatbot', 'local_geniai'),
        'exploratory_writing' => get_string('case_exploratory_writing', 'local_geniai'),
        'creative_writing' => get_string('case_creative_writing', 'local_geniai'),
        'idea_brainstorming' => get_string('case_idea_brainstorming', 'local_geniai'),
        'fictitious_dialogue_generation' => get_string('case_fictitious_dialogue_generation', 'local_geniai'),
        'surreal_story_generation' => get_string('case_surreal_story_generation', 'local_geniai'),
    ];
    $settings->add(new admin_setting_configselect(
        'local_geniai/case',
        get_string('case', 'local_geniai'),
        get_string('casedesc', 'local_geniai'),
        "chatbot",
        $cases
    ));

    $modules = [];
    $records = $DB->get_records('modules', ['visible' => 1], 'name', 'name');
    foreach ($records as $record) {
        if (file_exists("{$CFG->dirroot}/mod/{$record->name}/lib.php")) {
            if (!(plugin_supports('mod', $record->name, FEATURE_MOD_ARCHETYPE) === MOD_ARCHETYPE_SYSTEM)) {
                $modules[$record->name] = get_string('pluginname', $record->name);
            }
        }
    }
    $settings->add(new admin_setting_configmultiselect(
        'local_geniai/modules',
        get_string('modules', 'local_geniai', $geniainame),
        get_string('modulesdesc', 'local_geniai', $geniainame),
        ["glossary", "lesson", "forum", "scorm", "feedback", "survey", "quiz", "assign", "wiki", "lti", "workshop"],
        $modules
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
