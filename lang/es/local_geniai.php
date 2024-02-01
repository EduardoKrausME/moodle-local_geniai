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

$string['modulename'] = 'Asistente ChatGPT';
$string['pluginname'] = 'Asistente ChatGPT';
$string['geniai:view'] = 'Ver Asistente ChatGPT';
$string['geniai:manage'] = 'Gestionar Asistente ChatGPT';
$string['settings'] = 'Configurar Asistente ChatGPT';

$string['apikey'] = 'Clave de la API de OpenAI';
$string['apikeydesc'] = 'La clave de la API de tu cuenta de OpenAI';
$string['model'] = 'Modelo de la API';
$string['modeldesc'] = 'El modelo de la API que se ejecutará en OpenAI.';
$string['model_default'] = 'Eres un asistente de chat y tu nombre es GeniAI y eres femenino. 
Eres una profesora muy servicial de Moodle y solo respondes en {user-lang} y pones emojis en las respuestas cuando sea posible. 
Te encanta responder sobre Moodle con mensajes inspiradores, llenos de detalles y eres muy detallista.';
$string['prompt'] = 'Prompt Inicial';
$string['promptdesc'] = 'El prompt que la IA recibirá antes de comenzar la conversación';

$string['clear_history'] = 'Limpiar';
$string['clear_history_title'] = 'Limpiar todo el historial';
$string['online'] = 'En línea';
$string['write_message'] = 'Escribe un mensaje...';
$string['send_message'] = 'Enviar mensaje';
$string['message_01'] = '¡Hola, querido/a estudiante {$a}! 🌟';
$string['message_02_home'] = 'Soy GeniAI y estoy aquí para hacer tu viaje de aprendizaje lo más increíble posible.
¿Cómo puedo ayudarte hoy? 🌟📚';
$string['message_02_course'] = 'Bienvenido al curso {$a->coursename} en Moodle {$a->moodlename}!
Soy GeniAI y estoy aquí para hacer tu viaje de aprendizaje lo más increíble posible.
¿Cómo puedo ayudarte hoy? 🌟📚';

$string['url_moodle'] = 'La URL de Moodle es "{$a->wwwroot}" y el nombre de Moodle es "{$a->fullname}"';
$string['course_user'] = 'El estudiante está en el curso "{$a->course}" y el nombre del estudiante es "{$a->userfullname}"';
$string['course_home'] = 'El estudiante está fuera del curso y el nombre del estudiante es "{$a->userfullname}".';
