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

namespace local_geniai\external;

use external_api;
use external_value;
use external_single_structure;
use external_function_parameters;

defined('MOODLE_INTERNAL') || die;
global $CFG;
require_once("{$CFG->dirroot}/lib/externallib.php");

/**
 * History_3 file.
 *
 * @package     local_geniai
 * @copyright   2024 Eduardo Kraus https://eduardokraus.com/
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class history_3 extends external_api {
    /**
     * Parâmetros recebidos pelo webservice
     *
     * @return external_function_parameters
     */
    public static function api_parameters() {
        return new external_function_parameters([
            'courseid' => new external_value(PARAM_TEXT, 'The Course ID'),
            'action' => new external_value(PARAM_TEXT, 'The action'),
        ]);
    }

    /**
     * Identificador do retorno do webservice
     *
     * @return external_single_structure
     */
    public static function api_returns() {
        return new external_single_structure([
            'result' => new external_value(PARAM_TEXT, 'Sucesso da operação', VALUE_REQUIRED),
            'content' => new external_value(PARAM_RAW, 'The content result', VALUE_REQUIRED),
        ]);
    }

    /**
     * API para contabilizar o tempo gasto na plataforma pelos usuários
     *
     * @param int $courseid
     * @param string $action
     *
     * @return array
     * @throws \required_capability_exception
     */
    public static function api($courseid, $action) {
        $context = \context_course::instance($courseid);
        require_capability('local/geniai:view', $context);

        return api::history_api($courseid, $action);
    }
}
