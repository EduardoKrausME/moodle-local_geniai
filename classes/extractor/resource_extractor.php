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
 * Extractor for mod_resource.
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
 * Class resource_extractor
 */
class resource_extractor extends generic_extractor {
    /**
     * Whether this extractor supports the provided course module.
     *
     * @param \cm_info $cm Course module info.
     * @return bool
     */
    public function supports(cm_info $cm) {
        return $cm->modname === "resource";
    }

    /**
     * Extract resource intro and readable text files when possible.
     *
     * @param \cm_info $cm Course module info.
     * @param \stdClass $course Course record.
     * @param int $userid User ID.
     * @return \local_geniai\analyzer\activity_content
     * @throws \dml_exception
     */
    public function extract(cm_info $cm, stdClass $course, $userid) {
        global $DB;

        $content = $this->base_content($cm, $course, $userid);
        $resource = $DB->get_record("resource", ["id" => $cm->instance]);

        if ($resource) {
            $content->intro = content_cleaner::clean_html($resource->intro);
            $context = context_module::instance($cm->id);
            $files = file_text_extractor::extract_area($context->id, "mod_resource", "content");
            $content->metadata["files"] = count($files);
            $parts = [];
            foreach ($files as $file) {
                $parts[] = 'File: ' . $file["filename"] . ' (' . $file["mimetype"] . ', ' . $file["filesize"] . " bytes)";
                if (!empty($file["text"])) {
                    $parts[] = $file["text"];
                }
            }
            $content->maincontent = content_cleaner::limit(implode("\n\n", $parts), 18000);
        }

        return $content;
    }
}
