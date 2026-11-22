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
 * Independent CI check for GeniAI version, upgrades, and shared analysis schema.
 *
 * Usage: php ci/check-schema.php path/to/local_courseaudit/db/install.xml
 *
 * @package local_geniai
 */

$root = dirname(__DIR__);
$courseauditpath = $argv[1] ?? '';
$errors = [];

/**
 * Read one XMLDB schema.
 *
 * @param string $path XMLDB filename.
 * @return DOMXPath
 */
function read_xmldb(string $path): DOMXPath {
    if (!is_file($path)) {
        throw new RuntimeException("Missing XMLDB file: {$path}");
    }
    $doc = new DOMDocument();
    if (!$doc->load($path, LIBXML_NONET)) {
        throw new RuntimeException("Invalid XMLDB file: {$path}");
    }
    return new DOMXPath($doc);
}

/**
 * Check required columns and primary key in an XMLDB table.
 *
 * @param DOMXPath $xml Schema document.
 * @param string $name Table name.
 * @param array $columns Required column names.
 * @param array $errors Collected errors.
 */
function check_table(DOMXPath $xml, string $name, array $columns, array &$errors): void {
    $query = '/XMLDB/TABLES/TABLE[@NAME="' . $name . '"]';
    $tables = $xml->query($query);
    if ($tables->length !== 1) {
        $errors[] = "Expected exactly one {$name} table, found {$tables->length}";
        return;
    }

    $fields = [];
    foreach ($xml->query($query . '/FIELDS/FIELD') as $field) {
        $fields[] = $field->getAttribute('NAME');
    }
    foreach ($columns as $column) {
        if (!in_array($column, $fields, true)) {
            $errors[] = "{$name} is missing the {$column} field";
        }
    }
    if (count($fields) !== count(array_unique($fields))) {
        $errors[] = "{$name} defines duplicate field names";
    }
    if ($xml->query($query . '/KEYS/KEY[@TYPE="primary" and @FIELDS="id"]')->length !== 1) {
        $errors[] = "{$name} needs a primary key on id";
    }
}

try {
    $geniai = read_xmldb($root . '/db/install.xml');
    $courseaudit = read_xmldb($courseauditpath);

    check_table($geniai, 'local_geniai_usage',
        ['id', 'send', 'receive', 'model', 'prompt_tokens', 'completion_tokens', 'timecreated', 'datecreated'],
        $errors);
    check_table($geniai, 'local_geniai_h5p',
        ['id', 'contextid', 'contentbanktid', 'title', 'type', 'data', 'timecreated'],
        $errors);
    check_table($geniai, 'local_geniai_h5ppages',
        ['id', 'h5pid', 'title', 'type', 'data', 'timecreated'],
        $errors);
    check_table($courseaudit, 'local_courseaudit_run',
        ['id', 'courseid', 'userid', 'mode', 'sectionid', 'contenthash', 'findingsjson', 'timecreated'],
        $errors);
    check_table($courseaudit, 'local_courseaudit_analysis',
        ['id', 'courseid', 'cmid', 'userid', 'analysis_type', 'contenthash', 'status',
            'statuskey', 'bloomlevel', 'model', 'prompttokens', 'completiontokens',
            'recommendations', 'resulttext', 'resultjson', 'timecreated', 'timemodified'],
        $errors);

    if ($geniai->query('/XMLDB/TABLES/TABLE[@NAME="local_geniai_analysis"]')->length !== 0) {
        $errors[] = 'Legacy local_geniai_analysis must not be created on fresh installations';
    }
    if ($geniai->query('/XMLDB/TABLES/TABLE[@NAME="local_courseaudit_analysis"]')->length !== 0) {
        $errors[] = 'Only local_courseaudit may own the destination analysis table';
    }

    $version = file_get_contents($root . '/version.php');
    $upgrade = file_get_contents($root . '/db/upgrade.php');
    if (!preg_match('/\$plugin->version\s*=\s*(\d+)\s*;/', $version, $match)) {
        $errors[] = 'Missing numeric plugin version';
    } else {
        $pluginversion = (int) $match[1];
    }
    if (!preg_match('/\$plugin->release\s*=\s*["\x27][^"\x27]+["\x27]\s*;/', $version)) {
        $errors[] = 'Missing plugin release declaration';
    }

    preg_match_all('/if\s*\(\s*\$oldversion\s*<\s*(\d+)\s*\)/', $upgrade, $guards);
    preg_match_all('/upgrade_plugin_savepoint\s*\(\s*true\s*,\s*(\d+)\s*,\s*["\x27]local["\x27]\s*,\s*["\x27]geniai["\x27]\s*\)/',
        $upgrade, $savepoints);
    $guardversions = array_map('intval', $guards[1]);
    $savepointversions = array_map('intval', $savepoints[1]);
    if ($guardversions !== $savepointversions) {
        $errors[] = 'Upgrade conditions and savepoints must match in the same order';
    }
    if (count(array_unique($guardversions)) !== count($guardversions) ||
            $guardversions !== array_values(array_unique($guardversions)) ||
            $guardversions !== array_values(array_unique($savepointversions))) {
        $errors[] = 'Upgrade versions must be unique';
    }
    $sorted = $guardversions;
    sort($sorted, SORT_NUMERIC);
    if ($guardversions !== $sorted) {
        $errors[] = 'Upgrade versions must be ascending';
    }
    if (!in_array(2026070600, $guardversions, true) || !in_array(2026112200, $guardversions, true)) {
        $errors[] = 'The historical and consolidated upgrade steps must remain present';
    }
    foreach ($guardversions as $guard) {
        if ($guard > 2026100600 && $guard < 2026112200) {
            $errors[] = "Unconsolidated upgrade step {$guard}";
        }
    }
    if (isset($pluginversion) && $guardversions && max($guardversions) > $pluginversion) {
        $errors[] = 'Latest upgrade savepoint exceeds the plugin version';
    }
} catch (Throwable $exception) {
    $errors[] = $exception->getMessage();
}

if ($errors) {
    fwrite(STDERR, "Schema/upgrade validation failed:\n- " . implode("\n- ", $errors) . "\n");
    exit(1);
}
echo "All five XMLDB table definitions and GeniAI upgrade invariants are valid.\n";
