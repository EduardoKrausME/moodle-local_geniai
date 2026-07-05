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
 * Value object with the activity content used by the analyzer.
 *
 * @package   local_geniai
 * @copyright 2024 Eduardo Kraus {@link https://eduardokraus.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace local_geniai\analyzer;

/**
 * Class activity_content
 */
class activity_content {
    /** @var int Course ID. */
    public $courseid = 0;

    /** @var int Course module ID. */
    public $cmid = 0;

    /** @var int Activity instance ID. */
    public $instanceid = 0;

    /** @var string Module type. */
    public $modname = "";

    /** @var string Activity name. */
    public $activityname = "";

    /** @var string Course full name. */
    public $coursefullname = "";

    /** @var string Course short name. */
    public $courseshortname = "";

    /** @var string Section name. */
    public $sectionname = "";

    /** @var string Section summary. */
    public $sectionsummary = "";

    /** @var string Activity intro. */
    public $intro = "";

    /** @var string Main textual content extracted from the activity. */
    public $maincontent = "";

    /** @var string Activity URL. */
    public $url = "";

    /** @var array Question summaries or other pedagogical items. */
    public $questions = [];

    /** @var array Extra metadata. */
    public $metadata = [];

    /**
     * Export the object as array.
     *
     * @return array
     */
    public function to_array() {
        return [
            "courseid" => $this->courseid,
            "cmid" => $this->cmid,
            "instanceid" => $this->instanceid,
            "modname" => $this->modname,
            "activityname" => $this->activityname,
            "coursefullname" => $this->coursefullname,
            "courseshortname" => $this->courseshortname,
            "sectionname" => $this->sectionname,
            "sectionsummary" => $this->sectionsummary,
            "intro" => $this->intro,
            "maincontent" => $this->maincontent,
            "url" => $this->url,
            "questions" => $this->questions,
            "metadata" => $this->metadata,
        ];
    }

    /**
     * Build a stable hash for the extracted content.
     *
     * @return string
     */
    public function content_hash() {
        return sha1(json_encode($this->to_array()));
    }

    /**
     * Build a text block to send to the AI model.
     *
     * @param int $maxchars Maximum number of characters.
     * @return string
     */
    public function to_prompt_text($maxchars = 18000) {
        $text = "# Course\n";
        $text .= "Full name: {$this->coursefullname}\n";
        $text .= "Short name: {$this->courseshortname}\n\n";

        $text .= "# Section\n";
        $text .= "Name: {$this->sectionname}\n";
        if (isset($this->sectionsummary[0])) {
            $text .= "Summary:\n{$this->sectionsummary}\n";
        }
        $text .= "\n";

        $text .= "# Activity\n";
        $text .= "Type: {$this->modname}\n";
        $text .= "Title: {$this->activityname}\n";
        if (isset($this->url[0])) {
            $text .= "URL: {$this->url}\n";
        }
        $text .= "\n";

        if (isset($this->intro[0])) {
            $text .= "# Activity description\n{$this->intro}\n\n";
        }

        if (isset($this->maincontent[0])) {
            $text .= "# Main content\n{$this->maincontent}\n\n";
        }

        if (!empty($this->questions)) {
            $text .= "# Questions or assessment items\n";
            foreach ($this->questions as $index => $question) {
                $number = $index + 1;
                $name = $question["name"] ?? "";
                $qtype = $question["qtype"] ?? "";
                $questiontext = $question["questiontext"] ?? "";
                $text .= "## Item {$number}\n";
                $text .= "Name: {$name}\n";
                $text .= "Type: {$qtype}\n";
                $text .= "Text:\n{$questiontext}\n\n";
            }
        }

        if (!empty($this->metadata)) {
            $text .= "# Metadata\n";
            foreach ($this->metadata as $key => $value) {
                if (is_scalar($value)) {
                    $text .= "{$key}: {$value}\n";
                }
            }
        }

        return content_cleaner::limit($text, $maxchars);
    }
}
