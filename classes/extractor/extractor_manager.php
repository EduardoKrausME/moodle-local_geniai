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
 * Discovers and runs the best extractor for a Moodle activity.
 *
 * @package   local_geniai
 * @copyright 2024 Eduardo Kraus {@link https://eduardokraus.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace local_geniai\extractor;

use cm_info;
use local_geniai\analyzer\activity_content;
use stdClass;

/**
 * Class extractor_manager
 */
class extractor_manager {
    /**
     * Extract activity content.
     *
     * @param \cm_info $cm Course module info.
     * @param \stdClass $course Course record.
     * @param int $userid User ID.
     * @return activity_content
     * @throws \moodle_exception
     */
    public static function extract(cm_info $cm, stdClass $course, $userid) {
        foreach (self::extractors() as $extractor) {
            if ($extractor->supports($cm)) {
                return $extractor->extract($cm, $course, $userid);
            }
        }

        $fallback = new generic_extractor();
        return $fallback->extract($cm, $course, $userid);
    }

    /**
     * List enabled extractors in priority order.
     *
     * @return activity_content_extractor[]
     */
    private static function extractors() {
        return [
            new page_extractor(),
            new label_extractor(),
            new assign_extractor(),
            new forum_extractor(),
            new quiz_extractor(),
            new book_extractor(),
            new lesson_extractor(),
            new url_extractor(),
            new resource_extractor(),
            new folder_extractor(),
            new h5pactivity_extractor(),
            new feedback_extractor(),
            new glossary_extractor(),
            new wiki_extractor(),
            new generic_extractor(),
        ];
    }
}
