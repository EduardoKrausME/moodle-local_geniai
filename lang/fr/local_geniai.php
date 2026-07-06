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
 * lang fr file.
 *
 * @package   local_geniai
 * @copyright 2024 Eduardo Kraus {@link https://eduardokraus.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

$string['agentphoto'] = 'Photo de l’agent IA';
$string['agentphoto_desc'] = 'Image affichée comme avatar de l’agent IA pendant les conversations de chat.';
$string['analysis_ai_block'] = 'Analyse IA';
$string['analysis_bloom_analyze'] = 'Analyser';
$string['analysis_bloom_apply'] = 'Appliquer';
$string['analysis_bloom_create'] = 'Créer';
$string['analysis_bloom_evaluate'] = 'Évaluer';
$string['analysis_bloom_remember'] = 'Se souvenir';
$string['analysis_bloom_understand'] = 'Comprendre';
$string['analysis_cached'] = 'Analyse en cache';
$string['analysis_close'] = 'Fermer';
$string['analysis_error'] = 'Impossible d’analyser cette activité.';
$string['analysis_force_new'] = 'Lancer une nouvelle analyse';
$string['analysis_history'] = 'Historique des analyses';
$string['analysis_last'] = 'Dernière analyse';
$string['analysis_latest'] = 'Dernière analyse';
$string['analysis_model_warning'] = 'Cette analyse a utilisé un modèle mini/nano. Pour une meilleure analyse, configurez <a href="{$a}/admin/settings.php?section=local_geniai" target="_blank">le modèle de l’API</a> sans mini ni nano.';
$string['analysis_no_content'] = 'Aucun contenu d’analyse n’a été retourné.';
$string['analysis_print'] = 'Imprimer';
$string['analysis_print_analysis'] = 'Imprimer l’analyse';
$string['analysis_print_popup_blocked'] = 'Le navigateur a bloqué l’onglet d’impression. Autorisez les fenêtres contextuelles et réessayez.';
$string['analysis_reanalyze'] = 'Analyser à nouveau';
$string['analysis_recommendations'] = 'Recommandations';
$string['analysis_result'] = 'Analyse de l’activité';
$string['analysis_status_insufficient'] = 'Insuffisant';
$string['analysis_status_needs_review'] = 'À réviser';
$string['analysis_status_ok'] = 'OK';
$string['analysis_status_ok_minor'] = 'OK avec de légers ajustements';
$string['analyze_activity'] = 'Analyser avec l’IA';
$string['analyze_course'] = 'Analyser cours avec l’IA';
$string['analyzing_activity'] = 'Analyse de l’orthographe, de la cohérence pédagogique et de la taxonomie de Bloom...';
$string['analyzing_course'] = 'Analyse des activités du cours...';
$string['apikey'] = 'OpenAI API Key';
$string['apikey_desc'] = 'La clé API de votre compte OpenAI';
$string['case'] = 'Cas d’utilisation';
$string['caseuse_balanced'] = 'Réponses équilibrées => Temperature 0.5 - 0.7, Top_p 0.7';
$string['caseuse_chatbot'] = 'Chatbot => Temperature 0.2 - 0.6, Top_p 0.8';
$string['caseuse_creative'] = 'Génération créative => Temperature 0.7 - 1.0, Top_p 0.8';
$string['caseuse_exploration'] = 'Exploration d’options => Temperature 0.8 - 1.0, Top_p 0.9';
$string['caseuse_formal'] = 'Ton formel => Temperature 0.3 - 0.5, Top_p 0.6';
$string['caseuse_informal'] = 'Ton informel => Temperature 0.7 - 0.9, Top_p 0.8';
$string['caseuse_precise'] = 'Réponses précises => Temperature 0.0 - 0.3, Top_p 1.0';
$string['clear_history_title'] = 'Effacer tout l’historique';
$string['close_title'] = 'Fermer le chat';
$string['frequency_penalty'] = 'Pénalité de fréquence';
$string['frequency_penalty_desc'] = 'Ce paramètre sert à décourager le modèle de répéter trop souvent les mêmes mots ou expressions dans le texte généré. Il est ajouté à la probabilité logarithmique d’un token chaque fois qu’il apparaît. Une pénalité plus élevée rend le modèle plus prudent avec les tokens répétés.';
$string['geniai:analyzeactivity'] = 'Analyser les activités Moodle avec GeniAI';
$string['geniai:manage'] = 'Gérer GeniAI';
$string['geniai:view'] = 'Voir GeniAI';
$string['geniainame'] = 'Nom de l’assistant';
$string['geniainame_desc'] = 'Définissez le nom de votre assistant';
$string['h5p-accordion-desc'] = 'Créez Glossaire à partir de votre contenu afin d’aider les étudiants à apprendre de manière plus interactive et structurée.';
$string['h5p-accordion-title'] = 'Glossaire';
$string['h5p-advancedtext-desc'] = 'Créez Livre numérique à partir de votre contenu afin d’aider les étudiants à apprendre de manière plus interactive et structurée.';
$string['h5p-advancedtext-title'] = 'Livre numérique';
$string['h5p-block-title'] = 'Titre du bloc';
$string['h5p-create'] = 'Créer un H5P avec GeniAI';
$string['h5p-create-new'] = 'Créer un nouveau H5P avec GeniAI';
$string['h5p-create-this'] = 'Créer avec cette ressource';
$string['h5p-create-title'] = 'Titre du H5P';
$string['h5p-create-title-desc'] = 'Définissez le titre principal du contenu H5P qui sera affiché aux utilisateurs dans l’interface.';
$string['h5p-createpage-title'] = 'Créer un nouveau {$a}';
$string['h5p-crossword-desc'] = 'Créez Mots croisés à partir de votre contenu afin d’aider les étudiants à apprendre de manière plus interactive et structurée.';
$string['h5p-crossword-title'] = 'Mots croisés';
$string['h5p-delete-success'] = 'H5P supprimé avec succès !';
$string['h5p-dialogcards-desc'] = 'Créez Cartes mémoire à partir de votre contenu afin d’aider les étudiants à apprendre de manière plus interactive et structurée.';
$string['h5p-dialogcards-title'] = 'Cartes mémoire';
$string['h5p-dragtext-desc'] = 'Créez Jeu de mots à glisser à partir de votre contenu afin d’aider les étudiants à apprendre de manière plus interactive et structurée.';
$string['h5p-dragtext-title'] = 'Jeu de mots à glisser';
$string['h5p-example'] = 'Voir un exemple';
$string['h5p-findthewords-desc'] = 'Créez Mots cachés à partir de votre contenu afin d’aider les étudiants à apprendre de manière plus interactive et structurée.';
$string['h5p-findthewords-title'] = 'Mots cachés';
$string['h5p-interactivebook-desc'] = 'Créez Livre interactif à partir de votre contenu afin d’aider les étudiants à apprendre de manière plus interactive et structurée.';
$string['h5p-interactivebook-title'] = 'Livre interactif';
$string['h5p-interactivevideo-desc'] = 'Créez Vidéo interactive à partir de votre contenu afin d’aider les étudiants à apprendre de manière plus interactive et structurée.';
$string['h5p-interactivevideo-title'] = 'Vidéo interactive';
$string['h5p-manager'] = 'Gérer H5P avec GeniAI';
$string['h5p-manager-scorm'] = 'Gérer SCORM avec GeniAI';
$string['h5p-next-step'] = 'Étape suivante';
$string['h5p-no-apikey'] = '<p>La configuration de la clé API ChatGPT est nécessaire pour que le système de création de compte fonctionne correctement. Cela permettra au système de communiquer avec ChatGPT pour effectuer les opérations requises pendant le processus de création de compte.<p><p><a href="{$a}">Cliquez ici pour configurer la clé API ChatGPT.</a></p>';
$string['h5p-page-title'] = 'Créer un H5P avec GeniAI';
$string['h5p-questionset-desc'] = 'Créez Quiz à partir de votre contenu afin d’aider les étudiants à apprendre de manière plus interactive et structurée.';
$string['h5p-questionset-title'] = 'Quiz';
$string['h5p-readmore'] = '...plus';
$string['h5p-return'] = 'Retour à la banque de contenus';
$string['h5p-title'] = 'Gérer la banque de contenus GeniAI';
$string['message_01'] = 'Bonjour, {$a} ! 🌟';
$string['message_02'] = 'Bienvenue dans le cours {$a->coursename} sur Moodle {$a->moodlename} !
Je suis {$a->geniainame} et je suis là pour rendre votre parcours d’apprentissage aussi agréable que possible.
Comment puis-je vous aider aujourd’hui ? 🌟📚';
$string['mode'] = 'Mode d’utilisation';
$string['mode_desc'] = 'Définissez le mode d’utilisation souhaité pour la bulle';
$string['mode_name_geniai'] = 'Tuteur GeniAI';
$string['mode_name_none'] = 'Aucune bulle de chat';
$string['model'] = 'Le modèle de l’API';
$string['model_desc'] = 'Le modèle d’API à exécuter dans OpenAI. Les valeurs disponibles se trouvent sur le <a href="https://platform.openai.com/docs/models/overview" target="_blank">site d’OpenAI</a><br>
* <strong>gpt-4</strong> : beaucoup plus puissant, légèrement plus coûteux, répond un peu plus lentement et nécessite un <a href="https://help.openai.com/en/articles/7102672-how-can-i-access-gpt-4" target="_blank">pré-paiement de $1</a> pour tester.<br>
* <strong>gpt-4o-mini</strong> : moins puissant que gpt-4, mais plus rapide et moins cher. Aucun pré-paiement n’est requis.<br>
<strong>Important :</strong> si vous utilisez un modèle ChatGPT avec <strong>mini</strong> ou <strong>nano</strong>, affichez un message recommandant le modèle de l’API sans mini ni nano pour une meilleure analyse.';
$string['modulename'] = 'GeniAI';
$string['modules'] = 'Modules à masquer pour {$a}';
$string['modules_desc'] = 'Cette liste contient les modules qui ne doivent pas être mis à disposition des étudiants, afin qu’ils ne soient pas utilisés dans les exercices.';
$string['online'] = 'En ligne';
$string['pluginname'] = 'GeniAI';
$string['presence_penalty'] = 'Pénalité de présence';
$string['presence_penalty_desc'] = 'Ce paramètre sert à encourager le modèle à inclure une plus grande variété de tokens dans le texte généré. Il est soustrait à la probabilité logarithmique d’un token chaque fois qu’il est généré. Une valeur plus élevée rend plus probable la génération de tokens encore non utilisés.';
$string['privacy:metadata'] = 'Le plugin GeniAI conserve l’historique temporaire de conversation dans la session actuelle et stocke uniquement des métadonnées opérationnelles d’utilisation, sans enregistrer le corps des messages ni de données personnelles dans ses rapports locaux.';
$string['prompt_activity_focus_alignment'] = 'priorisez la cohérence entre le cours, la section, le titre et le contenu de l’activité.';
$string['prompt_activity_focus_bloom'] = 'priorisez la taxonomie de Bloom et la profondeur cognitive de la proposition.';
$string['prompt_activity_focus_full'] = 'analyse complète de l’activité.';
$string['prompt_activity_focus_pedagogy'] = 'priorisez l’adéquation pédagogique, les consignes aux étudiants et la qualité de l’apprentissage.';
$string['prompt_activity_focus_spelling'] = 'priorisez l’orthographe, la grammaire, la clarté et le ton pédagogique.';
$string['prompt_activity_schema_bloom_level'] = 'remember | understand | apply | analyze | evaluate | create';
$string['prompt_activity_schema_diagnosis'] = 'Résumé court du diagnostic général.';
$string['prompt_activity_schema_recommendation_1'] = 'Action pratique 1.';
$string['prompt_activity_schema_recommendation_2'] = 'Action pratique 2.';
$string['prompt_activity_schema_status'] = 'OK | OK with minor adjustments | Needs review | Inadequate or insufficient';
$string['prompt_activity_schema_status_key'] = 'ok | ok_minor | needs_review | insufficient';
$string['prompt_activity_system'] = 'Vous êtes expert en conception pédagogique, révision de texte et Moodle.

Votre tâche est d’analyser une activité existante d’un cours Moodle.
Rédigez l’analyse Markdown visible dans la langue Moodle actuelle de l’utilisateur : {$a->lang}.
Conservez les champs techniques JSON et les valeurs enum exactement en anglais.
N’inventez aucune information absente du matériel fourni.
Si le contenu est insuffisant pour l’analyse, dites-le clairement.
Ne réécrivez pas toute l’activité sauf si cela est nécessaire pour expliquer une amélioration précise.
Gardez une réponse objective et utile pour un enseignant, un coordinateur ou un concepteur pédagogique.

Critères obligatoires :
1. Orthographe, grammaire et clarté textuelle.
2. Cohérence entre le titre de l’activité, la section du cours et le contenu.
3. Taxonomie de Bloom avec exactement un niveau dominant : remember, understand, apply, analyze, evaluate, create.
4. Pertinence pédagogique de l’activité.
5. Suggestions pratiques d’amélioration.

Focus additionnel : {$a->focus}

Format de réponse requis en Markdown. Traduisez les titres visibles dans la langue demandée si nécessaire.

À la fin, ajoutez un bloc technique avec du JSON valide entre ```json et ```.
Ce bloc sera utilisé par Moodle et ne doit contenir aucun commentaire hors du JSON.
Champs requis : status_key, status, bloom_level, diagnosis, recommendations.
Type d’analyse demandé : {$a->analysis}';
$string['prompt_activity_user'] = 'Analysez l’activité Moodle ci-dessous.

{$a}';
$string['prompt_chat_system'] = 'Vous êtes un chatbot nommé **{$a->geniainame}**.
Votre rôle est d’agir comme un **super enseignant Moodle pour "{$a->sitename}"**, dans le cours **[**{$a->coursename}**]({$a->courseurl})**, toujours utile et engagé. Vous êtes spécialiste de l’accompagnement et de l’explication de tout ce qui concerne l’apprentissage.

## Modules du cours :
{$a->modules}

### Vos réponses doivent toujours suivre ces règles :
* Soyez **détaillé, clair et inspirant**, avec un ton **amical et motivant**.
* Donnez des exemples pratiques et des explications étape par étape lorsque c’est utile.
* Si la question est ambiguë, demandez plus de détails.
* Si vous ne connaissez pas la réponse, dites-le. N’inventez pas d’informations.
* Gardez le focus sur le cours **{$a->coursename}**. Si la question sort du cadre du cours, dites que vous ne pouvez pas aider sur ce sujet.
* Utilisez **uniquement le format MARKDOWN**.
* Répondez **toujours** en **{$a->userlang}** et jamais dans une autre langue.

### Règles importantes :
* Ne quittez jamais le rôle d’**enseignant Moodle**.
* Gardez un ton chaleureux de professeur.
* Répondez uniquement en MARKDOWN et dans la langue {$a->userlang}.';
$string['prompt_json_block_instruction'] = '

Retournez également un bloc technique final avec du JSON valide entre ```json et ```.';
$string['prompt_json_block_schema'] = '
Utilisez ce format de référence :
{$a}';
$string['prompt_json_style'] = '
Style :
- Évitez les listes ; utilisez-les uniquement lorsqu’elles sont essentielles ;
- Utilisez `:` seulement lorsque c’est vraiment nécessaire ; préférez reformuler avec des phrases complètes ;
- N’ajoutez pas de conclusion ni de synthèse finale. Ne terminez pas par des formules comme `Finally`, `In the end`, `In summary`, `Overall`, `In conclusion` ou équivalents ;
- Veillez à ne pas ressembler à un texte généré par IA ni à montrer des caractéristiques typiques de l’IA.';
$string['report_completion_tokens'] = 'Nombre de tokens reçus';
$string['report_datecreated'] = 'Jour';
$string['report_download'] = 'Télécharger l’utilisation de GPT';
$string['report_filename'] = 'Rapport d’utilisation de l’assistance GPT';
$string['report_info'] = '<p>Dans le rapport présenté, seules les 100 premières lignes sont disponibles. Pour accéder à tous les enregistrements, veuillez télécharger le document complet.</p><p>Concernant les tokens, une règle générale indique qu’un token correspond à environ 4 caractères de texte anglais courant. Cela équivaut à environ ¾ d’un mot, donc 100 tokens ~= 75 mots. En savoir plus sur la page <a href="https://platform.openai.com/tokenizer" target="_blank">Language Model Tokenization</a>.</p>';
$string['report_list'] = 'Lister les audios';
$string['report_model'] = 'Modèle ChatGPT';
$string['report_prompt_tokens'] = 'Nombre de tokens envoyés';
$string['report_title'] = 'Rapport';
$string['send_message'] = 'Envoyer le message';
$string['settings'] = 'Configurer GeniAI';
$string['settings_casedesc'] = 'Les paramètres Temperature et Top_p définis pour chaque scénario, comme la génération de texte et de code, l’écriture créative, le chatbot, la génération de commentaires textuels, l’analyse de données et l’écriture exploratoire. Chaque configuration influence la créativité et la cohérence de la génération de contenu.<br><br>Consultez le tableau ci-dessous pour vous guider dans l’utilisation de Temperature et Top_p :<br>';
$string['settings_casedesc_balancedresp'] = 'Réponses équilibrées';
$string['settings_casedesc_balancedresp_desc'] = 'Réponses équilibrées.';
$string['settings_casedesc_caseuse'] = 'Cas d’utilisation';
$string['settings_casedesc_chatbot'] = 'Chatbot';
$string['settings_casedesc_chatbot_desc'] = 'Réponses rapides, cohérentes et contextuelles pour une interaction en temps réel avec les utilisateurs.';
$string['settings_casedesc_creativegen'] = 'Génération créative';
$string['settings_casedesc_creativegen_desc'] = 'Produit des réponses plus créatives, originales ou exploratoires. Utile pour le brainstorming ou la narration.';
$string['settings_casedesc_description'] = 'Description';
$string['settings_casedesc_formaltones'] = 'Ton formel';
$string['settings_casedesc_formaltones_desc'] = 'Crée des textes plus formels ou techniques avec moins de variation créative.';
$string['settings_casedesc_optionexplore'] = 'Exploration d’options';
$string['settings_casedesc_optionexplore_desc'] = 'Génère plusieurs réponses alternatives afin d’envisager différentes approches d’une question.';
$string['settings_casedesc_preciseresp'] = 'Réponses précises';
$string['settings_casedesc_preciseresp_desc'] = 'Précision et prévisibilité maximales. Recommandé pour les tâches techniques ou informatives.';
$string['settings_casedesc_relaxedtones'] = 'Tons détendus';
$string['settings_casedesc_relaxedtones_desc'] = 'Génère des textes plus légers et informels avec une approche créative et conviviale.';
$string['settings_casedesc_temperature'] = 'Temperature';
$string['settings_casedesc_top_p'] = 'Top_p';
$string['talk_geniai'] = 'Parlez à {$a} ici';
$string['write_message'] = 'Écrivez un message...';
