<?php
/**
 * User: Eduardo Kraus
 * Date: 12/01/2024
 * Time: 11:30
 */

namespace local_geniai\report;

use html_writer;
use moodle_url;

require_once("{$CFG->libdir}/tablelib.php");

/**
 * @package   local_geniai
 * @copyright 2024 Eduardo Kraus {@link http://eduardokraus.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class geniai_view extends \table_sql {

    /**
     * local_geniai_view constructor.
     *
     * @param $uniqueid
     *
     * @throws \coding_exception
     * @throws \dml_exception
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
     * @param $linha
     * @return string
     * @throws \coding_exception
     */
    public function col_datecreated($linha) {

        return userdate($linha->timecreated, get_string('strftimedate', 'langconfig'));
    }

    /**
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
                      SELECT SUM(prompt_tokens)                                  AS prompt_tokens,
                             SUM(completion_tokens)                              AS completion_tokens,
                             DATE_FORMAT(FROM_UNIXTIME(timecreated), '%Y-%m-%d') AS datecreated,
                             model, timecreated
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