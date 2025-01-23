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
 * Page header file.
 *
 * @package   local_geniai
 * @copyright 2024 Eduardo Kraus {@link http://eduardokraus.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace local_geniai\local\h5p;

use context_course;
use context_system;
use core_contentbank\contentbank;
use core_contentbank\helper;
use global_navigation;
use moodle_exception;
use moodle_url;
use navigation_node;

/**
 * Class page_header
 *
 * @package local_geniai\local\h5p
 */
class page_header {

    /** @var string */
    private $title;

    /**
     * Function header
     *
     * @param string $cburl
     * @param int $contextid
     * @param \context $context
     * @param string|null $type
     *
     * @throws \Exception
     */
    public function header($cburl, $contextid, $context, $type = null) {
        global $PAGE, $DB;

        $cb = new contentbank();
        if (!$cb->is_context_allowed($context)) {
            throw new moodle_exception("contextnotallowed", "core_contentbank");
        }

        require_capability("moodle/contentbank:upload", $context);

        if ($contextid == context_system::instance()->id) {
            $PAGE->set_context(context_course::instance($contextid));
        } else {
            $PAGE->set_context($context);
        }

        $PAGE->add_body_class("h5p-manager-page");
        $PAGE->set_context($context);
        $PAGE->set_heading(helper::get_page_heading($context));
        $PAGE->set_secondary_active_tab("contentbank");
        $PAGE->set_url($cburl);
        $PAGE->set_secondary_active_tab("contentbank");

        switch ($context->contextlevel) {
            case CONTEXT_COURSE:
                //$courseid = $context->instanceid;
                //$course = $DB->get_record("course", ["id" => $courseid], "*", MUST_EXIST);
                //$PAGE->set_course($course);

                $url = new moodle_url("/local/geniai/h5p/", ["contextid" => $contextid]);
                $PAGE->navbar->add(get_string("h5p-title", "local_geniai"), $url);

                navigation_node::override_active_url(new moodle_url("/course/view.php", ["id" => $courseid]));
                $PAGE->navbar->add(get_string("h5p-page-title", "local_geniai"), $cburl);
                $PAGE->set_pagelayout('standard');
                $PAGE->set_pagetype('course-view');
                break;
            case CONTEXT_COURSECAT:
                $PAGE->set_primary_active_tab("home");
                $coursecat = $context->instanceid;

                $url = new moodle_url("/local/geniai/h5p/", ["contextid" => $contextid]);
                $PAGE->navbar->add(get_string("h5p-title", "local_geniai"), $url);

                navigation_node::override_active_url(new moodle_url("/course/index.php", ["categoryid" => $coursecat]));
                $PAGE->navbar->add(get_string("h5p-page-title", "local_geniai"), $cburl);
                $PAGE->set_pagelayout("standard");
                break;
            default:
                if ($node = $PAGE->navigation->find("contentbank", global_navigation::TYPE_CUSTOM)) {
                    $node->make_active();
                }
                $PAGE->set_pagelayout("standard");
        }

        if ($type) {
            $tipo = get_string("h5p-" . strtolower($type) . "-title", "local_geniai");
            $this->title = get_string("h5p-createpage-title", "local_geniai", $tipo);
            $PAGE->navbar->add($this->title, $cburl);
        } else {
            $this->title = get_string("h5p-title", "local_geniai");
        }

        if ($PAGE->course) {
            require_login($PAGE->course->id);
        }
    }

    /**
     * Function get_title
     *
     * @return string
     */
    public function get_title(): string {
        return $this->title;
    }
}
