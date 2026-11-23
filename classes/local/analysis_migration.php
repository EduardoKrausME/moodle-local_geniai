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
// along with Moodle.  If not, see <https://www.gnu.org/licenses/>.

namespace local_geniai\local;

/**
 * Retryable migration of legacy activity analyses to local_courseaudit.
 *
 * @package local_geniai
 * @copyright 2026 Eduardo Kraus
 * @license https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class analysis_migration {
    /**
     * Copy and verify historical analyses before dropping the legacy table.
     *
     * Safe to call repeatedly and before local_courseaudit is installed.
     *
     * @return bool True when the legacy table is absent or migrated.
     */
    public static function migrate(): bool {
        global $DB;

        $dbman = $DB->get_manager();
        $oldtable = new \xmldb_table('local_geniai_analysis');
        if (!$dbman->table_exists($oldtable)) {
            return true;
        }
        $newtable = new \xmldb_table('local_courseaudit_analysis');
        if (!$dbman->table_exists($newtable)) {
            return false;
        }

        $lockfactory = \core\lock\lock_config::get_lock_factory('local_geniai');
        $lock = $lockfactory->get_lock('analysis_migration', 10);
        if (!$lock) {
            return false;
        }

        try {
            // Check again under the lock: an earlier task may have completed.
            if (!$dbman->table_exists($oldtable)) {
                return true;
            }
            $fields = $DB->get_columns('local_courseaudit_analysis');
            $records = $DB->get_recordset('local_geniai_analysis', [], 'id ASC');
            try {
                foreach ($records as $record) {
                    $key = [
                        'courseid' => $record->courseid,
                        'cmid' => $record->cmid,
                        'userid' => $record->userid,
                        'analysis_type' => $record->analysis_type,
                        'contenthash' => $record->contenthash,
                        'timecreated' => $record->timecreated,
                    ];
                    $existing = $DB->get_records('local_courseaudit_analysis', $key);
                    $candidate = clone $record;
                    unset($candidate->id);
                    // Old installations can have columns removed from the new schema.
                    foreach (array_keys(get_object_vars($candidate)) as $field) {
                        if (!isset($fields[$field])) {
                            unset($candidate->$field);
                        }
                    }
                    if ($existing) {
                        $matching = false;
                        foreach ($existing as $row) {
                            $same = true;
                            foreach ($candidate as $field => $value) {
                                if ((string) ($row->$field ?? '') !== (string) ($value ?? '')) {
                                    $same = false;
                                    break;
                                }
                            }
                            if ($same) {
                                $matching = true;
                                break;
                            }
                        }
                        if (!$matching) {
                            throw new \moodle_exception('Conflicting course audit analysis for legacy record ' . $record->id);
                        }
                        continue;
                    }
                    $DB->insert_record('local_courseaudit_analysis', $candidate);
                }
            } finally {
                $records->close();
            }

            // Only delete after every row was copied or verified.
            $dbman->drop_table($oldtable);
            return true;
        } finally {
            $lock->release();
        }
    }
}
