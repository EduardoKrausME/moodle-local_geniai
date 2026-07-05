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
 * Extractor for mod_wiki.
 *
 * @package   local_geniai
 * @copyright 2024 Eduardo Kraus {@link https://eduardokraus.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace local_geniai\extractor;

use cm_info;
use dml_exception;
use local_geniai\analyzer\content_cleaner;
use stdClass;

/**
 * Class wiki_extractor
 */
class wiki_extractor extends generic_extractor {
    /** Maximum pages extracted. */
    const MAX_PAGES = 10;

    /**
     * Whether this extractor supports the provided course module.
     *
     * @param \cm_info $cm Course module info.
     * @return bool
     */
    public function supports(cm_info $cm) {
        return $cm->modname === "wiki";
    }

    /**
     * Extract wiki intro and latest page versions when available.
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
        $wiki = $DB->get_record("wiki", ["id" => $cm->instance]);

        if ($wiki) {
            $content->intro = content_cleaner::clean_html($wiki->intro);
            $content->metadata["wikimode"] = $wiki->wikimode ?? "";
            $content->metadata["firstpagetitle"] = $wiki->firstpagetitle ?? "";
            $content->maincontent = $this->extract_pages((int) $wiki->id);
        }

        return $content;
    }

    /**
     * Extract a small sample of current page content.
     *
     * @param int $wikiid Wiki ID.
     * @return string
     */
    private function extract_pages($wikiid) {
        global $DB;

        $sql = "SELECT p.id, p.title, v.content
                  FROM {wiki_subwikis} sw
                  JOIN {wiki_pages} p ON p.subwikiid = sw.id
                  JOIN {wiki_versions} v ON v.pageid = p.id AND v.version = p.cachedcontentversion
                 WHERE sw.wikiid = :wikiid
              ORDER BY p.title ASC";

        try {
            $records = $DB->get_records_sql($sql, ["wikiid" => $wikiid], 0, self::MAX_PAGES);
        } catch (dml_exception) {
            return "";
        }

        $parts = [];
        foreach ($records as $record) {
            $title = content_cleaner::normalize_text($record->title);
            $body = content_cleaner::clean_html($record->content);
            $parts[] = "## {$title}\n{$body}";
        }

        return content_cleaner::limit(implode("\n\n", $parts), 18000);
    }
}
