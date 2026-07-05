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
 * h5p.js
 *
 * @package   local_geniai
 * @copyright 2026 Eduardo Kraus {@link https://eduardokraus.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

define(["jquery", 'core/ajax', 'core/notification'], function($, ajax, notification) {
    return {
        init: function(contextid) {
            var botao;

            if (document.getElementById("page-contentbank")) {

                botao = `
                    <a href="${M.cfg.wwwroot}/local/geniai/h5p/index.php?contextid=${contextid}" 
                       class="d-flex align-items-center btn btn-dark text-nowrap mr-1">
                        ${M.util.get_string("h5p-manager", "local_geniai")}
                    </a>`;
                $("#page-contentbank .content-bank-container .cb-toolbar-container").prepend(botao);
            }

            if (document.getElementById("page-mod-h5pactivity-mod")) {
                botao = `
                    <div>
                        <a href="${M.cfg.wwwroot}/local/geniai/h5p/index.php?contextid=${contextid}" target="_blank"
                           class="d-flex align-items-center btn btn-dark text-nowrap">
                            ${M.util.get_string("h5p-manager", "local_geniai")}
                        </a>
                    </div>`;
                $("#id_error_contentbank").before(botao);
            }

            if (document.getElementById("page-mod-scorm-mod")) {
                botao = `
                    <div>
                        <a href="${M.cfg.wwwroot}/local/geniai/h5p/index.php?contextid=${contextid}&scorm=true" target="_blank"
                           class="d-flex align-items-center btn btn-dark text-nowrap">
                            ${M.util.get_string("h5p-manager-scorm", "local_geniai")}
                        </a>
                    </div>`;
                $("#id_packagefile_fieldset").before(botao);
            }
        }
    };
});
