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

use dml_exception;
use Exception;
use local_geniai\markdown\parse_markdown;
use stdClass;

/**
 * Global api file.
 *
 * @package     local_geniai
 * @copyright   2024 Eduardo Kraus https://eduardokraus.com/
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class api {
    /**
     * History api function.
     *
     * @param int $courseid
     * @param string $action
     * @return array
     */
    public static function history_api($courseid, $action) {
        if ($action == "clear") {
            $_SESSION["messages-v3-{$courseid}"] = [];
            return [
                "result" => true,
                "content" => "[]",
            ];
        }

        if (isset($_SESSION["messages-v3-{$courseid}"])) {
            $messages = $_SESSION["messages-v3-{$courseid}"];
            unset($messages[0]);
            unset($messages[1]);
            unset($messages[2]);
        } else {
            $messages = [];
        }

        $returnmessage = [];
        foreach ($messages as $message) {
            $parsemarkdown = new parse_markdown();

            if (strpos($message["content"], "<audio") === false) {
                $message["content"] = $parsemarkdown->markdown_text($message["content"]);
            }
            $message["format"] = "html";

            $returnmessage[] = $message;
        }

        return [
            "result" => true,
            "content" => json_encode($returnmessage),
        ];
    }

    /**
     * Chat api function.
     *
     * @param string $message
     * @param int $courseid
     * @param null $audio
     * @return array
     * @throws Exception
     */
    public static function chat_api($message, $courseid, $audio = null, $lang = null) {
        global $CFG, $DB, $USER, $SITE;

        if (isset($_SESSION["messages-v3-{$courseid}"][0])) {
            $messages = $_SESSION["messages-v3-{$courseid}"];
        } else {
            // Monta lista de módulos/sessões.
            $course = $DB->get_record("course", ["id" => $courseid], "id, fullname");
            $secoes = self::course_secoes($course, $USER);
            $textomodulos = "";
            foreach ($secoes as $nome => $atividades) {
                if (empty($atividades)) {
                    continue;
                }
                $textomodulos .= "* {$nome}:\n";
                foreach ($atividades as $atividade) {
                    $textomodulos .= "** {$atividade["link"]}\n";
                    if (isset($atividade["summary"][5])) {
                        $textomodulos .= "*** {$atividade["summary"]}\n";
                    }
                }
            }

            $geniainame = get_config("local_geniai", "geniainame");
            $messages = [
                [
                    "role" => "system",
                    "content" => "Você é um chatbot chamado **{$geniainame}**.
Seu papel é ser um **superprofessor do Moodle \"{$SITE->fullname}\"**,
para o curso **[**{$course->fullname}**]({$CFG->wwwroot}/course/view.php?id={$course->id})**,
sempre prestativo e dedicado e você é especialista em apoiar e explicar tudo o que envolve o aprendizado.

## Módulos do curso:
{$textomodulos}

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
                ],
            ];

            if ($courseid) {
                if ($course = $DB->get_record("course", ["id" => $courseid])) {
                    $messages[] = [
                        "role" => "system",
                        "content" => get_string(
                            "course_user",
                            "local_geniai",
                            ["course" => $course->fullname, "userfullname" => fullname($USER)]
                        ),
                    ];
                }
            } else {
                $messages[] = [
                    "role" => "system",
                    "content" => get_string("course_home", "local_geniai", ["userfullname" => fullname($USER)]),
                ];
            }
        }

        $returntranscription = false;
        if ($audio) {
            $transcription = self::transcriptions_base64($audio, $lang);
            $returntranscription = $message = $transcription["text"];

            $audiolink = "<audio controls autoplay " .
                "src='{$CFG->wwwroot}/local/geniai/load-audio-temp.php?filename={$transcription["filename"]}'>" .
                "</audio><div class='transcription'>{$message}</div>";

            $messages[] = [
                "role" => "user",
                "content" => $audiolink,
            ];
        } else {
            $messages[] = [
                "role" => "user",
                "content" => strip_tags(trim($message)),
            ];
        }

        if (count($messages) > 10) {
            unset($messages[4]);
            unset($messages[3]);
            $messages = array_values($messages);
        }

        $gpt = self::chat_completions($messages);
        if (isset($gpt["error"])) {
            $parsemarkdown = new parse_markdown();
            $content = $parsemarkdown->markdown_text($gpt["error"]["message"]);

            return [
                "result" => false,
                "format" => "text",
                "content" => $content,
                "transcription" => $returntranscription,
            ];
        }

        if (isset($gpt["choices"][0]["message"]["content"])) {
            $content = $gpt["choices"][0]["message"]["content"];

            $messages[] = [
                "role" => "system",
                "content" => $content,
            ];

            $parsemarkdown = new parse_markdown();
            $content = $parsemarkdown->markdown_text($content);

            $_SESSION["messages-v3-{$courseid}"] = $messages;

            $format = "html";
            return [
                "result" => true,
                "format" => $format,
                "content" => $content,
                "transcription" => $returntranscription,
            ];
        }

        return [
            "result" => false,
            "format" => "text",
            "content" => "Error...",
        ];
    }

    /**
     * course_secoes
     *
     * @param $course
     * @param object $user
     * @return array
     * @throws Exception
     */
    private static function course_secoes($course, $user) { // phpcs:disable moodle.Commenting.InlineComment.TypeHintingForeach
        $secoes = [];
        $modinfo = get_fast_modinfo($course->id, $user->id);
        /** @var stdClass $sectioninfo */
        foreach ($modinfo->get_section_info_all() as $sectionnum => $sectioninfo) {
            if (empty($modinfo->sections[$sectionnum])) {
                continue;
            }

            $sectionname = get_section_name($course->id, $sectioninfo);
            $secoes[$sectionname] = [];

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
                $secoes[$sectionname][] = [
                    "link" => "[{$cm->name}]($url)",
                    "summary" => $summary,
                ];
            }
        }

        return $secoes;
    }

    /**
     * Chat completions function.
     *
     * @param array $messages
     * @param bool $ignoremaxtoken
     * @param string $replacemodel
     * @return mixed
     * @throws dml_exception
     */
    public static function chat_completions($messages, $ignoremaxtoken = false, $replacemodel = "") {
        global $DB;

        $apikey = get_config("local_geniai", "apikey");
        $model = get_config("local_geniai", "model");
        $maxtokens = get_config("local_geniai", "max_tokens");
        $frequencypenalty = get_config("local_geniai", "frequency_penalty");
        $presencepenalty = get_config("local_geniai", "presence_penalty");

        if (isset($replacemodel[3])) {
            $model = $replacemodel;
        }

        switch (get_config("local_geniai", "case")) {
            case "creative":
                $temperature = .7;
                $topp = .8;
                break;
            case "balanced":
                $temperature = .5;
                $topp = .7;
                break;
            case "precise":
                $temperature = .0;
                $topp = 1.0;
                break;
            case "exploration":
                $temperature = .8;
                $topp = .9;
                break;
            case "formal":
                $temperature = .3;
                $topp = .6;
                break;
            case "informal":
                $temperature = .7;
                $topp = .8;
                break;
            case "chatbot":
                $temperature = .2;
                $topp = .8;
                break;
            default:
                $temperature = .5;
                $topp = .5;
        }

        $messagesok = [];
        foreach ($messages as $message) {
            $message["content"] = strip_tags($message["content"]);
            $messagesok[] = $message;
        }

        $post = (object)[
            "model" => $model,
            "messages" => $messagesok,
            "temperature" => $temperature,
            "top_p" => $topp,
            "frequency_penalty" => floatval($frequencypenalty),
            "presence_penalty" => floatval($presencepenalty),
        ];

        if (!$ignoremaxtoken) {
            $post->max_tokens = intval($maxtokens);
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.openai.com/v1/chat/completions");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post));

        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Content-Type: application/json",
            "Authorization: Bearer {$apikey}",
        ]);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            return [
                "error" => [
                    "message" => "http error: " . curl_error($ch),
                ],
            ];
        }
        curl_close($ch);

        $gpt = json_decode($result, true);

        $usage = (object)[
            "send" => json_encode($post, JSON_PRETTY_PRINT),
            "receive" => $result,
            "model" => $model,
            "prompt_tokens" => intval($gpt["usage"]["prompt_tokens"]),
            "completion_tokens" => intval($gpt["usage"]["completion_tokens"]),
            "timecreated" => time(),
            "datecreated" => date("Y-m-d", time()),
        ];
        try {
            $DB->insert_record("local_geniai_usage", $usage);
        } catch (dml_exception $e) {
            echo $e->getMessage();
        }

        return $gpt;
    }

    /**
     * Function transcriptions
     *
     * @param string $audio
     * @return array
     * @throws dml_exception
     */
    private static function transcriptions_base64($audio, $lang) {
        global $CFG;

        $audio = str_replace("data:audio/mp3;base64,", "", $audio);
        $audiodata = base64_decode($audio);
        $filename = uniqid();
        $filepath = "{$CFG->dataroot}/temp/{$filename}.mp3";
        file_put_contents($filepath, $audiodata);

        return self::transcriptions($filepath, $lang);
    }

    /**
     * transcriptions
     *
     * @param string $filepath
     * @param string $lang
     * @return array
     * @throws dml_exception
     */
    public static function transcriptions($filepath, $lang) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.openai.com/v1/audio/transcriptions");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, [
            "file" => curl_file_create($filepath),
            "model" => "whisper-1",
            "response_format" => "verbose_json",
            "language" => $lang,
        ]);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Content-Type: multipart/form-data",
            "Authorization: Bearer " . get_config("local_geniai", "apikey"),
        ]);

        $result = curl_exec($ch);
        curl_close($ch);

        $result = json_decode($result);

        return [
            "text" => $result->text,
            "language" => $result->language,
        ];
    }
}
