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
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle. If not, see <http://www.gnu.org/licenses/>.

namespace local_geniai;

/**
 * Basic safety tests for the repeatable analysis migration.
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
}
