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
 * Page create file.
 *
 * @package    local_geniai
 * @copyright  2024 Eduardo Kraus {@link http://eduardokraus.com}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace local_geniai\local\h5p;

use core\notification;
use local_geniai\local\h5p\type\h5p_base;
use local_geniai\local\vo\local_geniai_h5p;
use local_kopere_dashboard\html\form;
use local_kopere_dashboard\html\inputs\input_text;
use local_kopere_dashboard\html\inputs\input_textarea;
use tool_brickfield\local\areas\core_course\fullname;

/**
 * Class page_create
 *
 * @package local_geniai\local\h5p
 */
class page_create {

    /** @var local_geniai_h5p */
    private $h5p;

    /**
     * Function create_page
     *
     * @throws \coding_exception
     * @throws \dml_exception
     * @throws \moodle_exception
     */
    public function create_page() {
        global $OUTPUT, $CFG, $USER, $SITE;

        $form = new form("?{$_SERVER["QUERY_STRING"]}", "form-h5p-next-step d-none");
        $form->create_hidden_input("sessionkey", sesskey());
        $form->create_hidden_input("contextid", $this->h5p->contextid);
        $form->create_hidden_input("type", $this->h5p->type);
        $form->create_hidden_input("startbase", $this->h5p->startbase);
        $form->create_hidden_input("userlang", $USER->lang);

        $form->add_input(
            input_text::new_instance()
                ->set_name("title")
                ->set_title(get_string("h5p-create-title", "local_geniai"))
                ->set_description(get_string("h5p-create-title-desc", "local_geniai"))
                ->set_value($this->h5p->title)
        );

        $this->h5p->textbase = get_string("h5p-create-textbase-placeholder", "local_geniai");

        $form->add_input(
            input_textarea::new_instance()
                ->set_name("textbase")
                ->set_title(get_string("h5p-create-textbase", "local_geniai"))
                ->set_description(get_string("h5p-create-textbase-desc", "local_geniai"))
                ->add_extras("placeholder='" . get_string("h5p-create-textbase-placeholder", "local_geniai") . "'")
                ->set_value($this->h5p->textbase)
                ->set_style("height:400px;")
        );

        $form->create_submit_input(get_string("h5p-next-step", "local_geniai"), "h5p-next-step");
        $form->create_submit_input(get_string("h5p-create", "local_geniai"), "h5p-create");

        $form->close();

        $curl = new \curl();
        $h5pjs = $curl->post("https://geniai.ottflix.com.br/api/v2/H5pjs", [
            "client_wwwroot" => $CFG->wwwroot,
            "client_fullname" => $SITE->fullname,
            "user_fullname" => fullname($USER),
            "user_email" => $USER->email,
            "user_lang" => $USER->lang,
            "case" => get_config("local_geniai", "case"),
            "frequency_penalty" => get_config("local_geniai", "frequency_penalty"),
            "presence_penalty" => get_config("local_geniai", "presence_penalty"),
            "apikey" => get_config("local_geniai", "apikey"),
        ]);
        //echo $h5pjs;

        $types = types::getTypes($this->h5p->contextid);
        echo $OUTPUT->render_from_template("local_geniai/show-h5pjs", [
            "h5pjs" => $h5pjs,
            "types" => $types,
        ]);
    }

    public function save() {
        global $DB;

        if ($this->h5p->id) {
            $this->h5p->title = required_param("title", PARAM_TEXT);
            $this->h5p->textbase = required_param("textbase", PARAM_TEXT);

            $DB->update_record("local_geniai_h5p", $this->h5p);
        } else {
            $this->h5p->contextid = required_param("contextid", PARAM_INT);
            $this->h5p->title = required_param("title", PARAM_TEXT);
            $this->h5p->textbase = required_param("textbase", PARAM_TEXT);
            $this->h5p->type = required_param("type", PARAM_TEXT);
            $this->h5p->timecreated = time();

            $this->h5p->id = $DB->insert_record("local_geniai_h5p", $this->h5p);
        }
    }

    /**
     * @return int
     */
    public function getContextid(): int {
        return $this->contextid;
    }

    /**
     * @param int $contextid
     */
    public function setContextid(int $contextid): void {
        $this->contextid = $contextid;
    }

    /**
     * @return string
     */
    public function getType(): string {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type): void {
        $this->type = $type;
    }

    /**
     * @return local_geniai_h5p
     */
    public function getH5p(): local_geniai_h5p {
        return $this->h5p;
    }

    /**
     * @param local_geniai_h5p $h5p
     */
    public function setH5p(local_geniai_h5p $h5p): void {
        $this->h5p = $h5p;
    }
}