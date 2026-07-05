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
 * Service for analyzing multiple activities from a course.
 *
 * @package   local_geniai
 * @copyright 2024 Eduardo Kraus {@link https://eduardokraus.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace local_geniai\analyzer;

use cm_info;

/**
 * Class course_analyzer
 */
class course_analyzer {
    /** Default safe limit per synchronous request. */
    const DEFAULT_LIMIT = 10;

    /** Hard synchronous limit to avoid long requests and high costs. */
    const MAX_LIMIT = 30;

    /**
     * Analyze visible activities from a course.
     *
     * @param int $courseid Course ID.
     * @param int $userid User ID.
     * @param string $analysis Analysis type.
     * @param bool $force Force new analysis.
     * @param int $limit Maximum activities to analyze in this request.
     * @return array
     * @throws \dml_exception
     * @throws \moodle_exception
     */
    public function analyze_course($courseid, $userid, $analysis = "full", $force = false, $limit = self::DEFAULT_LIMIT) {
        global $DB;

        $course = $DB->get_record("course", ["id" => $courseid], '*', MUST_EXIST);
        $modinfo = get_fast_modinfo($course, $userid);
        $cms = $modinfo->get_cms();
        $limit = max(1, min((int) $limit, self::MAX_LIMIT));
        $analyzer = new activity_analyzer();

        $items = [];
        $processed = 0;
        foreach ($cms as $cm) {
            if (!$this->can_analyze_cm($cm)) {
                continue;
            }

            $result = $analyzer->analyze($cm->id, $userid, $analysis, $force);
            $items[] = [
                "cmid" => (int) $cm->id,
                "name" => format_string($cm->name),
                "modname" => $cm->modname,
                "result" => $result->result,
                "cached" => $result->cached,
                "analysis_id" => $result->id,
                "status" => $result->status,
                "status_key" => $result->statuskey,
                "bloom_level" => $result->bloomlevel,
                "content" => $result->content,
                "contenthash" => $result->contenthash,
            ];

            $processed++;
            if ($processed >= $limit) {
                break;
            }
        }

        return [
            "courseid" => (int) $courseid,
            "processed" => $processed,
            "limit" => $limit,
            "items" => $items,
            "summary" => $this->build_summary($items),
        ];
    }

    /**
     * Build a summary using the processed items in this request.
     *
     * @param array $items Analysis items.
     * @return array
     */
    public function build_summary(array $items) {
        $summary = [
            "total" => count($items),
            "ok" => 0,
            "ok_minor" => 0,
            "needs_review" => 0,
            "insufficient" => 0,
            "unknown" => 0,
            "bloom_remember" => 0,
            "bloom_understand" => 0,
            "bloom_apply" => 0,
            "bloom_analyze" => 0,
            "bloom_evaluate" => 0,
            "bloom_create" => 0,
        ];

        $bloommap = [
            "lembrar" => "bloom_remember",
            "compreender" => "bloom_understand",
            "aplicar" => "bloom_apply",
            "analisar" => "bloom_analyze",
            "avaliar" => "bloom_evaluate",
            "criar" => "bloom_create",
        ];

        foreach ($items as $item) {
            $key = isset($item["status_key"]) && $item["status_key"] !== "" ? $item["status_key"] : "unknown";
            if (!isset($summary[$key])) {
                $key = "unknown";
            }
            $summary[$key]++;

            $bloom = $item["bloom_level"] ?? "";
            if (isset($bloommap[$bloom])) {
                $summary[$bloommap[$bloom]]++;
            }
        }

        return $summary;
    }

    /**
     * Decide whether a course module should be analyzed.
     *
     * @param \cm_info $cm Course module info.
     * @return bool
     */
    private function can_analyze_cm(cm_info $cm) {
        if (empty($cm->uservisible)) {
            return false;
        }

        if (!empty($cm->deletioninprogress)) {
            return false;
        }

        $skip = ["subsection"];
        if (in_array($cm->modname, $skip, true)) {
            return false;
        }

        return true;
    }
}
