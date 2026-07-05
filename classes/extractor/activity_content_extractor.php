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
 * Activity content extractor contract.
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
 * Interface activity_content_extractor
 */
interface activity_content_extractor {
    /**
     * Whether this extractor supports the provided course module.
     *
     * @param \cm_info $cm Course module info.
     * @return bool
     */
    public function supports(cm_info $cm);

    /**
     * Extract text and metadata from the course module.
     *
     * @param \cm_info $cm Course module info.
     * @param \stdClass $course Course record.
     * @param int $userid User ID.
     * @return activity_content
     */
    public function extract(cm_info $cm, stdClass $course, $userid);
}
