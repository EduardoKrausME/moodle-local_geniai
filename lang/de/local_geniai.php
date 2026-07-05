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
 * lang de file.
 *
 * @package   local_geniai
 * @copyright 2024 Eduardo Kraus {@link https://eduardokraus.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

$string['agentphoto'] = 'Foto des KI-Agenten';
$string['agentphoto_desc'] = 'Bild, das während der Chat-Unterhaltungen als Avatar des KI-Agenten angezeigt wird.';
$string['analysis_ai_block'] = 'KI-Analyse';
$string['analysis_bloom_analyze'] = 'Analysieren';
$string['analysis_bloom_apply'] = 'Anwenden';
$string['analysis_bloom_create'] = 'Erstellen';
$string['analysis_bloom_evaluate'] = 'Bewerten';
$string['analysis_bloom_remember'] = 'Merken';
$string['analysis_bloom_understand'] = 'Verstehen';
$string['analysis_cached'] = 'Zwischengespeicherte Analyse';
$string['analysis_close'] = 'Schließen';
$string['analysis_error'] = 'Diese Aktivität konnte nicht analysiert werden.';
$string['analysis_force_new'] = 'Neue Analyse ausführen';
$string['analysis_history'] = 'Analyseverlauf';
$string['analysis_last'] = 'Letzte Analyse';
$string['analysis_latest'] = 'Neueste Analyse';
$string['analysis_model_warning'] = 'Diese Analyse verwendete ein mini/nano-Modell. Für eine bessere Analyse konfiguriere <a href="{$a}/admin/settings.php?section=local_geniai" target="_blank">das API-Modell</a> ohne mini oder nano.';
$string['analysis_no_content'] = 'Es wurde kein Analyseinhalt zurückgegeben.';
$string['analysis_print'] = 'Drucken';
$string['analysis_print_analysis'] = 'Analyse drucken';
$string['analysis_print_popup_blocked'] = 'Der Browser hat den Druck-Tab blockiert. Erlaube Pop-ups und versuche es erneut.';
$string['analysis_reanalyze'] = 'Erneut analysieren';
$string['analysis_recommendations'] = 'Empfehlungen';
$string['analysis_result'] = 'Aktivitätsanalyse';
$string['analysis_status_insufficient'] = 'Unzureichend';
$string['analysis_status_needs_review'] = 'Überprüfung erforderlich';
$string['analysis_status_ok'] = 'OK';
$string['analysis_status_ok_minor'] = 'OK mit kleinen Anpassungen';
$string['analyze_activity'] = 'Analysieren mit KI';
$string['analyze_course'] = 'Analysieren Kurs mit KI';
$string['analyzing_activity'] = 'Rechtschreibung, pädagogische Kohärenz und Bloom-Taxonomie werden analysiert...';
$string['analyzing_course'] = 'Kursaktivitäten werden analysiert...';
$string['apikey'] = 'OpenAI API Key';
$string['apikey_desc'] = 'Der API-Schlüssel deines OpenAI-Kontos';
$string['case'] = 'Anwendungsfälle';
$string['caseuse_balanced'] = 'Ausgewogene Antworten => Temperature 0.5 - 0.7, Top_p 0.7';
$string['caseuse_chatbot'] = 'Chatbot => Temperature 0.2 - 0.6, Top_p 0.8';
$string['caseuse_creative'] = 'Kreative Generierung => Temperature 0.7 - 1.0, Top_p 0.8';
$string['caseuse_exploration'] = 'Optionen erkunden => Temperature 0.8 - 1.0, Top_p 0.9';
$string['caseuse_formal'] = 'Formeller Ton => Temperature 0.3 - 0.5, Top_p 0.6';
$string['caseuse_informal'] = 'Informeller Ton => Temperature 0.7 - 0.9, Top_p 0.8';
$string['caseuse_precise'] = 'Präzise Antworten => Temperature 0.0 - 0.3, Top_p 1.0';
$string['clear_history_title'] = 'Gesamten Verlauf löschen';
$string['close_title'] = 'Chat schließen';
$string['frequency_penalty'] = 'Frequenzstrafe';
$string['frequency_penalty_desc'] = 'Dieser Parameter soll verhindern, dass das Modell dieselben Wörter oder Phrasen im erzeugten Text zu häufig wiederholt. Er wird jedes Mal zur Log-Wahrscheinlichkeit eines Tokens addiert, wenn dieses im Text vorkommt. Eine höhere Frequenzstrafe macht das Modell vorsichtiger bei wiederholten Tokens.';
$string['geniai:analyzeactivity'] = 'Moodle-Aktivitäten mit GeniAI analysieren';
$string['geniai:manage'] = 'Verwalten GeniAI';
$string['geniai:view'] = 'Anzeigen GeniAI';
$string['geniainame'] = 'Name des Assistenten';
$string['geniainame_desc'] = 'Lege den Namen deines Assistenten fest';
$string['h5p-accordion-desc'] = 'Erstelle Glossar, um Lernende mit interaktiven Inhalten aus deinem Material zu unterstützen und das Lernen abwechslungsreicher zu gestalten.';
$string['h5p-accordion-title'] = 'Glossar';
$string['h5p-advancedtext-desc'] = 'Erstelle Digitales Buch, um Lernende mit interaktiven Inhalten aus deinem Material zu unterstützen und das Lernen abwechslungsreicher zu gestalten.';
$string['h5p-advancedtext-title'] = 'Digitales Buch';
$string['h5p-block-title'] = 'Blocktitel';
$string['h5p-create'] = 'H5P mit GeniAI erstellen';
$string['h5p-create-new'] = 'Neues H5P mit GeniAI erstellen';
$string['h5p-create-this'] = 'Mit dieser Ressource erstellen';
$string['h5p-create-title'] = 'H5P-Titel';
$string['h5p-create-title-desc'] = 'Lege den Haupttitel des H5P-Inhalts fest, der den Nutzern in der Oberfläche angezeigt wird.';
$string['h5p-createpage-title'] = 'Neues {$a} erstellen';
$string['h5p-crossword-desc'] = 'Erstelle Kreuzworträtsel, um Lernende mit interaktiven Inhalten aus deinem Material zu unterstützen und das Lernen abwechslungsreicher zu gestalten.';
$string['h5p-crossword-title'] = 'Kreuzworträtsel';
$string['h5p-delete-success'] = 'H5P wurde erfolgreich gelöscht!';
$string['h5p-dialogcards-desc'] = 'Erstelle Lernkarten, um Lernende mit interaktiven Inhalten aus deinem Material zu unterstützen und das Lernen abwechslungsreicher zu gestalten.';
$string['h5p-dialogcards-title'] = 'Lernkarten';
$string['h5p-dragtext-desc'] = 'Erstelle Wörter ziehen, um Lernende mit interaktiven Inhalten aus deinem Material zu unterstützen und das Lernen abwechslungsreicher zu gestalten.';
$string['h5p-dragtext-title'] = 'Wörter ziehen';
$string['h5p-example'] = 'Beispiel ansehen';
$string['h5p-findthewords-desc'] = 'Erstelle Wortsuche, um Lernende mit interaktiven Inhalten aus deinem Material zu unterstützen und das Lernen abwechslungsreicher zu gestalten.';
$string['h5p-findthewords-title'] = 'Wortsuche';
$string['h5p-interactivebook-desc'] = 'Erstelle Interaktives Buch, um Lernende mit interaktiven Inhalten aus deinem Material zu unterstützen und das Lernen abwechslungsreicher zu gestalten.';
$string['h5p-interactivebook-title'] = 'Interaktives Buch';
$string['h5p-interactivevideo-desc'] = 'Erstelle Interaktives Video, um Lernende mit interaktiven Inhalten aus deinem Material zu unterstützen und das Lernen abwechslungsreicher zu gestalten.';
$string['h5p-interactivevideo-title'] = 'Interaktives Video';
$string['h5p-manager'] = 'H5P mit GeniAI verwalten';
$string['h5p-manager-scorm'] = 'SCORM mit GeniAI verwalten';
$string['h5p-next-step'] = 'Nächster Schritt';
$string['h5p-no-apikey'] = '<p>Die Konfiguration des ChatGPT-API-Schlüssels ist erforderlich, damit das Kontoerstellungssystem ordnungsgemäß funktioniert. Dadurch kann das System mit ChatGPT kommunizieren und die erforderlichen Vorgänge während der Kontoerstellung ausführen.<p><p><a href="{$a}">Klicke hier, um den ChatGPT-API-Schlüssel zu konfigurieren.</a></p>';
$string['h5p-page-title'] = 'Ein H5P mit GeniAI erstellen';
$string['h5p-questionset-desc'] = 'Erstelle Quizze, um Lernende mit interaktiven Inhalten aus deinem Material zu unterstützen und das Lernen abwechslungsreicher zu gestalten.';
$string['h5p-questionset-title'] = 'Quizze';
$string['h5p-readmore'] = '...mehr';
$string['h5p-return'] = 'Zurück zur Inhaltssammlung';
$string['h5p-title'] = 'GeniAI-Inhaltssammlung verwalten';
$string['message_01'] = 'Hallo, {$a}! 🌟';
$string['message_02'] = 'Willkommen im Kurs {$a->coursename} auf Moodle {$a->moodlename}!
Ich bin {$a->geniainame} und bin hier, um deine Lernreise so großartig wie möglich zu machen.
Wie kann ich dir heute helfen? 🌟📚';
$string['mode'] = 'Nutzungsmodus';
$string['mode_desc'] = 'Lege fest, welchen Nutzungsmodus du für die Sprechblase möchtest';
$string['mode_name_geniai'] = 'GeniAI-Tutor';
$string['mode_name_none'] = 'Keine Chat-Sprechblase';
$string['model'] = 'Das API-Modell';
$string['model_desc'] = 'Das API-Modell, das in OpenAI ausgeführt wird. Verfügbare Werte findest du auf der <a href="https://platform.openai.com/docs/models/overview" target="_blank">OpenAI-Website</a><br>
* <strong>gpt-4</strong>: deutlich leistungsfähiger, etwas teurer, benötigt etwas länger für Antworten und erfordert zum Testen eine <a href="https://help.openai.com/en/articles/7102672-how-can-i-access-gpt-4" target="_blank">Vorauszahlung von $1</a>.<br>
* <strong>gpt-4o-mini</strong>: weniger leistungsfähig als gpt-4, aber schneller und günstiger. Keine Vorauszahlung erforderlich.<br>
<strong>Wichtig:</strong> Wenn du ein ChatGPT-Modell mit <strong>mini</strong> oder <strong>nano</strong> verwendest, zeige eine Empfehlung für ein API-Modell ohne mini oder nano für eine bessere Analyse an.';
$string['modulename'] = 'GeniAI';
$string['modules'] = 'Module, die vor {$a} ausgeblendet werden';
$string['modules_desc'] = 'Diese Liste enthält Module, die für Lernende nicht verfügbar sein sollen, damit sie nicht in Übungen verwendet werden.';
$string['online'] = 'Online';
$string['pluginname'] = 'GeniAI';
$string['presence_penalty'] = 'Präsenzstrafe';
$string['presence_penalty_desc'] = 'Dieser Parameter soll das Modell dazu anregen, im erzeugten Text eine größere Vielfalt an Tokens zu verwenden. Er wird jedes Mal von der Log-Wahrscheinlichkeit eines Tokens abgezogen, wenn dieses erzeugt wird. Ein höherer Wert erhöht die Wahrscheinlichkeit, dass noch nicht verwendete Tokens erzeugt werden.';
$string['privacy:metadata'] = 'Das GeniAI-Plugin behält den temporären Gesprächsverlauf in der aktuellen Sitzung und speichert nur operative Nutzungsmetadaten, ohne Nachrichteninhalte oder personenbezogene Daten in seinen lokalen Berichten zu speichern.';
$string['prompt_activity_focus_alignment'] = 'priorisiere die Kohärenz zwischen Kurs, Abschnitt, Titel und Aktivitätsinhalt.';
$string['prompt_activity_focus_bloom'] = 'priorisiere die Bloom-Taxonomie und die kognitive Tiefe des Vorschlags.';
$string['prompt_activity_focus_full'] = 'vollständige Aktivitätsanalyse.';
$string['prompt_activity_focus_pedagogy'] = 'priorisiere pädagogische Angemessenheit, Anweisungen für Lernende und Lernqualität.';
$string['prompt_activity_focus_spelling'] = 'priorisiere Rechtschreibung, Grammatik, Klarheit und didaktischen Ton.';
$string['prompt_activity_schema_bloom_level'] = 'remember | understand | apply | analyze | evaluate | create';
$string['prompt_activity_schema_diagnosis'] = 'Kurze Zusammenfassung der allgemeinen Diagnose.';
$string['prompt_activity_schema_recommendation_1'] = 'Praktische Maßnahme 1.';
$string['prompt_activity_schema_recommendation_2'] = 'Praktische Maßnahme 2.';
$string['prompt_activity_schema_status'] = 'OK | OK with minor adjustments | Needs review | Inadequate or insufficient';
$string['prompt_activity_schema_status_key'] = 'ok | ok_minor | needs_review | insufficient';
$string['prompt_activity_system'] = 'Du bist Expertin oder Experte für Instructional Design, Textprüfung und Moodle.

Deine Aufgabe ist es, eine vorhandene Aktivität aus einem Moodle-Kurs zu analysieren.
Schreibe die sichtbare Markdown-Analyse in der aktuellen Moodle-Sprache des Nutzers: {$a->lang}.
Belasse technische JSON-Felder und Enum-Werte exakt auf Englisch.
Erfinde keine Informationen, die im eingereichten Material nicht vorhanden sind.
Wenn der Inhalt für eine Analyse nicht ausreicht, sage das klar.
Schreibe nicht die gesamte Aktivität neu, außer wenn es nötig ist, um eine konkrete Verbesserung zu erklären.
Halte die Antwort objektiv und nützlich für Lehrkräfte, Koordination oder Instructional Design.

Pflichtkriterien:
1. Rechtschreibung, Grammatik und textliche Klarheit.
2. Kohärenz zwischen Aktivitätstitel, Kursabschnitt und Aktivitätsinhalt.
3. Bloom-Taxonomie mit genau einem dieser dominanten Niveaus: remember, understand, apply, analyze, evaluate, create.
4. Pädagogische Angemessenheit der Aktivität.
5. Praktische Verbesserungsvorschläge.

Zusätzlicher Fokus: {$a->focus}

Erforderliches Antwortformat in Markdown. Übersetze sichtbare Überschriften bei Bedarf in die angeforderte Sprache.

Am Ende der Antwort muss ein technischer Block mit gültigem JSON zwischen ```json und ``` stehen.
Dieser Block wird von Moodle verwendet und darf keine Kommentare außerhalb des JSON enthalten.
Pflichtfelder: status_key, status, bloom_level, diagnosis, recommendations.
Angeforderter Analysetyp: {$a->analysis}';
$string['prompt_activity_user'] = 'Analysiere die folgende Moodle-Aktivität.

{$a}';
$string['prompt_chat_system'] = 'Du bist ein Chatbot namens **{$a->geniainame}**.
Deine Aufgabe ist es, als **besonders hilfreiche Moodle-Lehrkraft für "{$a->sitename}"** im Kurs **[**{$a->coursename}**]({$a->courseurl})** zu handeln. Du unterstützt Lernende freundlich, klar und engagiert.

## Kursmodule:
{$a->modules}

### Deine Antworten müssen immer diesen Regeln folgen:
* Antworte **detailliert, klar und motivierend**.
* Gib praktische Beispiele und Schritt-für-Schritt-Erklärungen, wenn es hilfreich ist.
* Frage nach Details, wenn die Frage unklar ist.
* Wenn du die Antwort nicht kennst, sage das. Erfinde keine Informationen.
* Bleibe beim Kurs **{$a->coursename}**. Bei Themen außerhalb des Kurses sage, dass du dazu nicht helfen kannst.
* Verwende **nur MARKDOWN**.
* Antworte **immer** in **{$a->userlang}** und nie in einer anderen Sprache.

### Wichtige Regeln:
* Bleibe immer in der Rolle einer **Moodle-Lehrkraft**.
* Verwende einen warmen, lehrenden Ton.
* Antworte nur in MARKDOWN und in der Sprache {$a->userlang}.';
$string['prompt_json_block_instruction'] = '

Gib außerdem am Ende einen technischen Block mit gültigem JSON zwischen ```json und ``` zurück.';
$string['prompt_json_block_schema'] = '
Verwende dieses Referenzformat:
{$a}';
$string['prompt_json_style'] = '
Stil:
- Vermeide Listen; nutze sie nur, wenn sie wesentlich sind;
- Verwende `:` nur, wenn es wirklich notwendig ist; formuliere lieber vollständige Sätze;
- Füge keine Schlussfolgerung oder abschließende Zusammenfassung hinzu. Ende nicht mit Formeln wie `Finally`, `In the end`, `In summary`, `Overall`, `In conclusion` oder entsprechenden Übersetzungen;
- Achte darauf, nicht wie KI-generierter Text zu klingen oder KI-typische Merkmale zu zeigen.';
$string['report_completion_tokens'] = 'Anzahl empfangener Tokens';
$string['report_datecreated'] = 'Tag';
$string['report_download'] = 'GPT-Nutzung herunterladen';
$string['report_filename'] = 'Nutzungsbericht der GPT-Unterstützung';
$string['report_info'] = '<p>Im angezeigten Bericht sind nur die ersten 100 Zeilen verfügbar. Lade das vollständige Dokument herunter, um alle Einträge zu sehen.</p><p>Bei Tokens gilt als Faustregel, dass ein Token ungefähr 4 Zeichen üblichen englischen Textes entspricht. Das sind etwa ¾ eines Wortes, also 100 Tokens ~= 75 Wörter. Mehr dazu auf der Seite <a href="https://platform.openai.com/tokenizer" target="_blank">Language Model Tokenization</a>.</p>';
$string['report_list'] = 'Audios auflisten';
$string['report_model'] = 'ChatGPT-Modell';
$string['report_prompt_tokens'] = 'Anzahl gesendeter Tokens';
$string['report_title'] = 'Bericht';
$string['send_message'] = 'Nachricht senden';
$string['settings'] = 'GeniAI konfigurieren';
$string['settings_casedesc'] = 'Die Parameter Temperature und Top_p werden für verschiedene Szenarien festgelegt, etwa Text- und Codegenerierung, kreatives Schreiben, Chatbot, Textkommentare, Datenanalyse und exploratives Schreiben. Jede Einstellung beeinflusst Kreativität und Kohärenz der Inhaltsgenerierung.<br><br>Die folgende Tabelle hilft bei der Verwendung von Temperature und Top_p:<br>';
$string['settings_casedesc_balancedresp'] = 'Ausgewogene Antworten';
$string['settings_casedesc_balancedresp_desc'] = 'Ausgewogene Antworten.';
$string['settings_casedesc_caseuse'] = 'Anwendungsfälle';
$string['settings_casedesc_chatbot'] = 'Chatbot';
$string['settings_casedesc_chatbot_desc'] = 'Schnelle, konsistente und kontextbezogene Antworten für die Echtzeit-Interaktion mit Nutzern.';
$string['settings_casedesc_creativegen'] = 'Kreative Generierung';
$string['settings_casedesc_creativegen_desc'] = 'Erzeugt kreativere, originellere oder explorative Antworten. Nützlich für Brainstorming oder Storytelling.';
$string['settings_casedesc_description'] = 'Beschreibung';
$string['settings_casedesc_formaltones'] = 'Formeller Ton';
$string['settings_casedesc_formaltones_desc'] = 'Erstellt formellere oder technische Texte mit weniger kreativer Variation.';
$string['settings_casedesc_optionexplore'] = 'Optionen erkunden';
$string['settings_casedesc_optionexplore_desc'] = 'Erzeugt mehrere alternative Antworten, um verschiedene Herangehensweisen an eine Frage zu betrachten.';
$string['settings_casedesc_preciseresp'] = 'Präzise Antworten';
$string['settings_casedesc_preciseresp_desc'] = 'Maximale Genauigkeit und Vorhersagbarkeit. Empfohlen für technische oder informative Aufgaben.';
$string['settings_casedesc_relaxedtones'] = 'Lockere Töne';
$string['settings_casedesc_relaxedtones_desc'] = 'Erzeugt leichtere und informelle Texte mit kreativem und freundlichem Ansatz.';
$string['settings_casedesc_temperature'] = 'Temperature';
$string['settings_casedesc_top_p'] = 'Top_p';
$string['talk_geniai'] = 'Sprich hier mit {$a}';
$string['write_message'] = 'Schreibe eine Nachricht...';
