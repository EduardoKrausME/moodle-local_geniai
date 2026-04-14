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
 * @package   local_geniai
 * @copyright 2024 Eduardo Kraus {@link https://eduardokraus.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once("../../config.php");

require_login();
require_capability("local/geniai:manage", context_system::instance());

$action = optional_param("action", 0, PARAM_INT);

if ($action === 1) {
    header("Content-Type: text/csv");
    header("Content-Disposition: attachment; filename=\"usage.csv\"");

    $usages = $DB->get_records("local_geniai_usage");
    $output = fopen("php://output", "w");

    foreach ($usages as $usage) {
        fputcsv($output, [
            $usage->send,
            $usage->receive,
            $usage->model,
            $usage->prompt_tokens,
            $usage->completion_tokens,
            $usage->datecreated,
        ]);
    }
    fclose($output);
    die;
}

if ($action == 2) {
    $audios = glob("{$CFG->dataroot}/temp/*.mp3") ?: [];

    foreach ($audios as $audio) {
        $filename = pathinfo($audio, PATHINFO_FILENAME);
        $url = new moodle_url("/local/geniai/load-audio-temp.php", [
            "filename" => $filename,
            "sesskey" => sesskey(),
        ]);
        echo html_writer::tag("p", html_writer::link($url, s("{$filename}.mp3")));
    }
    die;
}

$link = html_writer::link(
    new moodle_url("/local/geniai/download.php", ["action" => 1]),
    get_string("report_download", "local_geniai")
);
echo html_writer::tag("p", $link);

$link = html_writer::link(
    new moodle_url("/local/geniai/download.php", ["action" => 2]),
    get_string("report_list", "local_geniai")
);
echo html_writer::tag("p", $link);
