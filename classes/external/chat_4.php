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

use core_external\external_api;
use core_external\external_value;
use core_external\external_single_structure;
use core_external\external_function_parameters;

defined('MOODLE_INTERNAL') || die;
global $CFG;
require_once("{$CFG->dirroot}/lib/externallib.php");

/**
 * Chat_4 file.
 *
 * @package     local_geniai
 * @copyright   2024 Eduardo Kraus https://eduardokraus.com/
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class chat_4 extends external_api {
    /**
     * Parâmetros recebidos pelo webservice
     *
     * @return external_function_parameters
     */
    public static function api_parameters() {
        return new external_function_parameters([
            'message' => new external_value(PARAM_RAW, 'The message value'),
            'courseid' => new external_value(PARAM_TEXT, 'The Course ID'),
            "audio" => new external_value(PARAM_RAW, 'The message value', VALUE_OPTIONAL),
            "lang" => new external_value(PARAM_RAW, 'The language value', VALUE_OPTIONAL),
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
            'format' => new external_value(PARAM_TEXT, 'Formato da resposta', VALUE_REQUIRED),
            'content' => new external_value(PARAM_RAW, 'The content result', VALUE_REQUIRED),
            'transcription' => new external_value(PARAM_RAW, 'The content transcription', VALUE_OPTIONAL),
        ]);
    }

    /**
     * API para contabilizar o tempo gasto na plataforma pelos usuários
     *
     * @param string $message
     * @param int $courseid
     * @param null $audio
     * @param null $lang
     *
     * @return array
     *
     * @throws \coding_exception
     * @throws \dml_exception
     */
    public static function api($message, $courseid, $audio = null, $lang=null) {
        return api::chat_api($message, $courseid, $audio, $lang );
    }
}
