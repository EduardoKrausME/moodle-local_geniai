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
 * Extractor for mod_folder.
 *
 * @package   local_geniai
 * @copyright 2024 Eduardo Kraus {@link https://eduardokraus.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace local_geniai\extractor;

use cm_info;
use context_module;
use local_geniai\analyzer\content_cleaner;
use stdClass;

/**
 * Class folder_extractor
 */
class folder_extractor extends generic_extractor {
    /**
     * Whether this extractor supports the provided course module.
     *
     * @param \cm_info $cm Course module info.
     * @return bool
     */
    public function supports(cm_info $cm) {
        return $cm->modname === "folder";
    }

    /**
     * Extract folder intro and readable text files when possible.
     *
     * @param \cm_info $cm Course module info.
     * @param \stdClass $course Course record.
     * @param int $userid User ID.
     * @return \local_geniai\analyzer\activity_content
     * @throws \dml_exception
     * @throws \moodle_exception
     */
    public function extract(cm_info $cm, stdClass $course, $userid) {
        global $DB;

        $content = $this->base_content($cm, $course, $userid);
        $folder = $DB->get_record("folder", ["id" => $cm->instance]);

        if ($folder) {
            $content->intro = content_cleaner::clean_html($folder->intro);
            $context = context_module::instance($cm->id);
            $files = file_text_extractor::extract_area($context->id, "mod_folder", "content");
            $content->metadata["files"] = count($files);
            $parts = [];
            foreach ($files as $file) {
                $line = 'File: ' . $file["filename"] . ' (' . $file["mimetype"] . ', ' . $file["filesize"] . ' bytes)';
                if (!empty($file["text"])) {
                    $line .= "\n" . $file["text"];
                }
                $parts[] = $line;
            }
            $content->maincontent = content_cleaner::limit(implode("\n\n", $parts), 18000);
        }

        return $content;
    }
}
