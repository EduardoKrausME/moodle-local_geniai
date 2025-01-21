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
 * Index file.
 *
 * @package   local_geniai
 * @copyright 2024 Eduardo Kraus {@link http://eduardokraus.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

use local_geniai\local\h5p\itens;
use local_geniai\local\h5p\page_header;
use local_geniai\local\h5p\types;
use local_geniai\local\util\release;

require("../../../config.php");

require_login();

$contextid = optional_param("contextid", \context_system::instance()->id, PARAM_INT);
$context = context::instance_by_id($contextid, MUST_EXIST);

$cburl = new moodle_url("/local/geniai/h5p/index.php", $_GET);
$header = new page_header();
$header->header($cburl, $contextid, $context);
$PAGE->set_title($header->get_title());

echo $OUTPUT->header();
echo $OUTPUT->heading($header->get_title(), 2);

echo $OUTPUT->render_from_template("local_geniai/h5p-index", [
    "types" => types::get_types($contextid),
    "itens" => itens::get_itens($contextid),
    "user_lang" => isset($SESSION->lang) ? $SESSION->lang : $USER->lang,
]);

$PAGE->requires->strings_for_js(["h5p-readmore", "h5p-page-title"], "local_geniai");
$PAGE->requires->js_call_amd("local_geniai/h5p-index", "readmore", [$COURSE->id, release::version()]);

echo $OUTPUT->footer();
