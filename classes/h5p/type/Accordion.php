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
 * base file.
 *
 * @package   local_geniai
 * @copyright 2024 Eduardo Kraus {@link http://eduardokraus.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace local_geniai\h5p\type;

use local_kopere_dashboard\html\form;
use local_kopere_dashboard\html\inputs\input_checkbox;

/**
 * Class Accordion
 *
 * @package local_geniai\h5p\type
 */
class Accordion implements h5p_base {

    /**
     * Function form
     *
     * @param form $form
     *
     * @return mixed
     * @throws \coding_exception
     */
    public function form(form $form) {
        $form->add_input(
            input_checkbox::new_instance()
                ->set_title( "Mostrar Glossário" )
                ->set_name( "mostrar_glossario" )
                ->set_value( 1 )
                ->set_checked( 1 )
        );
    }
}
