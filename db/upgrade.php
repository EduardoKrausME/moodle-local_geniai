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

    if ($oldversion < 2026051000) {
        $table = new xmldb_table("local_geniai_analysis");

        if (!$dbman->table_exists($table)) {
            $table->add_field("id", XMLDB_TYPE_INTEGER, "10", null, XMLDB_NOTNULL, XMLDB_SEQUENCE);
            $table->add_field("courseid", XMLDB_TYPE_INTEGER, "10", null, XMLDB_NOTNULL, null, "0");
            $table->add_field("cmid", XMLDB_TYPE_INTEGER, "10", null, XMLDB_NOTNULL, null, "0");
            $table->add_field("userid", XMLDB_TYPE_INTEGER, "10", null, XMLDB_NOTNULL, null, "0");
            $table->add_field("analysis_type", XMLDB_TYPE_CHAR, "50", null, XMLDB_NOTNULL, null, "full");
            $table->add_field("contenthash", XMLDB_TYPE_CHAR, "40", null, XMLDB_NOTNULL, null, "");
            $table->add_field("status", XMLDB_TYPE_CHAR, "80");
            $table->add_field("statuskey", XMLDB_TYPE_CHAR, "30");
            $table->add_field("bloomlevel", XMLDB_TYPE_CHAR, "30");
            $table->add_field("model", XMLDB_TYPE_CHAR, "100");
            $table->add_field("prompttokens", XMLDB_TYPE_INTEGER, "10", null, XMLDB_NOTNULL, null, "0");
            $table->add_field("completiontokens", XMLDB_TYPE_INTEGER, "10", null, XMLDB_NOTNULL, null, "0");
            $table->add_field("recommendations", XMLDB_TYPE_TEXT);
            $table->add_field("resulttext", XMLDB_TYPE_TEXT);
            $table->add_field("resultjson", XMLDB_TYPE_TEXT);
            $table->add_field("timecreated", XMLDB_TYPE_INTEGER, "10", null, XMLDB_NOTNULL, null, "0");
            $table->add_field("timemodified", XMLDB_TYPE_INTEGER, "10", null, XMLDB_NOTNULL, null, "0");

            $table->add_key("primary", XMLDB_KEY_PRIMARY, ["id"]);
            $table->add_index("courseid", XMLDB_INDEX_NOTUNIQUE, ["courseid"]);
            $table->add_index("cmid", XMLDB_INDEX_NOTUNIQUE, ["cmid"]);
            $table->add_index("cm_hash", XMLDB_INDEX_NOTUNIQUE, ["cmid", "contenthash"]);
            $table->add_index("course_type_time", XMLDB_INDEX_NOTUNIQUE, ["courseid", "analysis_type", "timecreated"]);

            $dbman->create_table($table);
        } else {
            $field = new xmldb_field("statuskey", XMLDB_TYPE_CHAR, "30", null, null, null, null, "status");
            if (!$dbman->field_exists($table, $field)) {
                $dbman->add_field($table, $field);
            }

            $field = new xmldb_field("recommendations", XMLDB_TYPE_TEXT, null, null, null, null, null, "completiontokens");
            if (!$dbman->field_exists($table, $field)) {
                $dbman->add_field($table, $field);
            }
        }

        upgrade_plugin_savepoint(true, 2026051000, "local", "geniai");
    }

    return true;
}
