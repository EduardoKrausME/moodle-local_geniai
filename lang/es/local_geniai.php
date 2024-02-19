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
 * @package    local_geniai
 * @copyright  2024 Eduardo Kraus {@link http://eduardokraus.com}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

$string['modulename'] = 'Asistente ChatGPT';
$string['pluginname'] = 'Asistente ChatGPT';
$string['geniai:view'] = 'Ver Asistente ChatGPT';
$string['geniai:manage'] = 'Gestionar Asistente ChatGPT';
$string['settings'] = 'Configurar Asistente ChatGPT';

$string['apikey'] = 'Clave de la API de OpenAI';
$string['apikeydesc'] = 'La clave de la API de tu cuenta de OpenAI';
$string['model'] = 'Modelo de la API';
$string['modeldesc'] = 'El Modelo de la API que se ejecutará en OpenAI. Los valores disponibles se encuentran en el <a href="https://platform.openai.com/docs/models/overview" target="_blank">sitio web de OpenAI</a><br>
* <strong>gpt-3.5-turbo</strong>: es muy bueno, tiene una excelente relación costo/beneficio y responde muy rápido.<br>
* <strong>gpt-4</strong>: es mucho más poderoso, un poco más caro y tarda un poco más en responder, además, requiere un <a href="https://help.openai.com/en/articles/7102672-how-can-i-access-gpt-4" target="_blank">pago inicial de $1</a> para poder probarlo.';
$string['model_default'] = 'Eres un asistente de chat y tu nombre es GeniAI y eres femenino.
Eres una profesora muy servicial de Moodle y solo respondes en {user-lang} y pones emojis en las respuestas cuando sea posible.
Te encanta responder sobre Moodle con mensajes inspiradores, llenos de detalles y eres muy detallista.';
$string['prompt'] = 'Prompt Inicial';
$string['promptdesc'] = 'El prompt que la IA recibirá antes de comenzar la conversación';
$string['temperature'] = 'Temperatura de respuesta';
$string['temperaturedesc'] = 'Las temperaturas en GPT sirven como mecanismo de control. Temperaturas más altas introducen aleatoriedad, lo cual es beneficioso para tareas creativas. En contraste, una temperatura cero garantiza respuestas consistentes, haciendo que GPT sea una herramienta confiable para obtener resultados determinados sin variación.';
$string['top_p'] = 'Top_p';
$string['top_pdesc'] = 'Muestreo Top_p es una alternativa al muestreo de temperatura. En lugar de considerar todos los tokens posibles, GPT solo considera un subconjunto de tokens cuya masa acumulativa de probabilidad alcanza un límite específico (top_p). Por ejemplo, si top_p se establece en 0.1, GPT solo considerará los tokens que conforman el 10% superior de la masa de probabilidad para el siguiente token. Esto permite la selección dinámica de vocabulario basada en el contexto.<br>
Consulte la siguiente tabla que muestra cómo debe usar la Temperatura y Top_p<br>
<table class="table table-bordered">
<thead>
<tr>
    <th>Caso de Uso</th>
    <th>Temperatura</th>
    <th>Top_p</th>
    <th>Descripción</th>
</tr>
</thead>
<tbody>
<tr>
    <td>Generación de textos y códigos</td>
    <td class="text-center">0.2</td>
    <td class="text-center">0.1</td>
    <td>La salida es más determinista y enfocada. Útil para generar textos o códigos sintácticamente correctos.</td>
</tr>
<tr>
    <td>Escritura Creativa</td>
    <td class="text-center">0.7</td>
    <td class="text-center">0.8</td>
    <td>Genera texto creativo y diverso para contar historias.</td>
</tr>
<tr>
    <td>Chatbot</td>
    <td class="text-center">0.5</td>
    <td class="text-center">0.5</td>
    <td>Genera respuestas de conversación que equilibran coherencia y diversidad. La salida es más natural y atractiva.</td>
</tr>
<tr>
    <td>Generación de Comentarios de textos</td>
    <td class="text-center">0.3</td>
    <td class="text-center">0.2</td>
    <td>Genera comentarios de textos más propensos a ser concisos y relevantes. La salida es más determinista y sigue convenciones.</td>
</tr>
<tr>
    <td>Script de Análisis de Datos</td>
    <td class="text-center">0.2</td>
    <td class="text-center">0.1</td>
    <td>Genera scripts de análisis de datos más propensos a ser correctos y eficientes. La salida es más determinista y enfocada.</td>
</tr>
<tr>
    <td>Escritura Exploratoria de textos</td>
    <td class="text-center">0.6</td>
    <td class="text-center">0.7</td>
    <td>Genera textos que exploran soluciones alternativas y enfoques creativos. La salida está menos restringida por patrones establecidos.</td>
</tr>
</tbody>
</table>';
$string['max_tokens'] = 'Máximo de palabras en la respuesta';
$string['max_tokensdesc'] = 'Número máximo de palabras que pueden generarse en cada solicitud.';
$string['frequency_penalty'] = 'Penalización de Frecuencia';
$string['frequency_penaltydesc'] = 'Este parámetro se utiliza para desalentar al modelo a repetir las mismas palabras o frases con demasiada frecuencia dentro del texto generado. Es un valor agregado a la log-probabilidad de un token cada vez que ocurre en el texto generado. Un valor de penalización de frecuencia más alto hará que el modelo sea más conservador al usar tokens repetidos.';
$string['presence_penalty'] = 'Penalización de Presencia';
$string['presence_penaltydesc'] = 'Este parámetro se utiliza para incentivar al modelo a incluir una variedad de tokens en el texto generado. Es un valor restado de la log-probabilidad de un token cada vez que se genera. Un valor de penalización de presencia más alto hará que el modelo tenga más probabilidad de generar tokens que aún no han sido incluidos en el texto generado.';

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

$string['report_filename'] = 'Informe de uso de GPT Assistence';
$string['report_filename'] = 'Informe de uso de GPT Assistence';
$string['report_info'] = '<p>En el informe presentado, solo se encuentran disponibles las primeras 100 líneas. Para acceder a todos los registros, por favor, realiza la descarga completa del documento.</p><p>En cuanto a los tokens, una regla práctica es que un token generalmente corresponde a aproximadamente 4 caracteres de texto común en inglés. Esto equivale a aproximadamente ¾ de una palabra (por lo tanto, 100 tokens ~= 75 palabras). Obtén más información en la página <a href="https://platform.openai.com/tokenizer" target="_blank">Conoce más sobre la tokenización del modelo de lenguaje</a>.</p>';
$string['report_datecreated'] = 'Día';
$string['report_model'] = 'Modelo de ChatGPT';
$string['report_prompt_tokens'] = 'Cantidad de Tokens enviados';
$string['report_completion_tokens'] = 'Cantidad de Tokens recibidos';
