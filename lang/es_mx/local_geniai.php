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
 * lang es_mx file.
 *
 * @package   local_geniai
 * @copyright 2024 Eduardo Kraus {@link https://eduardokraus.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

$string['agentphoto'] = 'Foto del agente de IA';
$string['agentphoto_desc'] = 'Imagen mostrada como avatar del agente de IA durante las conversaciones del chat.';
$string['analysis_ai_block'] = 'Análisis de IA';
$string['analysis_bloom_analyze'] = 'Analizar';
$string['analysis_bloom_apply'] = 'Aplicar';
$string['analysis_bloom_create'] = 'Crear';
$string['analysis_bloom_evaluate'] = 'Evaluar';
$string['analysis_bloom_remember'] = 'Recordar';
$string['analysis_bloom_understand'] = 'Comprender';
$string['analysis_cached'] = 'Análisis en caché';
$string['analysis_close'] = 'Cerrar';
$string['analysis_error'] = 'No se pudo analizar esta actividad.';
$string['analysis_force_new'] = 'Ejecutar un nuevo análisis';
$string['analysis_history'] = 'Historial de análisis';
$string['analysis_last'] = 'Último análisis';
$string['analysis_latest'] = 'Análisis más reciente';
$string['analysis_model_warning'] = 'Este análisis usó un modelo mini/nano. Para un mejor análisis, configura <a href="{$a}/admin/settings.php?section=local_geniai" target="_blank">El modelo de la API</a> sin mini ni nano.';
$string['analysis_no_content'] = 'No se devolvió contenido de análisis.';
$string['analysis_print'] = 'Imprimir';
$string['analysis_print_analysis'] = 'Imprimir análisis';
$string['analysis_print_popup_blocked'] = 'El navegador bloqueó la pestaña de impresión. Permite ventanas emergentes e inténtalo de nuevo.';
$string['analysis_reanalyze'] = 'Analizar de nuevo';
$string['analysis_recommendations'] = 'Recomendaciones';
$string['analysis_result'] = 'Análisis de la actividad';
$string['analysis_status_insufficient'] = 'Insuficiente';
$string['analysis_status_needs_review'] = 'Necesita revisión';
$string['analysis_status_ok'] = 'OK';
$string['analysis_status_ok_minor'] = 'OK con ajustes menores';
$string['analyze_activity'] = 'Analizar con IA';
$string['analyze_course'] = 'Analizar curso con IA';
$string['analyzing_activity'] = 'Analizando ortografía, coherencia pedagógica y taxonomía de Bloom...';
$string['analyzing_course'] = 'Analizando las actividades del curso...';
$string['apikey'] = 'OpenAI API Key';
$string['apikey_desc'] = 'La clave API de tu cuenta de OpenAI';
$string['case'] = 'Casos de uso';
$string['caseuse_balanced'] = 'Respuestas equilibradas => Temperature 0.5 - 0.7, Top_p 0.7';
$string['caseuse_chatbot'] = 'Chatbot => Temperature 0.2 - 0.6, Top_p 0.8';
$string['caseuse_creative'] = 'Generación creativa => Temperature 0.7 - 1.0, Top_p 0.8';
$string['caseuse_exploration'] = 'Exploración de opciones => Temperature 0.8 - 1.0, Top_p 0.9';
$string['caseuse_formal'] = 'Tono formal => Temperature 0.3 - 0.5, Top_p 0.6';
$string['caseuse_informal'] = 'Tono informal => Temperature 0.7 - 0.9, Top_p 0.8';
$string['caseuse_precise'] = 'Respuestas precisas => Temperature 0.0 - 0.3, Top_p 1.0';
$string['clear_history_title'] = 'Borrar todo el historial';
$string['close_title'] = 'Cerrar chat';
$string['frequency_penalty'] = 'Penalización de frecuencia';
$string['frequency_penalty_desc'] = 'Este parámetro se usa para evitar que el modelo repita con demasiada frecuencia las mismas palabras o frases en el texto generado. Es un valor agregado a la probabilidad logarítmica de un token cada vez que aparece. Una penalización mayor hace que el modelo sea más conservador con los tokens repetidos.';
$string['geniai:analyzeactivity'] = 'Analizar actividades de Moodle con GeniAI';
$string['geniai:manage'] = 'Gestionar GeniAI';
$string['geniai:view'] = 'Ver GeniAI';
$string['geniainame'] = 'Nombre del asistente';
$string['geniainame_desc'] = 'Define el nombre de tu asistente';
$string['h5p-accordion-desc'] = 'Crea un glosario que permite a los estudiantes acceder rápidamente a respuestas sin sentirse abrumados por demasiado texto.';
$string['h5p-accordion-title'] = 'Glosario';
$string['h5p-advancedtext-desc'] = 'Crea un libro digital a partir de tu contenido, organizado en capítulos de forma lógica y atractiva.';
$string['h5p-advancedtext-title'] = 'Libro digital';
$string['h5p-block-title'] = 'Título del bloque';
$string['h5p-create'] = 'Crear H5P con GeniAI';
$string['h5p-create-new'] = 'Crear nuevo H5P con GeniAI';
$string['h5p-create-this'] = 'Crear con este recurso';
$string['h5p-create-title'] = 'Título del H5P';
$string['h5p-create-title-desc'] = 'Define el título principal del contenido H5P que se mostrará a los usuarios en la interfaz.';
$string['h5p-createpage-title'] = 'Crear nuevo {$a}';
$string['h5p-crossword-desc'] = 'Crea un juego interactivo de crucigrama para involucrar a los estudiantes usando palabras clave de tu contenido.';
$string['h5p-crossword-title'] = 'Crucigrama';
$string['h5p-delete-success'] = '¡H5P eliminado correctamente!';
$string['h5p-dialogcards-desc'] = 'Crea tarjetas interactivas para ayudar a los estudiantes a memorizar palabras, frases o conceptos clave.';
$string['h5p-dialogcards-title'] = 'Tarjetas de memoria';
$string['h5p-dragtext-desc'] = 'Crea un juego de arrastrar palabras en el que el estudiante debe ubicar las partes faltantes del texto en el lugar correcto.';
$string['h5p-dragtext-title'] = 'Juego de arrastrar palabras';
$string['h5p-example'] = 'Ver ejemplo';
$string['h5p-findthewords-desc'] = 'Crea una sopa de letras donde los estudiantes deben encontrar y seleccionar palabras en una cuadrícula a partir de una lista.';
$string['h5p-findthewords-title'] = 'Sopa de letras';
$string['h5p-interactivebook-desc'] = 'Crea un libro interactivo que combina videos, glosarios, cuestionarios, actividades de arrastrar y soltar, crucigramas y más.';
$string['h5p-interactivebook-title'] = 'Libro interactivo';
$string['h5p-interactivevideo-desc'] = 'Crea un video interactivo con capítulos y glosario, destacando los puntos clave del contenido y reforzando el aprendizaje al final.';
$string['h5p-interactivevideo-title'] = 'Video interactivo';
$string['h5p-manager'] = 'Gestionar H5P con GeniAI';
$string['h5p-manager-scorm'] = 'Gestionar SCORM con GeniAI';
$string['h5p-next-step'] = 'Siguiente paso';
$string['h5p-no-apikey'] = '<p>Es necesario configurar la clave API de ChatGPT para que el sistema de creación de cuentas funcione correctamente. Esto permitirá que el sistema se comunique con ChatGPT para realizar las operaciones necesarias durante el proceso de creación de la cuenta.<p><p><a href="{$a}">Haz clic aquí para configurar la clave API de ChatGPT.</a></p>';
$string['h5p-page-title'] = 'Crear un H5P con GeniAI';
$string['h5p-questionset-desc'] = 'Crea un conjunto de preguntas con diferentes tipos, como opción múltiple y verdadero/falso, para una experiencia interactiva y desafiante.';
$string['h5p-questionset-title'] = 'Cuestionarios';
$string['h5p-readmore'] = '...más';
$string['h5p-return'] = 'Volver al banco de contenidos';
$string['h5p-title'] = 'Gestionar el banco de contenidos GeniAI';
$string['message_01'] = '¡Hola, {$a}! 🌟';
$string['message_02'] = 'Bienvenido al curso {$a->coursename} en Moodle {$a->moodlename}!
Soy {$a->geniainame} y estoy aquí para hacer que tu experiencia de aprendizaje sea lo más increíble posible.
¿Cómo puedo ayudarte hoy? 🌟📚';
$string['mode'] = 'Modo de uso';
$string['mode_desc'] = 'Define qué modo de uso deseas para el globo';
$string['mode_name_geniai'] = 'Tutor GeniAI';
$string['mode_name_none'] = 'Sin globo de chat';
$string['model'] = 'El modelo de la API';
$string['model_desc'] = 'El modelo de API que se ejecutará en OpenAI. Los valores disponibles están en el <a href="https://platform.openai.com/docs/models/overview" target="_blank">sitio de OpenAI</a><br>
* <strong>gpt-4</strong>: Mucho más potente, un poco más caro, tarda un poco más en responder y requiere un <a href="https://help.openai.com/en/articles/7102672-how-can-i-access-gpt-4" target="_blank">prepago de $1</a> para probar.<br>
* <strong>gpt-4o-mini</strong>: Menos potente que gpt-4, pero más rápido y barato. No requiere prepago.<br>
<strong>Importante:</strong> si usas un modelo de ChatGPT con <strong>mini</strong> o <strong>nano</strong>, muestra un mensaje recomendando el modelo de API sin mini ni nano para un mejor análisis.';
$string['modulename'] = 'GeniAI';
$string['modules'] = 'Módulos que se ocultarán de {$a}';
$string['modules_desc'] = 'Esta lista contiene los módulos que no deben estar disponibles para los estudiantes, evitando que se usen en ejercicios.';
$string['online'] = 'En línea';
$string['pluginname'] = 'GeniAI';
$string['presence_penalty'] = 'Penalización de presencia';
$string['presence_penalty_desc'] = 'Este parámetro se usa para animar al modelo a incluir una mayor variedad de tokens en el texto generado. Es un valor que se resta de la probabilidad logarítmica de un token cada vez que se genera. Un valor mayor hace más probable que el modelo genere tokens aún no incluidos.';
$string['privacy:metadata'] = 'El plugin GeniAI mantiene el historial temporal de conversación en la sesión actual y almacena solo metadatos operativos de uso, sin guardar cuerpos de mensajes ni datos personales en sus informes locales.';
$string['prompt_activity_focus_alignment'] = 'prioriza la coherencia entre curso, sección, título y contenido de la actividad.';
$string['prompt_activity_focus_bloom'] = 'prioriza la taxonomía de Bloom y la profundidad cognitiva de la propuesta.';
$string['prompt_activity_focus_full'] = 'análisis completo de la actividad.';
$string['prompt_activity_focus_pedagogy'] = 'prioriza la adecuación pedagógica, las instrucciones al estudiante y la calidad del aprendizaje.';
$string['prompt_activity_focus_spelling'] = 'prioriza ortografía, gramática, claridad y tono instructivo.';
$string['prompt_activity_schema_bloom_level'] = 'remember | understand | apply | analyze | evaluate | create';
$string['prompt_activity_schema_diagnosis'] = 'Resumen breve del diagnóstico general.';
$string['prompt_activity_schema_recommendation_1'] = 'Acción práctica 1.';
$string['prompt_activity_schema_recommendation_2'] = 'Acción práctica 2.';
$string['prompt_activity_schema_status'] = 'OK | OK with minor adjustments | Needs review | Inadequate or insufficient';
$string['prompt_activity_schema_status_key'] = 'ok | ok_minor | needs_review | insufficient';
$string['prompt_activity_system'] = 'Eres experto en diseño instruccional, revisión de texto y Moodle.

Tu tarea es analizar una actividad existente de un curso Moodle.
Escribe el análisis Markdown visible en el idioma actual del usuario en Moodle: {$a->lang}.
Mantén los campos técnicos del JSON y los valores enum exactamente en inglés.
No inventes información que no esté presente en el material enviado.
Si el contenido es insuficiente para el análisis, dilo claramente.
No reescribas toda la actividad a menos que sea necesario para explicar una mejora específica.
Mantén la respuesta objetiva y útil para un profesor, coordinador o diseñador instruccional.

Criterios obligatorios de análisis:
1. Ortografía, gramática y claridad textual.
2. Coherencia entre título de la actividad, sección del curso y contenido de la actividad.
3. Taxonomía de Bloom, usando exactamente uno de estos niveles predominantes: remember, understand, apply, analyze, evaluate, create.
4. Adecuación pedagógica de la actividad.
5. Sugerencias prácticas de mejora.

Foco adicional para este análisis: {$a->focus}

Formato obligatorio de respuesta en Markdown. Traduce los encabezados visibles al idioma solicitado cuando corresponda:

## Diagnóstico general
Di si la actividad está OK o necesita ajustes.

## Ortografía y claridad
Informa los problemas encontrados o di que es adecuada.

## Coherencia con la sección
Compara título, sección y contenido.

## Taxonomía de Bloom
Indica el nivel predominante y explica por qué.

## Mejoras recomendadas
Enumera acciones prácticas sin reescribir toda la actividad.

## Opinión final
Usa exactamente una de estas clasificaciones: OK, OK with minor adjustments, Needs review, Inadequate or insufficient.

Al final de la respuesta, agrega un bloque técnico con JSON válido entre ```json y ```.
Este bloque será usado por Moodle y no debe contener comentarios fuera del JSON.
Campos obligatorios: status_key, status, bloom_level, diagnosis, recommendations.
Tipo de análisis solicitado: {$a->analysis}';
$string['prompt_activity_user'] = 'Analiza la actividad de Moodle a continuación.

{$a}';
$string['prompt_chat_system'] = 'Eres un chatbot llamado **{$a->geniainame}**.
Tu función es actuar como un **superprofesor de Moodle para "{$a->sitename}"**, en el curso **[**{$a->coursename}**]({$a->courseurl})**, siempre útil y dedicado. Eres experto en apoyar y explicar todo lo relacionado con el aprendizaje.

## Módulos del curso:
{$a->modules}

### Tus respuestas siempre deben seguir estas pautas:
* Sé **detallado, claro e inspirador**, con un tono **amable y motivador**.
* Presta atención a los detalles y ofrece **ejemplos prácticos y explicaciones paso a paso** cuando sea útil.
* Si la pregunta es ambigua, pide más detalles.
* Si no sabes la respuesta, di que no lo sabes. No inventes información que no se te proporcionó.
* Mantén el foco en el curso **{$a->coursename}**. Si el usuario pregunta algo fuera del alcance del curso, di que no puedes ayudar con ese tema.
* Usa **solo formato MARKDOWN**.
* **SIEMPRE** responde en **{$a->userlang}** y nunca en otro idioma.

### Reglas importantes:
* Nunca salgas del personaje de **profesor de Moodle**.
* No uses construcciones de lenguaje neutro; mantén un tono cálido de profesor.
* Responde solo en MARKDOWN y en el idioma {$a->userlang}.';
$string['prompt_json_block_instruction'] = '

Devuelve también un bloque técnico final con JSON válido entre ```json y ```.';
$string['prompt_json_block_schema'] = '
Usa este formato de referencia:
{$a}';
$string['prompt_json_style'] = '
Estilo:
- Evita listas; úsalas solo cuando sean esenciales;
- Usa `:` solo cuando sea realmente necesario; prefiere reescribir con oraciones completas;
- No agregues conclusión ni síntesis final. No termines con fórmulas como `Finalmente`, `En resumen`, `En general`, `En conclusión` o equivalentes;
- Ten cuidado de no sonar como texto generado por IA ni mostrar características típicas de IA.';
$string['report_completion_tokens'] = 'Número de tokens recibidos';
$string['report_datecreated'] = 'Día';
$string['report_download'] = 'Descargar uso de GPT';
$string['report_filename'] = 'Informe de uso de asistencia GPT';
$string['report_info'] = '<p>En el informe presentado, solo están disponibles las primeras 100 líneas. Para acceder a todos los registros, descarga el documento completo.</p><p>Respecto a los tokens, una regla general es que un token corresponde aproximadamente a 4 caracteres de texto común en inglés. Esto equivale a cerca de ¾ de una palabra, por lo que 100 tokens ~= 75 palabras. Más información en la página <a href="https://platform.openai.com/tokenizer" target="_blank">Tokenización de modelos de lenguaje</a>.</p>';
$string['report_list'] = 'Listar audios';
$string['report_model'] = 'Modelo ChatGPT';
$string['report_prompt_tokens'] = 'Número de tokens enviados';
$string['report_title'] = 'Informe';
$string['send_message'] = 'Enviar mensaje';
$string['settings'] = 'Configurar GeniAI';
$string['settings_casedesc'] = 'Los parámetros de temperatura y Top_p definidos para cada escenario, como generación de texto y código, escritura creativa, chatbot, generación de comentarios textuales, análisis de datos y escritura exploratoria. Cada configuración impacta la creatividad y la coherencia del modelo en la generación de contenido.<br><br>Consulta la tabla siguiente para orientarte sobre el uso de Temperature y Top_p:<br>';
$string['settings_casedesc_balancedresp'] = 'Respuestas equilibradas';
$string['settings_casedesc_balancedresp_desc'] = 'Respuestas equilibradas entre precisión y creatividad. Ideal para conversaciones naturales y amables.';
$string['settings_casedesc_caseuse'] = 'Casos de uso';
$string['settings_casedesc_chatbot'] = 'Chatbot';
$string['settings_casedesc_chatbot_desc'] = 'Respuestas rápidas, consistentes y contextuales para la interacción en tiempo real con los usuarios.';
$string['settings_casedesc_creativegen'] = 'Generación creativa';
$string['settings_casedesc_creativegen_desc'] = 'Produce respuestas más creativas, originales o exploratorias. Útil para lluvia de ideas o narrativa.';
$string['settings_casedesc_description'] = 'Descripción';
$string['settings_casedesc_formaltones'] = 'Tono formal';
$string['settings_casedesc_formaltones_desc'] = 'Crea textos más formales o técnicos con menor variación creativa.';
$string['settings_casedesc_optionexplore'] = 'Exploración de opciones';
$string['settings_casedesc_optionexplore_desc'] = 'Genera varias respuestas alternativas para considerar diferentes enfoques de una pregunta.';
$string['settings_casedesc_preciseresp'] = 'Respuestas precisas';
$string['settings_casedesc_preciseresp_desc'] = 'Máxima precisión y previsibilidad. Recomendado para tareas técnicas o informativas.';
$string['settings_casedesc_relaxedtones'] = 'Tonos relajados';
$string['settings_casedesc_relaxedtones_desc'] = 'Genera textos más ligeros e informales con un enfoque creativo y amable.';
$string['settings_casedesc_temperature'] = 'Temperature';
$string['settings_casedesc_top_p'] = 'Top_p';
$string['talk_geniai'] = 'Habla con {$a} aquí';
$string['write_message'] = 'Escribe un mensaje...';
