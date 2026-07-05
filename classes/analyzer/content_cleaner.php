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
 * Helper for cleaning Moodle HTML before sending it to the AI model.
 *
 * @package   local_geniai
 * @copyright 2024 Eduardo Kraus {@link https://eduardokraus.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace local_geniai\analyzer;

/**
 * Class content_cleaner
 */
class content_cleaner {
    /**
     * Clean an HTML fragment into readable plain text.
     *
     * @param string|null $html HTML content.
     * @return string
     */
    public static function clean_html($html) {
        if ($html === null || $html === false) {
            return "";
        }

        $text = $html;
        $text = preg_replace('/<script\b[^>]*>.*?<\/script>/is', ' ', $text);
        $text = preg_replace('/<style\b[^>]*>.*?<\/style>/is', ' ', $text);
        $text = preg_replace('/<\s*br\s*\/?>/i', "\n", $text);
        $text = preg_replace('/<\s*\/\s*(p|div|h1|h2|h3|h4|h5|h6|li|tr|blockquote)\s*>/i', "\n", $text);
        $text = preg_replace('/<\s*li\b[^>]*>/i', "\n- ", $text);
        $text = strip_tags($text);
        $text = html_entity_decode($text, ENT_QUOTES | ENT_HTML5, 'UTF-8');

        return self::normalize_text($text);
    }

    /**
     * Normalize whitespace.
     *
     * @param string|null $text Plain text.
     * @return string
     */
    public static function normalize_text($text) {
        if ($text === null || $text === false) {
            return "";
        }

        $text = $text;
        $text = str_replace(["\r\n", "\r"], "\n", $text);
        $text = preg_replace('/[\t ]+/', ' ', $text);
        $text = preg_replace('/\n[\t ]+/', "\n", $text);
        $text = preg_replace('/\n{3,}/', "\n\n", $text);

        return trim($text);
    }

    /**
     * Limit text length and append a clear truncation notice.
     *
     * @param string $text Text to limit.
     * @param int $maxchars Maximum characters.
     * @return string
     */
    public static function limit($text, $maxchars) {
        $text = self::normalize_text($text);
        if ($maxchars <= 0 || strlen($text) <= $maxchars) {
            return $text;
        }

        $limited = substr($text, 0, $maxchars);
        $limited = preg_replace('/\s+\S*$/u', "", $limited);

        return trim($limited) . "\n\n[Content truncated because it exceeded the configured analysis limit.]";
    }
}
