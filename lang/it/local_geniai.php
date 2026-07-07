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
 * lang it file.
 *
 * @package   local_geniai
 * @copyright 2024 Eduardo Kraus {@link https://eduardokraus.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

$string['agentphoto'] = 'Foto dell\'agente IA';
$string['agentphoto_desc'] = 'Immagine mostrata come avatar dell\'agente IA durante le conversazioni in chat.';
$string['analysis_ai_block'] = 'Analisi IA';
$string['analysis_bloom_analyze'] = 'Analizza';
$string['analysis_bloom_apply'] = 'Applica';
$string['analysis_bloom_create'] = 'Crea';
$string['analysis_bloom_evaluate'] = 'Valuta';
$string['analysis_bloom_remember'] = 'Ricorda';
$string['analysis_bloom_understand'] = 'Comprendi';
$string['analysis_cached'] = 'Analisi in cache';
$string['analysis_close'] = 'Chiudi';
$string['analysis_error'] = 'Non è stato possibile analizzare questa attività.';
$string['analysis_force_new'] = 'Esegui una nuova analisi';
$string['analysis_history'] = 'Cronologia analisi';
$string['analysis_last'] = 'Ultima analisi';
$string['analysis_latest'] = 'Analisi più recente';
$string['analysis_model_warning'] = 'Questa analisi ha usato un modello mini/nano. Per un\'analisi migliore, configura <a href="{$a}/admin/settings.php?section=local_geniai" target="_blank">il modello API</a> senza mini o nano.';
$string['analysis_no_content'] = 'Non è stato restituito alcun contenuto di analisi.';
$string['analysis_print'] = 'Stampa';
$string['analysis_print_analysis'] = 'Stampa analisi';
$string['analysis_print_popup_blocked'] = 'Il browser ha bloccato la scheda di stampa. Consenti i pop-up e riprova.';
$string['analysis_reanalyze'] = 'Analizza di nuovo';
$string['analysis_recommendations'] = 'Raccomandazioni';
$string['analysis_result'] = 'Analisi dell\'attività';
$string['analysis_status_insufficient'] = 'Insufficiente';
$string['analysis_status_needs_review'] = 'Richiede revisione';
$string['analysis_status_ok'] = 'OK';
$string['analysis_status_ok_minor'] = 'OK con piccoli aggiustamenti';
$string['analyze_activity'] = 'Analizza con IA';
$string['analyze_course'] = 'Analizza corso con IA';
$string['analyzing_activity'] = 'Analisi di ortografia, coerenza pedagogica e tassonomia di Bloom...';
$string['analyzing_course'] = 'Analisi delle attività del corso...';
$string['apikey'] = 'OpenAI API Key';
$string['apikey_desc'] = 'La chiave API del tuo account OpenAI';
$string['case'] = 'Casi d\'uso';
$string['caseuse_balanced'] = 'Risposte equilibrate => Temperature 0.5 - 0.7, Top_p 0.7';
$string['caseuse_chatbot'] = 'Chatbot => Temperature 0.2 - 0.6, Top_p 0.8';
$string['caseuse_creative'] = 'Generazione creativa => Temperature 0.7 - 1.0, Top_p 0.8';
$string['caseuse_exploration'] = 'Esplorazione di opzioni => Temperature 0.8 - 1.0, Top_p 0.9';
$string['caseuse_formal'] = 'Tono formale => Temperature 0.3 - 0.5, Top_p 0.6';
$string['caseuse_informal'] = 'Tono informale => Temperature 0.7 - 0.9, Top_p 0.8';
$string['caseuse_precise'] = 'Risposte precise => Temperature 0.0 - 0.3, Top_p 1.0';
$string['clear_history_title'] = 'Cancella tutta la cronologia';
$string['close_title'] = 'Chiudi chat';
$string['frequency_penalty'] = 'Penalità di frequenza';
$string['frequency_penalty_desc'] = 'Questo parametro viene usato per scoraggiare il modello dal ripetere troppo spesso le stesse parole o frasi nel testo generato. È un valore aggiunto alla probabilità logaritmica di un token ogni volta che compare nel testo. Una penalità più alta rende il modello più prudente nell\'uso di token ripetuti.';
$string['geniai:analyzeactivity'] = 'Analizzare attività Moodle con GeniAI';
$string['geniai:manage'] = 'Gestisci GeniAI';
$string['geniai:view'] = 'Visualizza GeniAI';
$string['geniainame'] = 'Nome dell\'assistente';
$string['geniainame_desc'] = 'Definisci il nome del tuo assistente';
$string['h5p-accordion-desc'] = 'Crea Glossario dal tuo contenuto per aiutare gli studenti a imparare in modo più interattivo, chiaro e coinvolgente.';
$string['h5p-accordion-title'] = 'Glossario';
$string['h5p-advancedtext-desc'] = 'Crea Libro digitale dal tuo contenuto per aiutare gli studenti a imparare in modo più interattivo, chiaro e coinvolgente.';
$string['h5p-advancedtext-title'] = 'Libro digitale';
$string['h5p-block-title'] = 'Titolo del blocco';
$string['h5p-create'] = 'Crea H5P con GeniAI';
$string['h5p-create-new'] = 'Crea nuovo H5P con GeniAI';
$string['h5p-create-this'] = 'Crea con questa risorsa';
$string['h5p-create-title'] = 'Titolo H5P';
$string['h5p-create-title-desc'] = 'Definisci il titolo principale del contenuto H5P da mostrare agli utenti nell\'interfaccia.';
$string['h5p-createpage-title'] = 'Crea nuovo {$a}';
$string['h5p-crossword-desc'] = 'Crea Cruciverba dal tuo contenuto per aiutare gli studenti a imparare in modo più interattivo, chiaro e coinvolgente.';
$string['h5p-crossword-title'] = 'Cruciverba';
$string['h5p-delete-success'] = 'H5P eliminato con successo!';
$string['h5p-dialogcards-desc'] = 'Crea Flashcard dal tuo contenuto per aiutare gli studenti a imparare in modo più interattivo, chiaro e coinvolgente.';
$string['h5p-dialogcards-title'] = 'Flashcard';
$string['h5p-dragtext-desc'] = 'Crea Gioco trascina le parole dal tuo contenuto per aiutare gli studenti a imparare in modo più interattivo, chiaro e coinvolgente.';
$string['h5p-dragtext-title'] = 'Gioco trascina le parole';
$string['h5p-example'] = 'Vedi esempio';
$string['h5p-findthewords-desc'] = 'Crea Trova le parole dal tuo contenuto per aiutare gli studenti a imparare in modo più interattivo, chiaro e coinvolgente.';
$string['h5p-findthewords-title'] = 'Trova le parole';
$string['h5p-interactivebook-desc'] = 'Crea Libro interattivo dal tuo contenuto per aiutare gli studenti a imparare in modo più interattivo, chiaro e coinvolgente.';
$string['h5p-interactivebook-title'] = 'Libro interattivo';
$string['h5p-interactivevideo-desc'] = 'Crea Video interattivo dal tuo contenuto per aiutare gli studenti a imparare in modo più interattivo, chiaro e coinvolgente.';
$string['h5p-interactivevideo-title'] = 'Video interattivo';
$string['h5p-manager'] = 'Gestisci H5P con GeniAI';
$string['h5p-manager-scorm'] = 'Gestisci SCORM con GeniAI';
$string['h5p-next-step'] = 'Passo successivo';
$string['h5p-no-apikey'] = '<p>È necessario configurare la chiave API di ChatGPT affinché il sistema di creazione dell\'account funzioni correttamente. Questo consentirà al sistema di comunicare con ChatGPT per eseguire le operazioni richieste durante la creazione dell\'account.<p><p><a href="{$a}">Fai clic qui per configurare la chiave API di ChatGPT.</a></p>';
$string['h5p-page-title'] = 'Crea un H5P con GeniAI';
$string['h5p-questionset-desc'] = 'Crea Quiz dal tuo contenuto per aiutare gli studenti a imparare in modo più interattivo, chiaro e coinvolgente.';
$string['h5p-questionset-title'] = 'Quiz';
$string['h5p-readmore'] = '...altro';
$string['h5p-return'] = 'Torna al Content Bank';
$string['h5p-title'] = 'Gestisci Content Bank di GeniAI';
$string['message_01'] = 'Ciao, {$a}! 🌟';
$string['message_02'] = 'Benvenuto nel corso {$a->coursename} su Moodle {$a->moodlename}!
Sono {$a->geniainame} e sono qui per rendere il tuo percorso di apprendimento il migliore possibile.
Come posso aiutarti oggi? 🌟📚';
$string['mode'] = 'Modalità d\'uso';
$string['mode_desc'] = 'Definisci quale modalità d\'uso desideri per il fumetto';
$string['mode_name_geniai'] = 'Tutor GeniAI';
$string['mode_name_none'] = 'Nessun fumetto chat';
$string['model'] = 'Il modello API';
$string['model_desc'] = 'Il modello API da eseguire in OpenAI. I valori disponibili si trovano sul <a href="https://platform.openai.com/docs/models/overview" target="_blank">sito OpenAI</a><br>
* <strong>gpt-4</strong>: molto più potente, leggermente più costoso, richiede un po\' più tempo per rispondere e necessita di un <a href="https://help.openai.com/en/articles/7102672-how-can-i-access-gpt-4" target="_blank">prepagamento di $1</a> per il test.<br>
* <strong>gpt-4o-mini</strong>: meno potente di gpt-4, ma più rapido ed economico. Non richiede prepagamento.<br>
<strong>Importante:</strong> se usi un modello ChatGPT con <strong>mini</strong> o <strong>nano</strong>, mostra un messaggio che consiglia un modello API senza mini o nano per un\'analisi migliore.';
$string['modulename'] = 'GeniAI';
$string['modules'] = 'Moduli da nascondere a {$a}';
$string['modules_desc'] = 'Questo elenco contiene i moduli che non devono essere resi disponibili agli studenti, assicurando che non vengano usati negli esercizi.';
$string['online'] = 'Online';
$string['pluginname'] = 'GeniAI';
$string['presence_penalty'] = 'Penalità di presenza';
$string['presence_penalty_desc'] = 'Questo parametro viene usato per incoraggiare il modello a includere una maggiore varietà di token nel testo generato. È un valore sottratto alla probabilità logaritmica di un token ogni volta che viene generato. Un valore più alto rende più probabile la generazione di token non ancora inclusi.';
$string['privacy:metadata'] = 'Il plugin GeniAI mantiene la cronologia temporanea della conversazione nella sessione corrente e memorizza solo metadati operativi di utilizzo, senza salvare il corpo dei messaggi o dati personali nei report locali.';
$string['prompt_activity_focus_alignment'] = 'dai priorità alla coerenza tra corso, sezione, titolo e contenuto dell\'attività.';
$string['prompt_activity_focus_bloom'] = 'dai priorità alla tassonomia di Bloom e alla profondità cognitiva della proposta.';
$string['prompt_activity_focus_full'] = 'analisi completa dell\'attività.';
$string['prompt_activity_focus_pedagogy'] = 'dai priorità all\'adeguatezza pedagogica, alle istruzioni per lo studente e alla qualità dell\'apprendimento.';
$string['prompt_activity_focus_spelling'] = 'dai priorità a ortografia, grammatica, chiarezza e tono istruttivo.';
$string['prompt_activity_schema_bloom_level'] = 'remember | understand | apply | analyze | evaluate | create';
$string['prompt_activity_schema_diagnosis'] = 'Breve riepilogo della diagnosi generale.';
$string['prompt_activity_schema_recommendation_1'] = 'Azione pratica 1.';
$string['prompt_activity_schema_recommendation_2'] = 'Azione pratica 2.';
$string['prompt_activity_schema_status'] = 'OK | OK with minor adjustments | Needs review | Inadequate or insufficient';
$string['prompt_activity_schema_status_key'] = 'ok | ok_minor | needs_review | insufficient';
$string['prompt_activity_system'] = 'Sei un esperto di instructional design, revisione dei testi e Moodle.

Il tuo compito è analizzare un\'attività esistente di un corso Moodle.
Scrivi l\'analisi Markdown visibile nella lingua Moodle corrente dell\'utente: {$a->lang}.
Mantieni i campi tecnici JSON e i valori enum esattamente in inglese.
Non inventare informazioni non presenti nel materiale inviato.
Se il contenuto è insufficiente per l\'analisi, dichiaralo chiaramente.
Non riscrivere l\'intera attività, salvo quando necessario per spiegare una specifica miglioria.
Mantieni la risposta oggettiva e utile per docente, coordinatore o instructional designer.

Criteri obbligatori:
1. Ortografia, grammatica e chiarezza testuale.
2. Coerenza tra titolo dell\'attività, sezione del corso e contenuto.
3. Tassonomia di Bloom usando esattamente un livello predominante: remember, understand, apply, analyze, evaluate, create.
4. Adeguatezza pedagogica dell\'attività.
5. Suggerimenti pratici di miglioramento.

Focus aggiuntivo: {$a->focus}

Formato richiesto in Markdown. Traduci le intestazioni visibili nella lingua richiesta quando appropriato.

Alla fine, aggiungi un blocco tecnico con JSON valido tra ```json e ```.
Questo blocco sarà usato da Moodle e non deve contenere commenti fuori dal JSON.
Campi obbligatori: status_key, status, bloom_level, diagnosis, recommendations.
Tipo di analisi richiesto: {$a->analysis}';
$string['prompt_activity_user'] = 'Analizza l\'attività Moodle qui sotto.

{$a}';
$string['prompt_chat_system'] = 'Sei un chatbot chiamato **{$a->geniainame}**.
Il tuo ruolo è agire come un **super docente Moodle per "{$a->sitename}"**, nel corso **[**{$a->coursename}**]({$a->courseurl})**, sempre utile e dedicato. Sei esperto nel supportare e spiegare tutto ciò che riguarda l\'apprendimento.

## Moduli del corso:
{$a->modules}

### Le tue risposte devono sempre seguire queste linee guida:
* Sii **dettagliato, chiaro e ispirante**, con un tono **amichevole e motivante**.
* Fornisci esempi pratici e spiegazioni passo passo quando è utile.
* Se la domanda è ambigua, chiedi maggiori dettagli.
* Se non conosci la risposta, dillo. Non inventare informazioni.
* Mantieni il focus sul corso **{$a->coursename}**. Se l\'utente chiede qualcosa fuori dall\'ambito del corso, dì che non puoi aiutare su quell\'argomento.
* Usa **solo formattazione MARKDOWN**.
* Rispondi **sempre** in **{$a->userlang}** e mai in un\'altra lingua.

### Regole importanti:
* Non uscire mai dal ruolo di **docente Moodle**.
* Mantieni un tono caldo e da insegnante.
* Rispondi solo in MARKDOWN e nella lingua {$a->userlang}.';
$string['prompt_json_block_instruction'] = '

Restituisci anche un blocco tecnico finale con JSON valido tra ```json e ```.';
$string['prompt_json_block_schema'] = '
Usa questo formato di riferimento:
{$a}';
$string['prompt_json_style'] = '
Stile:
- Evita gli elenchi; usali solo quando sono essenziali;
- Usa `:` solo quando è davvero necessario; preferisci riscrivere con frasi complete;
- Non aggiungere una conclusione o sintesi finale. Non terminare con formule come `Finally`, `In the end`, `In summary`, `Overall`, `In conclusion` o equivalenti;
- Fai attenzione a non sembrare un testo generato da IA o a mostrare caratteristiche tipiche dell\'IA.';
$string['report_completion_tokens'] = 'Numero di token ricevuti';
$string['report_datecreated'] = 'Giorno';
$string['report_download'] = 'Scarica utilizzo GPT';
$string['report_filename'] = 'Report di utilizzo dell\'assistenza GPT';
$string['report_info'] = '<p>Nel report presentato sono disponibili solo le prime 100 righe. Per accedere a tutti i record, scarica il documento completo.</p><p>Per quanto riguarda i token, una regola generale è che un token corrisponde a circa 4 caratteri di testo inglese comune. Ciò equivale a circa ¾ di parola, quindi 100 token ~= 75 parole. Scopri di più nella pagina <a href="https://platform.openai.com/tokenizer" target="_blank">Language Model Tokenization</a>.</p>';
$string['report_list'] = 'Elenca audio';
$string['report_model'] = 'Modello ChatGPT';
$string['report_prompt_tokens'] = 'Numero di token inviati';
$string['report_title'] = 'Report';
$string['send_message'] = 'Invia messaggio';
$string['settings'] = 'Configura GeniAI';
$string['settings_casedesc'] = 'I parametri Temperature e Top_p definiti per ogni scenario, come generazione di testo e codice, scrittura creativa, chatbot, generazione di commenti testuali, analisi dei dati e scrittura esplorativa. Ogni configurazione influisce sulla creatività e sulla coerenza nella generazione dei contenuti.<br><br>Consulta la tabella seguente come guida all\'uso di Temperature e Top_p:<br>';
$string['settings_casedesc_balancedresp'] = 'Risposte equilibrate';
$string['settings_casedesc_balancedresp_desc'] = 'Risposte equilibrate.';
$string['settings_casedesc_caseuse'] = 'Casi d\'uso';
$string['settings_casedesc_chatbot'] = 'Chatbot';
$string['settings_casedesc_chatbot_desc'] = 'Risposte rapide, coerenti e contestuali per l\'interazione in tempo reale con gli utenti.';
$string['settings_casedesc_creativegen'] = 'Generazione creativa';
$string['settings_casedesc_creativegen_desc'] = 'Produce risposte più creative, originali o esplorative. Utile per brainstorming o narrazione.';
$string['settings_casedesc_description'] = 'Descrizione';
$string['settings_casedesc_formaltones'] = 'Tono formale';
$string['settings_casedesc_formaltones_desc'] = 'Crea testi più formali o tecnici con minore variazione creativa.';
$string['settings_casedesc_optionexplore'] = 'Esplorazione di opzioni';
$string['settings_casedesc_optionexplore_desc'] = 'Genera più risposte alternative per considerare approcci diversi a una domanda.';
$string['settings_casedesc_preciseresp'] = 'Risposte precise';
$string['settings_casedesc_preciseresp_desc'] = 'Massima precisione e prevedibilità. Consigliato per attività tecniche o informative.';
$string['settings_casedesc_relaxedtones'] = 'Toni rilassati';
$string['settings_casedesc_relaxedtones_desc'] = 'Genera testi più leggeri e informali con un approccio creativo e amichevole.';
$string['settings_casedesc_temperature'] = 'Temperature';
$string['settings_casedesc_top_p'] = 'Top_p';
$string['talk_geniai'] = 'Parla con {$a} qui';
$string['write_message'] = 'Scrivi un messaggio...';
