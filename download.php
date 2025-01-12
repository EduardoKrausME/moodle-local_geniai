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
 * @copyright 2024 Eduardo Kraus {@link http://eduardokraus.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once("../../config.php");

require_login();

if ($action = optional_param("action", false, PARAM_INT)) {

    if ($action == 1) {
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

    } else if ($action == 2) {
        $audios = glob("{$CFG->dataroot}/temp/*.mp3");

        foreach ($audios as $audio) {
            $filename = pathinfo($audio, PATHINFO_FILENAME);
            $link = "{$CFG->wwwroot}/local/geniai/load-audio-temp.php?filename={$filename}";
            echo "<p><a href=\"?action=1\">{$filename}.mp3</a></p>";
        }
        die;
    }
} else {
    echo "<p><a href=\"?action=1\">Baixar uso do GPT</a></p>
          <p><a href=\"?action=2\">Listar audios</a></p>";
}
