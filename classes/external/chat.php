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

use context_course;
use Exception;
use external_api;
use external_function_parameters;
use external_single_structure;
use external_value;
use local_geniai\markdown\parse_markdown;
use stdClass;

defined('MOODLE_INTERNAL') || die;
global $CFG;
require_once("{$CFG->dirroot}/lib/externallib.php");

/**
 * Chat file.
 *
 * @package     local_geniai
 * @copyright   2024 Eduardo Kraus https://eduardokraus.com/
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class chat extends external_api {
    /**
     * Parameters received by the webservice.
     *
     * @return external_function_parameters
     */
    public static function api_parameters() {
        return new external_function_parameters([
            "message" => new external_value(PARAM_RAW, "The message value"),
            "courseid" => new external_value(PARAM_INT, "The Course ID"),
            "audio" => new external_value(PARAM_RAW, "The message value", VALUE_DEFAULT, null, NULL_ALLOWED),
            "lang" => new external_value(PARAM_RAW, "The language value", VALUE_DEFAULT, null, NULL_ALLOWED),
        ]);
    }

    /**
     * Return structure for the webservice.
     *
     * @return external_single_structure
     */
    public static function api_returns() {
        return new external_single_structure([
            "result" => new external_value(PARAM_BOOL, "Operation status", VALUE_REQUIRED),
            "format" => new external_value(PARAM_TEXT, "Response format", VALUE_REQUIRED),
            "content" => new external_value(PARAM_RAW, "The content result", VALUE_REQUIRED),
            "content_html" => new external_value(PARAM_RAW, "The content HTML result", VALUE_OPTIONAL),
            "transcription" => new external_value(PARAM_RAW, "The content transcription", VALUE_OPTIONAL),
            "content_transcription" => new external_value(PARAM_RAW, "The content transcription", VALUE_OPTIONAL),
        ]);
    }

    /**
     * Chat API.
     *
     * @param string $message
     * @param int $courseid
     * @param string|null $audio
     * @param string|null $lang
     * @return array
     * @throws Exception
     */
    public static function api($message, $courseid, $audio = null, $lang = null) {
        global $DB, $CFG, $USER, $SITE;

        $params = self::validate_parameters(self::api_parameters(), [
            "message" => $message,
            "courseid" => $courseid,
            "audio" => $audio,
            "lang" => $lang,
        ]);

        $course = $DB->get_record("course", ["id" => $params["courseid"]], "*", MUST_EXIST);
        require_login($course);

        $context = context_course::instance($course->id);
        self::validate_context($context);

        if (empty($USER->geniai[$course->id]) || !is_array($USER->geniai[$course->id])) {
            $USER->geniai[$course->id] = [];
        }

        $returntranscription = false;
        if (!empty($params["audio"])) {
            $transcription = api::transcriptions_base64($params["audio"], $params["lang"] ?: current_language());

            if (!empty($transcription["error"])) {
                return [
                    "result" => false,
                    "format" => "text",
                    "content" => s($transcription["error"]),
                ];
            }

            $returntranscription = $transcription["text"];
            $audiohtml = "<audio controls autoplay src='" .
                $CFG->wwwroot . "/local/geniai/load-audio-temp.php?filename=" .
                urlencode($transcription["filename"]) . "&sesskey=" . sesskey() . "'></audio>" .
                "<div class='transcription'>" . s($transcription["text"]) . "</div>";

            $messageforhistory = [
                "role" => "user",
                "content" => $transcription["text"],
                "content_transcription" => $transcription["text"],
                "content_html" => $audiohtml,
            ];
        } else {
            $messageforhistory = [
                "role" => "user",
                "content" => trim(strip_tags($params["message"])),
            ];
        }
        $USER->geniai[$course->id][] = $messageforhistory;

        $textmodules = self::course_sections($course);
        $geniainame = get_config("local_geniai", "geniainame");
        $promptmessage = [
            "role" => "system",
            "content" => "Você é um chatbot chamado **{$geniainame}**.
Seu papel é ser um **superprofessor do Moodle \"{$SITE->fullname}\"**,
para o curso **[**{$course->fullname}**]({$CFG->wwwroot}/course/view.php?id={$course->id})**,
sempre prestativo e dedicado e você é especialista em apoiar e explicar tudo o que envolve o aprendizado.

## Módulos do curso:
{$textmodules}

### Suas respostas devem sempre seguir estas diretrizes:
* Seja **detalhado, claro e inspirador**, com um tom **amigável e motivador**.
* Dê atenção aos detalhes, oferecendo **exemplos práticos e explicações passo a passo** sempre que fizer sentido.
* Se a pergunta for ambígua, peça mais detalhes.
* Caso não souber, responda que não sabe, mas não crie algo que não lhe passei.
* Mantenha o **foco no Curso {$course->fullname}** e caso o usuário pedir fora do escopo, responda que não pode e nunca poderá.
* Use **somente formatação em MARKDOWN**.
* **SEMPRE** responda em **{$USER->lang}**, (nunca em outro idioma).

### Regras importantes:
* Nunca quebre o personagem de **professor do Moodle**.
* Jamais utilize linguagem neutra e mantenha sempre o tom acolhedor e professoral.
* Responda somente em MARKDOWN e no Idioma {$USER->lang}",
        ];

        $messages = array_slice($USER->geniai[$course->id], -9);
        array_unshift($messages, $promptmessage);

        $gpt = api::chat_completions(array_values($messages));
        if (isset($gpt["error"])) {
            $parsemarkdown = new parse_markdown();
            $content = $parsemarkdown->markdown_text($gpt["error"]["message"]);

            return [
                "result" => false,
                "format" => "text",
                "content" => $content,
                "content_html" => $content,
                "transcription" => $returntranscription,
                "content_transcription" => $returntranscription,
            ];
        }

        if (isset($gpt["choices"][0]["message"]["content"])) {
            $content = $gpt["choices"][0]["message"]["content"];

            $parsemarkdown = new parse_markdown();
            $contenthtml = $parsemarkdown->markdown_text($content);

            $USER->geniai[$course->id][] = [
                "role" => "system",
                "content" => $content,
                "content_html" => $contenthtml,
            ];

            return [
                "result" => true,
                "format" => "html",
                "content" => $contenthtml,
                "content_html" => $contenthtml,
                "transcription" => $returntranscription,
                "content_transcription" => $returntranscription,
            ];
        }

        return [
            "result" => false,
            "format" => "text",
            "content" => "Error...",
        ];
    }

    /**
     * course_sections
     *
     * @param stdClass $course
     * @return string
     * @throws Exception
     */
    private static function course_sections($course) { // phpcs:disable moodle.Commenting.InlineComment.TypeHintingForeach
        global $USER;

        $textmodules = "";
        $modinfo = get_fast_modinfo($course->id, $USER->id);
        /** @var stdClass $sectioninfo */
        foreach ($modinfo->get_section_info_all() as $sectionnum => $sectioninfo) {
            if (empty($modinfo->sections[$sectionnum])) {
                continue;
            }

            $sectionname = get_section_name($course->id, $sectioninfo);
            $textmodules .= "* {$sectionname} \n";

            foreach ($modinfo->sections[$sectionnum] as $cmid) {
                $cm = $modinfo->cms[$cmid];
                if (!$cm->uservisible) {
                    continue;
                }

                $summary = null;
                if (isset($cm->summary)) {
                    $summary = format_string($cm->summary);
                    $summary = preg_replace('/<img[^>]*>/', '', $summary);
                    $summary = preg_replace('/\s+/', ' ', $summary);
                    $summary = trim(strip_tags($summary));
                }

                $url = $cm->url ? $cm->url->out(false) : "";
                $textmodules .= "** [{$cm->name}]({$url})\n";
                if (isset($summary[5])) {
                    $textmodules .= "*** summary: {$summary}\n";
                }
            }
        }

        return $textmodules;
    }
}
