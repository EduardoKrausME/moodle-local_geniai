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
 * editor_tiny file.
 *
 * @package     local_geniai
 * @copyright   2024 Eduardo Kraus https://eduardokraus.com/
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace local_geniai\editor;

/**
 * Class editor_tiny
 *
 * @package local_geniai\editor
 */
class editor_tiny extends \editor_tiny\editor {
    /**
     * Use this editor for given element.
     *
     * @return string
     * @throws \dml_exception
     */
    public function tyni_editor_config() {
        global $PAGE;

        $options = ["noclean" => true];
        $context = $PAGE->context;

        if (isset($options["context"]) && ($options["context"] instanceof \context)) {
            // A different context was provided.
            // Use that instead.
            $context = $options["context"];
        }

        // Generate the configuration for this editor.
        $siteconfig = get_config("editor_tiny");
        $config = (object)[
            // The URL to the CSS file for the editor.
            "css" => $PAGE->theme->editor_css_url()->out(false),

            // The current context for this page or editor.
            "context" => $context->id,

            // File picker options.
            "filepicker" => [],

            "currentLanguage" => current_language(),

            "branding" => property_exists($siteconfig, "branding") ? !empty($siteconfig->branding) : true,

            // Language options.
            "language" => [
                "currentlang" => current_language(),
                "installed" => get_string_manager()->get_list_of_translations(true),
                "available" => get_string_manager()->get_list_of_languages(),
            ],

            // Placeholder selectors.
            // Some contents (Example: placeholder elements) are only shown in the editor, and not to users. It is unrelated to the
            // real display. We created a list of placeholder selectors, so we can decide to or not to apply rules, styles... to
            // these elements.
            // The default of this list will be empty.
            // Other plugins can register their placeholder elements to placeholderSelectors list by calling
            // editor_tiny/options::registerPlaceholderSelectors.
            "placeholderSelectors" => [],

            // Plugin configuration.
            "plugins" => $this->manager->get_plugin_configuration($context, $options, [], $this),

            // Nest menu inside parent DOM.
            "nestedmenu" => true,
        ];

        if (defined("BEHAT_SITE_RUNNING") && BEHAT_SITE_RUNNING) {
            // Add sample selectors for Behat test.
            $config->placeholderSelectors = [".behat-tinymce-placeholder"];
        }

        $config = convert_to_array($config);
        unset($config["plugins"]["tiny_h5p/plugin"]);
        return json_encode($config);
    }
}
