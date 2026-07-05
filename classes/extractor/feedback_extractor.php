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
 * Extractor for mod_feedback.
 *
 * @package   local_geniai
 * @copyright 2024 Eduardo Kraus {@link https://eduardokraus.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace local_geniai\extractor;

use cm_info;
use local_geniai\analyzer\content_cleaner;
use stdClass;

/**
 * Class feedback_extractor
 */
class feedback_extractor extends generic_extractor {
    /** Maximum feedback items extracted. */
    const MAX_ITEMS = 30;

    /**
     * Whether this extractor supports the provided course module.
     *
     * @param \cm_info $cm Course module info.
     * @return bool
     */
    public function supports(cm_info $cm) {
        return $cm->modname === "feedback";
    }

    /**
     * Extract feedback instructions and items.
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
        $feedback = $DB->get_record("feedback", ["id" => $cm->instance]);

        if ($feedback) {
            $content->intro = content_cleaner::clean_html($feedback->intro);
            $items = $DB->get_records("feedback_item", ["feedback" => $feedback->id], 'position ASC', '*', 0, self::MAX_ITEMS);
            $parts = [];
            foreach ($items as $item) {
                $label = isset($item->label) ? content_cleaner::clean_html($item->label) : "";
                $name = isset($item->name) ? content_cleaner::clean_html($item->name) : "";
                $type = $item->typ ?? "";
                $parts[] = "Item: {$name}\nType: {$type}\nLabel: {$label}";
            }
            $content->maincontent = content_cleaner::limit(implode("\n\n", $parts), 18000);
            $content->metadata["items_extracted"] = count($parts);
        }

        return $content;
    }
}
