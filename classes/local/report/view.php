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

namespace local_geniai\local\report;

defined('MOODLE_INTERNAL') || die;
global $CFG;
require_once("{$CFG->libdir}/tablelib.php");

/**
 * Geniai view file.
 *
 * @package     local_geniai
 * @copyright   2024 Eduardo Kraus https://eduardokraus.com/
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class view extends \table_sql {

    /**
     * local_view constructor.
     *
     * @param string $uniqueid
     *
     * @throws \coding_exception
     */
    public function __construct($uniqueid) {
        parent::__construct($uniqueid);

        $this->is_downloadable(true);
        $this->show_download_buttons_at([TABLE_P_BOTTOM]);

        $download = optional_param('download', null, PARAM_ALPHA);
        if ($download) {
            raise_memory_limit(MEMORY_EXTRA);
            $filename = get_string('report_filename', 'local_geniai');
            $this->is_downloading($download, $filename);
        }

        $columns = [
            'datecreated',
            'model',
            'prompt_tokens',
            'completion_tokens',
        ];
        $headers = [
            get_string('report_datecreated', 'local_geniai'),
            get_string('report_model', 'local_geniai'),
            get_string('report_prompt_tokens', 'local_geniai'),
            get_string('report_completion_tokens', 'local_geniai'),
        ];

        $this->define_columns($columns);
        $this->define_headers($headers);
    }

    /**
     * col datecreated.
     *
     * @param \stdClass $linha
     *
     * @return string
     *
     * @throws \coding_exception
     */
    public function col_datecreated($linha) {
        return userdate(strtotime($linha->datecreated), get_string('strftimedate', 'langconfig'));
    }

    /**
     * personal query_db.
     *
     * @param int $pagesize
     * @param bool $useinitialsbar
     *
     * @throws \dml_exception
     * @throws \coding_exception
     */
    public function query_db($pagesize, $useinitialsbar = true) {
        global $DB;

        $order = $this->get_sort_for_table($this->uniqueid);
        if (!$order) {
            $order = "datecreated";
        }

        $limit = "LIMIT 100";
        if (optional_param('download', null, PARAM_ALPHA)) {
            $limit = "";
        }

        $this->sql = "
                SELECT *
                  FROM (
                      SELECT SUM(prompt_tokens)     AS prompt_tokens,
                             SUM(completion_tokens) AS completion_tokens,
                             datecreated, model
                        FROM {local_geniai_usage}
                    GROUP BY model, datecreated
                    ORDER BY datecreated DESC
                       {$limit}
                ) AS t
              ORDER BY t.{$order}";

        $this->pageable(false);

        if ($useinitialsbar && !$this->is_downloading()) {
            $this->initialbars(true);
        }

        $this->rawdata = $DB->get_recordset_sql($this->sql, [], $this->get_page_start(), $this->get_page_size());
    }
}
