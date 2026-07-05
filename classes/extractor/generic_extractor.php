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
 * Generic fallback extractor for Moodle activities.
 *
 * @package   local_geniai
 * @copyright 2024 Eduardo Kraus {@link https://eduardokraus.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace local_geniai\extractor;


use cm_info;
use dml_exception;
use local_geniai\analyzer\activity_content;
use local_geniai\analyzer\content_cleaner;
use stdClass;

/**
 * Class generic_extractor
 */
class generic_extractor implements activity_content_extractor {
    /**
     * Whether this extractor supports the provided course module.
     *
     * @param \cm_info $cm Course module info.
     * @return bool
     */
    public function supports(cm_info $cm) {
        return true;
    }

    /**
     * Extract text and metadata from the course module.
     *
     * @param \cm_info $cm Course module info.
     * @param \stdClass $course Course record.
     * @param int $userid User ID.
     * @return activity_content
     * @throws \moodle_exception
     */
    public function extract(cm_info $cm, stdClass $course, $userid) {
        $content = $this->base_content($cm, $course, $userid);
        $record = $this->get_activity_record($cm);

        if ($record) {
            if (isset($record->intro)) {
                $content->intro = content_cleaner::clean_html($record->intro);
            }
            if (isset($record->content)) {
                $content->maincontent = content_cleaner::clean_html($record->content);
            }
            if (isset($record->name) && empty($content->activityname)) {
                $content->activityname = format_string($record->name);
            }
        } else if (isset($cm->summary)) {
            $content->intro = content_cleaner::clean_html($cm->summary);
        }

        return $content;
    }

    /**
     * Build common metadata for every activity.
     *
     * @param \cm_info $cm Course module info.
     * @param \stdClass $course Course record.
     * @param int $userid User ID.
     * @return activity_content
     * @throws \moodle_exception
     */
    protected function base_content(cm_info $cm, stdClass $course, $userid) {
        $content = new activity_content();
        $content->courseid = (int) $course->id;
        $content->cmid = (int) $cm->id;
        $content->instanceid = (int) $cm->instance;
        $content->modname = $cm->modname;
        $content->activityname = content_cleaner::normalize_text(format_string($cm->name));
        $content->coursefullname = content_cleaner::normalize_text(format_string($course->fullname));
        $content->courseshortname = content_cleaner::normalize_text(format_string($course->shortname));
        $content->url = $cm->url ? $cm->url->out(false) : "";

        $modinfo = get_fast_modinfo($course, $userid);
        $sectioninfo = null;
        if (isset($cm->sectionnum)) {
            $sectioninfo = $modinfo->get_section_info($cm->sectionnum);
        }

        if ($sectioninfo) {
            $content->sectionname = content_cleaner::normalize_text(get_section_name($course, $sectioninfo));
            if (!empty($sectioninfo->summary)) {
                $content->sectionsummary = content_cleaner::clean_html($sectioninfo->summary);
            }
        }

        $content->metadata = [
            "visible" => $cm->visible ? 1 : 0,
            "uservisible" => $cm->uservisible ? 1 : 0,
            "moduleidnumber" => $cm->idnumber ?? "",
        ];

        return $content;
    }

    /**
     * Read the module instance record when the table exists.
     *
     * @param \cm_info $cm Course module info.
     * @return \stdClass|false
     */
    protected function get_activity_record(cm_info $cm) {
        global $DB;

        try {
            return $DB->get_record($cm->modname, ["id" => $cm->instance]);
        } catch (dml_exception) {
            return false;
        }
    }
}
