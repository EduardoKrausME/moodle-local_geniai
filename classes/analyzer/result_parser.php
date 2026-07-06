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
 * phpcs:disable moodle.Strings.ForbiddenStrings.Found
 *
 * Parses AI analysis text and extracts structured metadata when available.
 *
 * @package   local_geniai
 * @copyright 2024 Eduardo Kraus {@link https://eduardokraus.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace local_geniai\analyzer;

/**
 * Class result_parser
 */
class result_parser {
    /**
     * Parse AI response text.
     *
     * @param string $content Raw response content.
     * @return array Parsed data with display text and metadata.
     */
    public static function parse($content) {
        $json = self::extract_json_block($content);
        $display = self::remove_json_blocks($content);

        $status = "";
        $statuskey = "";
        $bloomlevel = "";
        $recommendations = [];

        if (!empty($json)) {
            if (isset($json["status"])) {
                $status = self::normalize_status_label($json["status"]);
                $statuskey = self::normalize_status_key($json["status"]);
            }
            if (isset($json["status_key"])) {
                $statuskey = self::normalize_status_key($json["status_key"]);
                if ($status === "") {
                    $status = self::status_label_from_key($statuskey);
                }
            }
            if (isset($json["bloom_level"])) {
                $bloomlevel = self::normalize_bloom_level($json["bloom_level"]);
            }
            if (isset($json["recommendations"]) && is_array($json["recommendations"])) {
                $recommendations = array_values(array_filter(array_map("strval", $json["recommendations"])));
            }
        }

        if ($status === "") {
            $status = self::detect_status($display);
            $statuskey = self::normalize_status_key($status);
        }
        if ($bloomlevel === "") {
            $bloomlevel = self::detect_bloom_level($display);
        }

        return [
            "displaytext" => trim($display),
            "json" => $json,
            "status" => $status,
            "statuskey" => $statuskey,
            "bloomlevel" => $bloomlevel,
            "recommendations" => $recommendations,
        ];
    }

    /**
     * Extract the last JSON code block from the response.
     *
     * @param string $content Raw content.
     * @return array
     */
    private static function extract_json_block($content) {
        if (!preg_match_all('/```json\s*(.*?)```/is', $content, $matches)) {
            return [];
        }

        $blocks = $matches[1];
        $jsontext = trim(end($blocks));
        $decoded = json_decode($jsontext, true);

        return is_array($decoded) ? $decoded : [];
    }

    /**
     * Remove JSON blocks from display text.
     *
     * @param string $content Raw content.
     * @return string
     */
    private static function remove_json_blocks($content) {
        $content = preg_replace('/\n*```json\s*.*?```\s*$/is', "", $content);
        $content = preg_replace('/```json\s*.*?```/is', "", $content);

        return trim($content);
    }

    /**
     * Detect final status from Markdown content.
     *
     * @param string $content Display content.
     * @return string
     */
    public static function detect_status($content) {
        $statuses = [
            'Inadequate or insufficient',
            'Inadequado ou insuficiente',
            'Needs review',
            'Precisa revisão',
            'OK with minor adjustments',
            'OK com ajustes leves',
            "OK",
        ];

        foreach ($statuses as $status) {
            if (preg_match('/(^|[^\pL])' . preg_quote($status, '/') . '([^\pL]|$)/iu', $content)) {
                return $status;
            }
        }

        return "";
    }

    /**
     * Detect Bloom level from Markdown content.
     *
     * @param string $content Display content.
     * @return string
     */
    public static function detect_bloom_level($content) {
        if (preg_match('/\b(lembrar|compreender|aplicar|analisar|avaliar|criar)\b/iu', $content, $match)) {
            return self::normalize_bloom_level($match[1]);
        }

        return "";
    }

    /**
     * Normalize Bloom level.
     *
     * @param string $level Bloom level.
     * @return string
     */
    private static function normalize_bloom_level($level) {
        $level = strtolower(trim($level));
        $map = [
            "remember" => "remember",
            "understand" => "understand",
            "apply" => "apply",
            "analyze" => "analyze",
            "evaluate" => "evaluate",
            "create" => "create",
            "lembrar" => "remember",
            "compreender" => "understand",
            "aplicar" => "apply",
            "analisar" => "analyze",
            "avaliar" => "evaluate",
            "criar" => "create",
        ];

        return $map[$level] ?? "";
    }

    /**
     * Normalize status key.
     *
     * @param string $status Status value.
     * @return string
     */
    private static function normalize_status_key($status) {
        $status = strtolower(trim($status));
        $status = str_replace([' ', '-'], "_", $status);

        $map = [
            "ok" => "ok",
            "ok_com_ajustes_leves" => "ok_minor",
            "ok_with_minor_adjustments" => "ok_minor",
            "ok_minor" => "ok_minor",
            "precisa_revisao" => "needs_review",
            'precisa_revisão' => "needs_review",
            "needs_review" => "needs_review",
            "inadequado_ou_insuficiente" => "insufficient",
            "inadequate_or_insufficient" => "insufficient",
            "insufficient" => "insufficient",
        ];

        return $map[$status] ?? "";
    }

    /**
     * Normalize status label.
     *
     * @param string $status Status value.
     * @return string
     */
    private static function normalize_status_label($status) {
        $key = self::normalize_status_key($status);

        return self::status_label_from_key($key);
    }

    /**
     * Get status label from key.
     *
     * @param string $key Status key.
     * @return string
     */
    private static function status_label_from_key($key) {
        $labels = [
            "ok" => "OK",
            "ok_minor" => get_string("analysis_status_ok_minor", "local_geniai"),
            "needs_review" => get_string("analysis_status_needs_review", "local_geniai"),
            "insufficient" => get_string("analysis_status_insufficient", "local_geniai"),
        ];

        return $labels[$key] ?? "";
    }
}
