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
 * Utility for extracting safe text from Moodle stored files.
 *
 * @package   local_geniai
 * @copyright 2024 Eduardo Kraus {@link https://eduardokraus.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace local_geniai\extractor;

use local_geniai\analyzer\content_cleaner;
use stored_file;
use Throwable;

/**
 * Class file_text_extractor
 */
class file_text_extractor {
    /** Maximum characters read from one file. */
    const MAX_FILE_CHARS = 12000;

    /** Maximum files listed/extracted per activity. */
    const MAX_FILES = 10;

    /**
     * Extract readable text files from a module file area.
     *
     * @param int $contextid Context ID.
     * @param string $component File component.
     * @param string $filearea File area.
     * @param int $itemid Item ID.
     * @return array
     * @throws \coding_exception
     */
    public static function extract_area($contextid, $component, $filearea, $itemid = 0) {
        $fs = get_file_storage();
        $files = $fs->get_area_files($contextid, $component, $filearea, $itemid, "filename", false);

        $items = [];
        $count = 0;
        foreach ($files as $file) {
            if ($file->is_directory()) {
                continue;
            }

            $items[] = self::extract_file($file);
            $count++;

            if ($count >= self::MAX_FILES) {
                break;
            }
        }

        return $items;
    }

    /**
     * Extract text from a stored file when it is safe and plain-text based.
     *
     * @param \stored_file $file Moodle stored file.
     * @return array
     */
    public static function extract_file(stored_file $file) {
        $filename = $file->get_filename();
        $mimetype = $file->get_mimetype();
        $extension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        $text = "";
        $extractable = self::is_text_file($mimetype, $extension);

        if ($extractable) {
            try {
                $content = $file->get_content();
                $text = content_cleaner::limit(content_cleaner::clean_html($content), self::MAX_FILE_CHARS);
            } catch (Throwable) {
                $text = "";
            }
        }

        return [
            "filename" => $filename,
            "mimetype" => $mimetype,
            "filesize" => $file->get_filesize(),
            "extractable" => $extractable ? 1 : 0,
            "text" => $text,
        ];
    }

    /**
     * Whether a file can be safely read as text without external dependencies.
     *
     * @param string $mimetype Mimetype.
     * @param string $extension Extension.
     * @return bool
     */
    private static function is_text_file($mimetype, $extension) {
        $textmimes = [
            'text/plain',
            'text/html',
            'text/csv',
            'text/markdown',
            'application/json',
            'application/xml',
            'text/xml',
        ];

        $textextensions = ["txt", "html", "htm", "md", "csv", "json", "xml"];

        return in_array($mimetype, $textmimes, true) || in_array($extension, $textextensions, true);
    }
}
