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
 * Report for geniai.
 *
 * @package    geniai_geniai
 * @copyright  2024 Eduardo kraus (http://eduardokraus.com)
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once('../../config.php');
require_once($CFG->libdir . '/tablelib.php');
require_once(__DIR__ . "/classes/report/geniai_view.php");

require_login();
require_capability('local/geniai:manage', context_system::instance());

$table = new \local_geniai\report\geniai_view("geniai_report");

if (!$table->is_downloading()) {
    $PAGE->set_context(context_system::instance());
    $PAGE->set_url('/local/geniai/report.php');
    $PAGE->set_title(get_string('modulename', 'local_geniai'));
    $PAGE->set_heading(get_string('modulename', 'local_geniai'));
    echo $OUTPUT->header();

    echo $OUTPUT->heading(get_string('report_filename', 'local_geniai'), 2, 'main', 'geniaiheading');
    echo get_string('report_info', 'local_geniai');
}

$table->define_baseurl("{$CFG->wwwroot}/local/geniai/report.php");
$table->out(40, true);

if (!$table->is_downloading()) {
    echo $OUTPUT->footer();
}

//redirect();
