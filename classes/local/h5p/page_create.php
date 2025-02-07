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
 * @package   local_geniai
 * @copyright 2024 Eduardo Kraus {@link http://eduardokraus.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace local_geniai\local\h5p;

use coding_exception;
use Exception;
use local_geniai\local\editor\editor_tiny;
use local_geniai\local\vo\local_geniai_h5p;
use moodle_exception;

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
     * https://moodle.org/plugins/tiny_wordimport/versions
     * https://moodle.org/plugins/tiny_fontsize/versions
     * https://moodle.org/plugins/tiny_htmlblock/versions
     * https://moodle.org/plugins/tiny_c4l/versions
     *
     * @throws \coding_exception
     * @throws \dml_exception
     * @throws \moodle_exception
     */
    public function create_page() {
        global $OUTPUT, $CFG, $USER, $SITE, $SESSION;

        $USER->fullname = fullname($USER);

        $curl = new \curl();
        $h5pjs = $curl->post("https://app.ottflix.com.br/api/v1/H5pjs", [
            "client_wwwroot" => $CFG->wwwroot,
            "client_fullname" => $SITE->fullname,
            "user_fullname" => fullname($USER),
            "user_email" => $USER->email,
            "user_lang" => isset($SESSION->lang) ? $SESSION->lang : $USER->lang,
            "case" => get_config("local_geniai", "case"),
            "frequency_penalty" => get_config("local_geniai", "frequency_penalty"),
            "presence_penalty" => get_config("local_geniai", "presence_penalty"),
            "apikey" => get_config("local_geniai", "apikey"),
            "module" => "create",
        ]);

        $caseuses=[];
        $names = ["fiel", "create", "super", "summary", "rewrite", "expand", "simplify", "tone"];
                foreach ($names as $name){
                    $caseuses[]=[
                        "key" => $name,
                        "title" => get_string("createmode_{$name}_title", "local_geniai"),
                        "desc" => get_string("createmode_{$name}_desc", "local_geniai"),
                    ];
                }

        $basecolor = get_config("local_geniai", "base_color");
        $types = types::get_types($this->h5p->contextid);
        echo $OUTPUT->render_from_template("local_geniai/h5p-create", [
            "h5p" => $this->h5p,
            "user" => $USER,
            "user_lang" => isset($SESSION->lang) ? $SESSION->lang : $USER->lang,
            "h5pjs" => $h5pjs,
            "types" => $types,
            "baseColor" => $basecolor ? $basecolor : "#1768c4",
            "caseuses" => $caseuses,
        ]);
    }

    /**
     * Function edit
     *
     * @throws \dml_exception
     * @throws coding_exception
     */
    public function edit() {
        global $OUTPUT, $CFG, $USER, $SITE, $DB, $SESSION;

        $curl = new \curl();
        $h5pjs = $curl->post("https://app.ottflix.com.br/api/v1/H5pjs", [
            "client_wwwroot" => $CFG->wwwroot,
            "client_fullname" => $SITE->fullname,
            "user_fullname" => fullname($USER),
            "user_email" => $USER->email,
            "user_lang" => isset($SESSION->lang) ? $SESSION->lang : $USER->lang,
            "case" => get_config("local_geniai", "case"),
            "frequency_penalty" => get_config("local_geniai", "frequency_penalty"),
            "presence_penalty" => get_config("local_geniai", "presence_penalty"),
            "apikey" => get_config("local_geniai", "apikey"),
            "module" => "edit",
            "sesskey" => sesskey(),
            "h5p_id" => $this->h5p->id,
        ]);

        $types = types::get_types($this->h5p->contextid);
        echo $OUTPUT->render_from_template("local_geniai/h5p-edit", [
            "h5p" => $this->h5p,
            "h5p_data" => json_decode($this->h5p->data),
            "user" => $USER,
            "user_lang" => isset($SESSION->lang) ? $SESSION->lang : $USER->lang,
            "h5pjs" => $h5pjs,
            "types" => $types,
            "show-pages" => $this->h5p->type == "InteractiveBook",
            "pages" => array_values($DB->get_records("local_geniai_h5ppages", ["h5pid" => $this->h5p->id])),
            "tyni_editor_config" => (new editor_tiny())->tyni_editor_config(),
        ]);
    }

    /**
     * Function save
     *
     * @throws Exception
     */
    public function save() {
        global $DB;

        $config = $this->params_array("config", PARAM_RAW, false);
        if (isset($config["baseColor"])) {
            set_config("base_color", $config["baseColor"], "local_geniai");
        }

        if ($this->h5p->id) {
            $this->h5p->title = required_param("title", PARAM_TEXT);
            $this->h5p->data = json_encode([
                "textbase" => optional_param("textbase", "", PARAM_TEXT),
                "modulebase" => optional_param("modulebase", "", PARAM_TEXT),
                "filebase" => optional_param("filebase", 0, PARAM_INT),
                "config" => $config,
            ], JSON_PRETTY_PRINT);
            if ($textbase = optional_param("textbase", false, PARAM_TEXT)) {
                $this->h5p->textbase = $textbase;
            }

            $DB->update_record("local_geniai_h5p", $this->h5p);

        } else {
            $this->h5p->contextid = required_param("contextid", PARAM_INT);
            $this->h5p->title = required_param("title", PARAM_TEXT);
            $this->h5p->type = required_param("type", PARAM_TEXT);
            $this->h5p->data = json_encode([
                "textbase" => optional_param("textbase", "", PARAM_TEXT),
                "modulebase" => optional_param("modulebase", "", PARAM_TEXT),
                "filebase" => optional_param("filebase", 0, PARAM_INT),
                "config" => $config,
            ], JSON_PRETTY_PRINT);
            $this->h5p->timecreated = time();
            $this->h5p->id = $DB->insert_record("local_geniai_h5p", $this->h5p);
        }

        $h5ppages = $DB->get_records("local_geniai_h5ppages", ["h5pid" => $this->h5p->id]);
        $pages = $this->params_array("pages", PARAM_RAW, false);
        foreach ($pages as $page) {
            if ($h5ppage = $DB->get_record("local_geniai_h5ppages", ["h5pid" => $this->h5p->id, "type" => $page["type"]])) {
                $h5ppage->title = $page["title"];
                $h5ppage->type = $page["type"];
                $h5ppage->data = json_encode($page, JSON_PRETTY_PRINT);
                $DB->update_record("local_geniai_h5ppages", $h5ppage);
                unset($h5ppages[$h5ppage->id]);
            } else {
                $h5ppage = (object)[
                    "h5pid" => $this->h5p->id,
                    "title" => $page["title"],
                    "type" => $page["type"],
                    "data" => json_encode($page, JSON_PRETTY_PRINT),
                    "timecreated" => time(),
                ];
                $DB->insert_record("local_geniai_h5ppages", $h5ppage);
            }
        }

        foreach ($h5ppages as $h5ppage) {
            if (isset($h5ppage->id)) {
                $DB->delete_records("local_geniai_h5ppages", ["id" => $h5ppage->id]);
            }
        }
    }

    /**
     * Function delete
     *
     * @throws \dml_exception
     */
    public function delete() {
        global $DB;

        $DB->delete_records("local_geniai_h5p", ["id" => $this->h5p->id]);
        $DB->delete_records("local_geniai_h5ppages", ["h5pid" => $this->h5p->id]);
    }

    /**
     * Function send_contentbank
     *
     * @param int|null $contentbankid
     *
     * @throws \core\exception\moodle_exception
     * @throws \dml_exception
     * @throws \file_exception
     * @throws \stored_file_creation_exception
     * @throws moodle_exception
     */
    public function send_contentbank($contentbankid = null) {
        global $USER, $DB, $SESSION;

        $fs = get_file_storage();
        $filerecord = [
            "contextid" => \context_user::instance($USER->id)->id,
            "component" => "user",
            "filearea" => "draft",
            "itemid" => time(),
            "filepath" => "/",
            "filename" => "{$this->h5p->title}.h5p",
            "userid" => $USER->id,
            "author" => fullname($USER),
            "license" => "allrightsreserved",
            "timecreated" => time(),
            "timemodified" => time(),
        ];

        $url = "https://app.ottflix.com.br/upload/h5ps/geniai/?download=1";

        $h5p = (array)$DB->get_record("local_geniai_h5p",
            ["id" => $this->h5p->id], "id, contextid, contentbanktid, title, type, data");
        $data = json_decode($h5p["data"], true);
        $h5p["user_lang"] = isset($SESSION->lang) ? $SESSION->lang : $USER->lang;
        $h5p["config"] = $data["config"];

        $h5p["pages"] = [];
        if ($contentbankid) {
            $h5ppages = $DB->get_records("local_geniai_h5ppages",
                ["id" => $contentbankid]);
            $h5ppages = array_values($h5ppages);

            $h5p["title"] = $h5p["title"] . " - " . $h5ppages[0]->title;
            $h5p["type"] = "Column";

        } else {
            $h5ppages = $DB->get_records("local_geniai_h5ppages", ["h5pid" => $this->h5p->id]);
        }

        foreach ($h5ppages as $h5ppage) {
            $data = json_decode($h5ppage->data, true);
            $data["title"] = $h5ppage->title;
            $data["type"] = $h5ppage->type;

            $h5p["pages"][] = $data;
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($h5p, "", "&"));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $response = curl_exec($ch);

        if ($response === false) {
            die("Erro ao baixar o arquivo: " . curl_error($ch));
        }

        curl_close($ch);

        $tempzip = tempnam(sys_get_temp_dir(), "arquivo.h5p");
        file_put_contents($tempzip, $response);
        $storedfile = $fs->create_file_from_pathname($filerecord, $tempzip);

        $cb = new \core_contentbank\contentbank();

        if ($this->h5p->contentbanktid) {
            $content = $cb->get_content_from_id($this->h5p->contentbanktid);
            $contenttype = $content->get_content_type_instance();
            $content = $contenttype->replace_content($storedfile, $content);
        } else {
            /** @var \contenttype_h5p\content $content */
            $content = $cb->create_content_from_file(\context::instance_by_id($this->h5p->contextid), $USER->id, $storedfile);

            $DB->execute("UPDATE {local_geniai_h5p} SET contentbanktid = '{$content->get_id()}' WHERE id = {$this->h5p->id}");
        }
        $params = ["id" => $content->get_id(), "contextid" => $this->h5p->contextid];
        $url = new \moodle_url("/contentbank/view.php", $params);
        redirect($url);
    }

    /**
     * Function get_h5p
     *
     * @return local_geniai_h5p
     */
    public function get_h5p() {
        return $this->h5p;
    }

    /**
     * Function set_h5p
     *
     * @param local_geniai_h5p $h5p
     */
    public function set_h5p($h5p): void {
        $this->h5p = $h5p;
    }

    /**
     * Returns a particular array value for the named variable, taken from
     * POST or GET.  If the parameter doesn't exist then an error is
     * thrown because we require this variable.
     *
     * This function should be used to initialise all required values
     * in a script that are based on parameters.  Usually it will be
     * used like this:
     *    $ids = param_array("ids", PARAM_INT);
     *
     *  Note: arrays of arrays are not supported, only alphanumeric keys with _ and - are supported
     *
     * @param string $parname the name of the page parameter we want
     * @param string $type    expected type of parameter
     * @param bool $required
     *
     * @return array
     * @throws Exception
     */
    private function params_array($parname, $type, $required) {
        if ($required) {
            if (func_num_args() != 2 || empty($parname) || empty($type)) {
                throw new Exception("required_param_array() requires \$parname and \$type to be specified (parameter: {$parname})");
            }
        }

        // POST has precedence.
        if (isset($_POST[$parname])) {
            $param = $_POST[$parname];
        } else if (isset($_GET[$parname])) {
            $param = $_GET[$parname];
        } else if ($required) {
            throw new Exception(get_string("missingparam", $parname));
        } else {
            return [];
        }
        if (!is_array($param) && $required) {
            throw new Exception(get_string("missingparam", $parname));
        }

        $result = [];
        foreach ($param as $key => $value) {
            if (!preg_match('/^[a-z0-9_-]+$/i', $key)) {
                debugging("Invalid key name in required_param_array() detected: {$key}, parameter: {$parname}");
                continue;
            }
            if (is_array($value)) {
                $result[$key] = clean_param_array($value, $type, true);
            } else {
                $result[$key] = clean_param($value, $type);
            }
        }

        return $result;
    }
}
