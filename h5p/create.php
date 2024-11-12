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
 * Creat file.
 *
 * @package    local_geniai
 * @copyright  2024 Eduardo Kraus {@link http://eduardokraus.com}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

use local_geniai\local\h5p\page_create;
use local_geniai\local\h5p\page_header;
use local_geniai\local\vo\local_geniai_h5p;
use local_kopere_dashboard\html\form;

require("../../../config.php");

require_login();

$id = optional_param("type", 0, PARAM_INT);
if ($id) {
    /** @var local_geniai_h5p $h5p */
    $h5p = $DB->get_record("local_geniai_h5p", ["id" => $id]);
    $contextid = $h5p->contextid;
    $type = $h5p->type;
} else {
    $contextid = optional_param("contextid", \context_system::instance()->id, PARAM_INT);
    $type = optional_param("type", "", PARAM_TEXT);
    $h5p = new local_geniai_h5p();

    $h5p->type = $type;
    $h5p->contextid = $contextid;
}
$context = context::instance_by_id($contextid, MUST_EXIST);

$apikey = get_config('local_geniai', 'apikey');
if (!isset($apikey[9])) {
    $PAGE->set_context(context_system::instance());
    $PAGE->set_url(new moodle_url("/local/geniai/h5p/index.php", ["contextid" => $contextid, "type" => $type]));
    echo $OUTPUT->header();
    $message = get_string("h5p-no-apikey", "local_geniai", "{$CFG->wwwroot}/admin/settings.php?section=local_geniai");
    \core\notification::add($message, 'error');
    echo $OUTPUT->footer();
    die;
}

$header = new page_header();
$header->header($contextid, $context, $type);

echo $OUTPUT->header();
echo $OUTPUT->box_start("kopere_dashboard_div geniai-page-maxwidth-900");
echo $OUTPUT->heading($header->getTitle(), 2);

$page = new page_create();
$page->setH5p($h5p);
if (!form::check_post()) {
    $page->create_page();
} else {
    $page->save();
}

echo $OUTPUT->box_end();
echo $OUTPUT->footer();
