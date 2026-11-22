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

namespace local_geniai;

/**
 * Safety tests for the repeatable migration of historical activity analyses.
 *
 * @package local_geniai
 * @covers \local_geniai\local\analysis_migration
 */
final class analysis_migration_test extends \advanced_testcase {
    /** A fresh installation must not create or delete unrelated tables. */
    public function test_no_legacy_table_is_noop(): void {
        $this->resetAfterTest();
        $dbman = $GLOBALS['DB']->get_manager();
        $legacy = new \xmldb_table('local_geniai_analysis');
        $this->assertFalse($dbman->table_exists($legacy));
        $this->assertTrue(\local_geniai\local\analysis_migration::migrate());
        $this->assertFalse($dbman->table_exists($legacy));
    }

    /** A clean Moodle install must actually create the plugin's three current tables. */
    public function test_installed_geniai_tables_exist(): void {
        $dbman = $GLOBALS['DB']->get_manager();
        foreach (['local_geniai_usage', 'local_geniai_h5p', 'local_geniai_h5ppages'] as $tablename) {
            $this->assertTrue($dbman->table_exists(new \xmldb_table($tablename)), $tablename);
        }
        $this->assertFalse($dbman->table_exists(new \xmldb_table('local_geniai_analysis')));
    }

    /** Never discard historical records when Course Audit has not been installed. */
    public function test_missing_destination_keeps_legacy_records(): void {
        global $DB;

        $this->resetAfterTest();
        $this->require_missing_courseaudit_table();
        $this->create_analysis_table('local_geniai_analysis');
        try {
            $id = $DB->insert_record('local_geniai_analysis', $this->sample_record());
            $this->assertFalse(\local_geniai\local\analysis_migration::migrate());
            $this->assertTrue($DB->record_exists('local_geniai_analysis', ['id' => $id]));
        } finally {
            $this->drop_fixture_table('local_geniai_analysis');
        }
    }

    /** Migrate a complete record, remove only the source table and remain retryable. */
    public function test_copies_and_verifies_historical_rows(): void {
        global $DB;

        $this->resetAfterTest();
        $this->require_missing_courseaudit_table();
        $this->create_analysis_table('local_geniai_analysis');
        $this->create_analysis_table('local_courseaudit_analysis');
        try {
            $DB->insert_record('local_geniai_analysis', $this->sample_record());
            $this->assertTrue(\local_geniai\local\analysis_migration::migrate());
            $this->assertFalse($DB->get_manager()->table_exists(new \xmldb_table('local_geniai_analysis')));
            $this->assertSame(1, $DB->count_records('local_courseaudit_analysis'));
            $migrated = $DB->get_record('local_courseaudit_analysis', ['contenthash' => sha1('lesson')], '*', MUST_EXIST);
            $this->assertSame('Historical recommendations', $migrated->recommendations);
            $this->assertSame('Historical analysis', $migrated->resulttext);
            $this->assertSame('apply', $migrated->bloomlevel);

            $this->assertTrue(\local_geniai\local\analysis_migration::migrate());
            $this->assertSame(1, $DB->count_records('local_courseaudit_analysis'));
        } finally {
            $this->drop_fixture_table('local_geniai_analysis');
            $this->drop_fixture_table('local_courseaudit_analysis');
        }
    }

    /** Previously migrated identical rows must not be duplicated. */
    public function test_identical_destination_rows_are_not_duplicated(): void {
        global $DB;

        $this->resetAfterTest();
        $this->require_missing_courseaudit_table();
        $this->create_analysis_table('local_geniai_analysis');
        $this->create_analysis_table('local_courseaudit_analysis');
        try {
            $DB->insert_record('local_geniai_analysis', $this->sample_record());
            $DB->insert_record('local_courseaudit_analysis', $this->sample_record());
            $this->assertTrue(\local_geniai\local\analysis_migration::migrate());
            $this->assertSame(1, $DB->count_records('local_courseaudit_analysis'));
            $this->assertFalse($DB->get_manager()->table_exists(new \xmldb_table('local_geniai_analysis')));
        } finally {
            $this->drop_fixture_table('local_geniai_analysis');
            $this->drop_fixture_table('local_courseaudit_analysis');
        }
    }

    /** Conflicting destination data must stop the migration without dropping history. */
    public function test_conflicting_destination_preserves_legacy_table(): void {
        global $DB;

        $this->resetAfterTest();
        $this->require_missing_courseaudit_table();
        $this->create_analysis_table('local_geniai_analysis');
        $this->create_analysis_table('local_courseaudit_analysis');
        try {
            $DB->insert_record('local_geniai_analysis', $this->sample_record());
            $DB->insert_record('local_courseaudit_analysis', $this->sample_record('Different analysis'));
            try {
                \local_geniai\local\analysis_migration::migrate();
                $this->fail('Conflicting analyses must not be silently discarded');
            } catch (\moodle_exception $exception) {
                $this->assertTrue($DB->get_manager()->table_exists(new \xmldb_table('local_geniai_analysis')));
                $this->assertSame(1, $DB->count_records('local_geniai_analysis'));
                $this->assertSame(1, $DB->count_records('local_courseaudit_analysis'));
            }
        } finally {
            $this->drop_fixture_table('local_geniai_analysis');
            $this->drop_fixture_table('local_courseaudit_analysis');
        }
    }

    /** The migration fixtures must not overwrite a real Course Audit installation. */
    private function require_missing_courseaudit_table(): void {
        if ($GLOBALS['DB']->get_manager()->table_exists(new \xmldb_table('local_courseaudit_analysis'))) {
            $this->markTestSkipped('Course Audit is already installed; cannot use temporary destination fixture');
        }
    }

    /** Create a table with the historical activity-analysis fields. */
    private function create_analysis_table(string $name): void {
        $table = new \xmldb_table($name);
        $table->add_field('id', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, XMLDB_SEQUENCE);
        $table->add_field('courseid', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, null, '0');
        $table->add_field('cmid', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, null, '0');
        $table->add_field('userid', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, null, '0');
        $table->add_field('analysis_type', XMLDB_TYPE_CHAR, '50', null, XMLDB_NOTNULL, null, 'full');
        $table->add_field('contenthash', XMLDB_TYPE_CHAR, '40', null, XMLDB_NOTNULL);
        $table->add_field('status', XMLDB_TYPE_CHAR, '80');
        $table->add_field('statuskey', XMLDB_TYPE_CHAR, '30');
        $table->add_field('bloomlevel', XMLDB_TYPE_CHAR, '30');
        $table->add_field('model', XMLDB_TYPE_CHAR, '100');
        $table->add_field('prompttokens', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, null, '0');
        $table->add_field('completiontokens', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, null, '0');
        $table->add_field('recommendations', XMLDB_TYPE_TEXT);
        $table->add_field('resulttext', XMLDB_TYPE_TEXT);
        $table->add_field('resultjson', XMLDB_TYPE_TEXT);
        $table->add_field('timecreated', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, null, '0');
        $table->add_field('timemodified', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, null, '0');
        $table->add_key('primary', XMLDB_KEY_PRIMARY, ['id']);
        $GLOBALS['DB']->get_manager()->create_table($table);
    }

    /** Remove only tables created by this test. */
    private function drop_fixture_table(string $name): void {
        $table = new \xmldb_table($name);
        $dbman = $GLOBALS['DB']->get_manager();
        if ($dbman->table_exists($table)) {
            $dbman->drop_table($table);
        }
    }

    /** Return a record containing every meaningful analysis field. */
    private function sample_record(string $resulttext = 'Historical analysis'): \stdClass {
        return (object) [
            'courseid' => 2,
            'cmid' => 7,
            'userid' => 3,
            'analysis_type' => 'full',
            'contenthash' => sha1('lesson'),
            'status' => 'complete',
            'statuskey' => 'complete',
            'bloomlevel' => 'apply',
            'model' => 'gpt-4o',
            'prompttokens' => 10,
            'completiontokens' => 25,
            'recommendations' => 'Historical recommendations',
            'resulttext' => $resulttext,
            'resultjson' => '{"ok":true}',
            'timecreated' => 1700000000,
            'timemodified' => 1700000100,
        ];
    }
}
