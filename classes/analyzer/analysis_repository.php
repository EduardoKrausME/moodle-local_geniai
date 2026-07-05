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
 * Repository for activity analysis cache and history.
 *
 * @package   local_geniai
 * @copyright 2024 Eduardo Kraus {@link https://eduardokraus.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace local_geniai\analyzer;

use stdClass;
use Throwable;
use xmldb_table;

/**
 * Class analysis_repository
 */
class analysis_repository {
    /** Analysis table name. */
    const TABLE = "local_geniai_analysis";

    /**
     * Whether the analysis table is available.
     *
     * @return bool
     */
    public static function table_exists() {
        global $CFG, $DB;

        require_once($CFG->libdir . '/ddllib.php');

        try {
            $dbman = $DB->get_manager();
            return $dbman->table_exists(new xmldb_table(self::TABLE));
        } catch (Throwable) {
            return false;
        }
    }

    /**
     * Get latest analysis matching the same content hash.
     *
     * @param int $cmid Course module ID.
     * @param string $analysis Analysis type.
     * @param string $contenthash Content hash.
     * @return activity_analysis_result|null
     * @throws \dml_exception
     */
    public static function get_latest_by_hash($cmid, $analysis, $contenthash) {
        global $DB;

        if (!self::table_exists()) {
            return null;
        }

        $records = $DB->get_records(self::TABLE, [
            "cmid" => $cmid,
            "analysis_type" => $analysis,
            "contenthash" => $contenthash,
        ], 'id DESC', '*', 0, 1);

        if (empty($records)) {
            return null;
        }

        return activity_analysis_result::from_record(reset($records));
    }

    /**
     * Get latest analysis for an activity, regardless of current content hash.
     *
     * @param int $cmid Course module ID.
     * @param string $analysis Analysis type.
     * @return activity_analysis_result|null
     * @throws \dml_exception
     */
    public static function get_latest_for_activity($cmid, $analysis = "full") {
        global $DB;

        if (!self::table_exists()) {
            return null;
        }

        $records = $DB->get_records(self::TABLE, [
            "cmid" => $cmid,
            "analysis_type" => $analysis,
        ], 'id DESC', '*', 0, 1);

        if (empty($records)) {
            return null;
        }

        return activity_analysis_result::from_record(reset($records));
    }

    /**
     * Save an analysis result.
     *
     * @param int $courseid Course ID.
     * @param int $cmid Course module ID.
     * @param int $userid User ID.
     * @param string $analysis Analysis type.
     * @param activity_analysis_result $result Result object.
     * @return int Stored record ID, or 0 when history table is unavailable.
     * @throws \dml_exception
     */
    public static function save($courseid, $cmid, $userid, $analysis, activity_analysis_result $result) {
        global $DB;

        if (!self::table_exists()) {
            return 0;
        }

        $now = time();
        $record = new stdClass();
        $record->courseid = $courseid;
        $record->cmid = $cmid;
        $record->userid = $userid;
        $record->analysis_type = $analysis;
        $record->contenthash = $result->contenthash;
        $record->status = $result->status;
        $record->statuskey = $result->statuskey;
        $record->bloomlevel = $result->bloomlevel;
        $record->model = $result->model;
        $record->prompttokens = $result->prompttokens;
        $record->completiontokens = $result->completiontokens;
        $record->recommendations = json_encode($result->recommendations, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        $record->resulttext = $result->content;
        $record->resultjson = json_encode($result->resultjson, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        $record->timecreated = $now;
        $record->timemodified = $now;

        $id = $DB->insert_record(self::TABLE, $record);
        $result->id = $id;

        return $id;
    }

    /**
     * List history for one course and optionally one activity.
     *
     * @param int $courseid Course ID.
     * @param int $cmid Course module ID, or 0 for whole course.
     * @param int $limit Max records.
     * @return array
     * @throws \dml_exception
     */
    public static function list_history($courseid, $cmid = 0, $limit = 50) {
        global $DB;

        if (!self::table_exists()) {
            return [];
        }

        $params = ["courseid" => $courseid];
        $where = 'courseid = :courseid';

        if ($cmid > 0) {
            $where .= ' AND cmid = :cmid';
            $params["cmid"] = $cmid;
        }

        return $DB->get_records_select(self::TABLE, $where, $params, 'id DESC', '*', 0, $limit);
    }

    /**
     * Summarize latest analysis records in a course.
     *
     * @param int $courseid Course ID.
     * @param string $analysis Analysis type.
     * @return array
     * @throws \dml_exception
     */
    public static function summarize_course($courseid, $analysis = "full") {
        global $DB;

        $summary = [
            "total" => 0,
            "statuses" => [],
            "bloom" => [],
        ];

        if (!self::table_exists()) {
            return $summary;
        }

        $records = $DB->get_records(self::TABLE, [
            "courseid" => $courseid,
            "analysis_type" => $analysis,
        ], 'cmid ASC, id DESC');

        $seen = [];
        foreach ($records as $record) {
            if (isset($seen[$record->cmid])) {
                continue;
            }
            $seen[$record->cmid] = true;
            $summary["total"]++;

            $status = trim($record->status);
            if ($status !== "") {
                if (!isset($summary["statuses"][$status])) {
                    $summary["statuses"][$status] = 0;
                }
                $summary["statuses"][$status]++;
            }

            $bloom = trim($record->bloomlevel);
            if ($bloom !== "") {
                if (!isset($summary["bloom"][$bloom])) {
                    $summary["bloom"][$bloom] = 0;
                }
                $summary["bloom"][$bloom]++;
            }
        }

        return $summary;
    }
}
