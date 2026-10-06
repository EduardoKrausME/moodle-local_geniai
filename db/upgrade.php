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
 * Upgrade file.
 *
 * @package   local_geniai
 * @copyright 2026 Eduardo Kraus {@link https://eduardokraus.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/**
 * Upgrade local_geniai database.
 *
 * @param int $oldversion Old plugin version.
 * @return bool
 * @throws \ddl_exception
 * @throws \ddl_table_missing_exception
 * @throws \downgrade_exception
 * @throws \moodle_exception
 * @throws \upgrade_exception
 */
function xmldb_local_geniai_upgrade($oldversion) {
    global $DB;

    $dbman = $DB->get_manager();

    if ($oldversion < 2026070600) {
        // Activity analysis moved to local_courseaudit. Do not create the legacy
        // table during upgrades; only normalize one that already exists so its
        // historical records can still be migrated safely.
        $table = new xmldb_table("local_geniai_analysis");

        if ($dbman->table_exists($table)) {
            $field = new xmldb_field("statuskey", XMLDB_TYPE_CHAR, "30", null, null, null, null, "status");
            if (!$dbman->field_exists($table, $field)) {
                $dbman->add_field($table, $field);
            }

            $field = new xmldb_field("recommendations", XMLDB_TYPE_TEXT, null, null, null, null, null, "completiontokens");
            if (!$dbman->field_exists($table, $field)) {
                $dbman->add_field($table, $field);
            }
        }

        upgrade_plugin_savepoint(true, 2026070600, "local", "geniai");
    }

    if ($oldversion < 2026100600) {
        // Activity analysis moved to local_courseaudit. Keep legacy data until the
        // destination table exists so plugin upgrade order cannot lose history.
        upgrade_plugin_savepoint(true, 2026100600, 'local', 'geniai');
    }

    if ($oldversion < 2026100601) {
        $oldtable = new xmldb_table('local_geniai_analysis');
        $newtable = new xmldb_table('local_courseaudit_analysis');

        if ($dbman->table_exists($oldtable) && $dbman->table_exists($newtable)) {
            $records = $DB->get_records('local_geniai_analysis', [], 'id ASC');
            foreach ($records as $record) {
                $exists = $DB->record_exists('local_courseaudit_analysis', [
                    'courseid' => $record->courseid,
                    'cmid' => $record->cmid,
                    'userid' => $record->userid,
                    'analysis_type' => $record->analysis_type,
                    'contenthash' => $record->contenthash,
                    'timecreated' => $record->timecreated,
                ]);
                if ($exists) {
                    continue;
                }

                unset($record->id);
                $DB->insert_record('local_courseaudit_analysis', $record);
            }

            $dbman->drop_table($oldtable);
        }

        // Move the old setting once Course Audit is present, even when there is
        // no legacy analysis table left to copy.
        if ($dbman->table_exists($newtable)) {
            $oldconfig = get_config('local_geniai', 'analysis_excluded_plugins');
            if ($oldconfig !== false && get_config('local_courseaudit', 'analysis_excluded_plugins') === false) {
                set_config('analysis_excluded_plugins', $oldconfig, 'local_courseaudit');
            }
            unset_config('analysis_excluded_plugins', 'local_geniai');
        }

        upgrade_plugin_savepoint(true, 2026100601, 'local', 'geniai');
    }

    return true;
}
