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
 * User: Eduardo Kraus
 * Date: 31/01/2024
 * Time: 22:43
 */

namespace local_geniai\external;

use external_api;
use external_value;
use external_single_structure;
use external_function_parameters;

class history extends external_api {
    /**
     * Parâmetros recebidos pelo webservice
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
     * @param $courseid
     * @param $action
     * @return array
     */
    public static function api($courseid, $action) {

        if ($action == "clear") {
            $_SESSION["messages-{$courseid}"] = [];
            return [
                'result' => true,
                'content' => "[]",
            ];
        }

        if (isset($_SESSION["messages-{$courseid}"])) {
            $messages = $_SESSION["messages-{$courseid}"];
            unset($messages[0]);
            unset($messages[1]);
            unset($messages[2]);
        } else {
            $messages = [];
        }

        $returnmessage = [];
        foreach ($messages as $message) {
            $message->format = 'text';
            if (preg_match('/<\w+>/', $message->content)) {
                $message->format = 'html';
            }
            $returnmessage[] = $message;
        }

        return [
            'result' => true,
            'content' => json_encode($returnmessage),
        ];

    }
}
