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
 * phpcs:disable moodle.Strings.ForbiddenStrings.Found
 *
 * lang sk file.
 *
 * @package   local_geniai
 * @copyright 2024 Eduardo Kraus {@link https://eduardokraus.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

$string['agentphoto'] = 'Fotografia AI agenta';
$string['agentphoto_desc'] = 'Obrázok zobrazený ako avatar AI agenta počas chatových konverzácií.';
$string['apikey'] = 'OpenAI API Key';
$string['apikey_desc'] = 'Kľúč API vášho účtu OpenAI';
$string['case'] = 'Prípady použitia';
$string['caseuse_balanced'] = 'Vyvážené odpovede => Temperature 0.5 - 0.7, Top_p 0.7';
$string['caseuse_chatbot'] = 'Chatbot => Temperature 0.2 - 0.6, Top_p 0.8';
$string['caseuse_creative'] = 'Kreatívne generovanie => Temperature 0.7 - 1.0, Top_p 0.8';
$string['caseuse_exploration'] = 'Skúmanie možností => Temperature 0.8 - 1.0, Top_p 0.9';
$string['caseuse_formal'] = 'Formálny tón => Temperature 0.3 - 0.5, Top_p 0.6';
$string['caseuse_informal'] = 'Neformálny tón => Temperature 0.7 - 0.9, Top_p 0.8';
$string['caseuse_precise'] = 'Presné odpovede => Temperature 0.0 - 0.3, Top_p 1.0';
$string['clear_history_title'] = 'Vymazať celú históriu';
$string['close_title'] = 'Zavrieť chat';
$string['frequency_penalty'] = 'Penalizácia frekvencie';
$string['frequency_penalty_desc'] = 'Tento parameter sa používa na obmedzenie príliš častého opakovania rovnakých slov alebo fráz v generovanom texte. Vyššia hodnota robí model konzervatívnejším pri opakovaní.';
$string['geniai:manage'] = 'Spravovať GeniAI';
$string['geniai:view'] = 'Zobraziť GeniAI';
$string['geniainame'] = 'Názov asistenta';
$string['geniainame_desc'] = 'Definujte názov svojho asistenta';
$string['h5p-accordion-desc'] = 'Vytvorte Slovník zo svojho obsahu, aby sa študenti učili interaktívnejšie, prehľadnejšie a pútavejšie.';
$string['h5p-accordion-title'] = 'Slovník';
$string['h5p-advancedtext-desc'] = 'Vytvorte Digitálna kniha zo svojho obsahu, aby sa študenti učili interaktívnejšie, prehľadnejšie a pútavejšie.';
$string['h5p-advancedtext-title'] = 'Digitálna kniha';
$string['h5p-block-title'] = 'Názov bloku';
$string['h5p-create'] = 'Vytvoriť H5P s GeniAI';
$string['h5p-create-new'] = 'Vytvoriť nové H5P s GeniAI';
$string['h5p-create-this'] = 'Vytvoriť s týmto zdrojom';
$string['h5p-create-title'] = 'Názov H5P';
$string['h5p-create-title-desc'] = 'Definujte hlavný názov obsahu H5P zobrazený používateľom v rozhraní.';
$string['h5p-createpage-title'] = 'Vytvoriť nový {$a}';
$string['h5p-crossword-desc'] = 'Vytvorte Krížovka zo svojho obsahu, aby sa študenti učili interaktívnejšie, prehľadnejšie a pútavejšie.';
$string['h5p-crossword-title'] = 'Krížovka';
$string['h5p-delete-success'] = 'H5P bolo úspešne odstránené!';
$string['h5p-dialogcards-desc'] = 'Vytvorte Kartičky zo svojho obsahu, aby sa študenti učili interaktívnejšie, prehľadnejšie a pútavejšie.';
$string['h5p-dialogcards-title'] = 'Kartičky';
$string['h5p-dragtext-desc'] = 'Vytvorte Hra ťahania slov zo svojho obsahu, aby sa študenti učili interaktívnejšie, prehľadnejšie a pútavejšie.';
$string['h5p-dragtext-title'] = 'Hra ťahania slov';
$string['h5p-example'] = 'Pozrieť príklad';
$string['h5p-findthewords-desc'] = 'Vytvorte Osemsmerovka zo svojho obsahu, aby sa študenti učili interaktívnejšie, prehľadnejšie a pútavejšie.';
$string['h5p-findthewords-title'] = 'Osemsmerovka';
$string['h5p-interactivebook-desc'] = 'Vytvorte Interaktívna kniha zo svojho obsahu, aby sa študenti učili interaktívnejšie, prehľadnejšie a pútavejšie.';
$string['h5p-interactivebook-title'] = 'Interaktívna kniha';
$string['h5p-interactivevideo-desc'] = 'Vytvorte Interaktívne video zo svojho obsahu, aby sa študenti učili interaktívnejšie, prehľadnejšie a pútavejšie.';
$string['h5p-interactivevideo-title'] = 'Interaktívne video';
$string['h5p-manager'] = 'Spravovať H5P s GeniAI';
$string['h5p-manager-scorm'] = 'Spravovať SCORM s GeniAI';
$string['h5p-next-step'] = 'Ďalší krok';
$string['h5p-no-apikey'] = '<p>Pre správne fungovanie systému vytvárania účtov je potrebné nastaviť kľúč API ChatGPT.<p><p><a href="{$a}">Kliknutím sem nastavíte kľúč API ChatGPT.</a></p>';
$string['h5p-page-title'] = 'Vytvoriť H5P s GeniAI';
$string['h5p-questionset-desc'] = 'Vytvorte Kvízy zo svojho obsahu, aby sa študenti učili interaktívnejšie, prehľadnejšie a pútavejšie.';
$string['h5p-questionset-title'] = 'Kvízy';
$string['h5p-readmore'] = '...viac';
$string['h5p-return'] = 'Späť do banky obsahu';
$string['h5p-title'] = 'Spravovať banku obsahu GeniAI';
$string['message_01'] = 'Ahoj, {$a}! 🌟';
$string['message_02'] = 'Vitajte v kurze {$a->coursename} v Moodle {$a->moodlename}!
Som {$a->geniainame} a som tu, aby bola vaša vzdelávacia cesta čo najlepšia.
Ako vám dnes môžem pomôcť? 🌟📚';
$string['mode'] = 'Režim používania';
$string['mode_desc'] = 'Definujte požadovaný režim používania bubliny';
$string['mode_name_geniai'] = 'GeniAI tútor';
$string['mode_name_none'] = 'Bez chatovej bubliny';
$string['model'] = 'Model API';
$string['model_desc'] = 'Model API spúšťaný v OpenAI. Dostupné hodnoty nájdete na <a href="https://platform.openai.com/docs/models/overview" target="_blank">webe OpenAI</a><br>
<strong>Dôležité:</strong> ak používate model ChatGPT s <strong>mini</strong> alebo <strong>nano</strong>, odporučte model API bez mini alebo nano pre lepšiu analýzu.';
$string['modulename'] = 'GeniAI';
$string['modules'] = 'Moduly, ktoré sa majú skryť pred {$a}';
$string['modules_desc'] = 'Tento zoznam obsahuje moduly, ktoré nemajú byť dostupné študentom, aby sa nepoužívali v cvičeniach.';
$string['online'] = 'Online';
$string['pluginname'] = 'GeniAI';
$string['presence_penalty'] = 'Penalizácia prítomnosti';
$string['presence_penalty_desc'] = 'Tento parameter podporuje väčšiu rozmanitosť tokenov v generovanom texte. Vyššia hodnota zvyšuje pravdepodobnosť použitia nových tokenov.';
$string['privacy:metadata'] = 'Plugin GeniAI uchováva dočasnú históriu konverzácie v aktuálnej relácii a ukladá iba prevádzkové metadáta používania bez ukladania tiel správ alebo osobných údajov v lokálnych prehľadoch.';
$string['prompt_chat_system'] = 'Ste chatbot s názvom **{$a->geniainame}**. Vašou úlohou je pôsobiť ako oddaný učiteľ Moodle pre kurz **[**{$a->coursename}**]({$a->courseurl})** na stránke "{$a->sitename}".

## Moduly kurzu:
{$a->modules}

Odpovedajte jasne, priateľsky a motivačne. Ak je otázka nejasná, požiadajte o podrobnosti. Ak odpoveď nepoznáte, povedzte to a nevymýšľajte informácie. Držte sa kurzu **{$a->coursename}**. Používajte iba MARKDOWN a vždy odpovedajte v jazyku **{$a->userlang}**. Neodpovedajte v inom jazyku ako {$a->userlang}.';
$string['report_completion_tokens'] = 'Počet prijatých tokenov';
$string['report_datecreated'] = 'Deň';
$string['report_download'] = 'Stiahnuť použitie GPT';
$string['report_filename'] = 'Správa o používaní asistencie GPT';
$string['report_info'] = '<p>V zobrazenom prehľade je dostupných iba prvých 100 riadkov. Pre všetky záznamy si stiahnite celý dokument.</p><p>Jeden token približne zodpovedá 4 znakom bežného anglického textu. Viac nájdete na stránke <a href="https://platform.openai.com/tokenizer" target="_blank">Language Model Tokenization</a>.</p>';
$string['report_list'] = 'Zoznam zvukov';
$string['report_model'] = 'Model ChatGPT';
$string['report_prompt_tokens'] = 'Počet odoslaných tokenov';
$string['report_title'] = 'Správa';
$string['send_message'] = 'Odoslať správu';
$string['settings'] = 'Nastaviť GeniAI';
$string['settings_casedesc'] = 'Parametre Temperature a Top_p sú definované pre rôzne scenáre, ako generovanie textu a kódu, kreatívne písanie, chatbot, textové komentáre, analýza dát a prieskumné písanie.<br><br>Nasledujúca tabuľka slúži ako pomôcka pre Temperature a Top_p:<br>';
$string['settings_casedesc_balancedresp'] = 'Vyvážené odpovede';
$string['settings_casedesc_balancedresp_desc'] = 'Vyvážené odpovede.';
$string['settings_casedesc_caseuse'] = 'Prípady použitia';
$string['settings_casedesc_chatbot'] = 'Chatbot';
$string['settings_casedesc_chatbot_desc'] = 'Rýchle, konzistentné a kontextové odpovede pre interakciu s používateľmi v reálnom čase.';
$string['settings_casedesc_creativegen'] = 'Kreatívne generovanie';
$string['settings_casedesc_creativegen_desc'] = 'Vytvára kreatívnejšie, originálnejšie alebo prieskumné odpovede. Užitočné na brainstorming alebo rozprávanie príbehov.';
$string['settings_casedesc_description'] = 'Popis';
$string['settings_casedesc_formaltones'] = 'Formálny tón';
$string['settings_casedesc_formaltones_desc'] = 'Vytvára formálnejšie alebo technické texty s menšou kreatívnou variáciou.';
$string['settings_casedesc_optionexplore'] = 'Skúmanie možností';
$string['settings_casedesc_optionexplore_desc'] = 'Generuje viac alternatívnych odpovedí na zváženie rôznych prístupov k otázke.';
$string['settings_casedesc_preciseresp'] = 'Presné odpovede';
$string['settings_casedesc_preciseresp_desc'] = 'Maximálna presnosť a predvídateľnosť. Odporúča sa pre technické alebo informačné úlohy.';
$string['settings_casedesc_relaxedtones'] = 'Uvoľnené tóny';
$string['settings_casedesc_relaxedtones_desc'] = 'Generuje ľahšie a neformálne texty s kreatívnym a priateľským prístupom.';
$string['settings_casedesc_temperature'] = 'Temperature';
$string['settings_casedesc_top_p'] = 'Top_p';
$string['talk_geniai'] = 'Rozprávajte sa s {$a} tu';
$string['write_message'] = 'Napíšte správu...';
