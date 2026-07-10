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
 * lang pt_br file.
 *
 * @package   local_geniai
 * @copyright 2024 Eduardo Kraus {@link https://eduardokraus.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

$string['agentphoto'] = 'AI agent photo';
$string['agentphoto_desc'] = 'Image displayed as the AI agent\'s avatar during chat conversations.';
$string['analysis_ai_block'] = 'AI analysis';
$string['analysis_bloom_analyze'] = 'Analyze';
$string['analysis_bloom_apply'] = 'Apply';
$string['analysis_bloom_create'] = 'Create';
$string['analysis_bloom_evaluate'] = 'Evaluate';
$string['analysis_bloom_remember'] = 'Remember';
$string['analysis_bloom_understand'] = 'Understand';
$string['analysis_cached'] = 'Cached analysis';
$string['analysis_close'] = 'Close';
$string['analysis_error'] = 'Could not analyze this activity.';
$string['analysis_excluded_plugins'] = 'Modules excluded from activity analysis';
$string['analysis_excluded_plugins_desc'] = 'The selected modules will not display analysis buttons and will be excluded from course analysis.';
$string['analysis_force_new'] = 'Run a new analysis';
$string['analysis_history'] = 'Analysis history';
$string['analysis_last'] = 'Last analysis';
$string['analysis_latest'] = 'Latest analysis';
$string['analysis_model_warning'] = 'This analysis used a mini/nano model. For better analysis, configure <a href="{$a}/admin/settings.php?section=local_geniai" target="_blank">The API Model</a> without mini or nano.';
$string['analysis_no_content'] = 'No analysis content was returned.';
$string['analysis_not_supported'] = 'This activity type is not available for GeniAI analysis.';
$string['analysis_print'] = 'Print';
$string['analysis_print_analysis'] = 'Print analysis';
$string['analysis_print_popup_blocked'] = 'The browser blocked the print tab. Allow pop-ups and try again.';
$string['analysis_reanalyze'] = 'Analyze again';
$string['analysis_recommendations'] = 'Recommendations';
$string['analysis_result'] = 'Activity analysis';
$string['analysis_status_insufficient'] = 'Insufficient';
$string['analysis_status_needs_review'] = 'Needs review';
$string['analysis_status_ok'] = 'OK';
$string['analysis_status_ok_minor'] = 'OK with minor adjustments';
$string['analyze_activity'] = 'Analyze with AI';
$string['analyze_course'] = 'Analyze course with AI';
$string['analyzing_activity'] = 'Analyzing spelling, pedagogical coherence and Bloom taxonomy...';
$string['analyzing_course'] = 'Analyzing course activities...';
$string['apikey'] = 'OpenAI API Key';
$string['apikey_desc'] = 'The API key of your OpenAI account';
$string['case'] = 'Use Cases';
$string['caseuse_balanced'] = 'Balanced Responses => Temperature 0.5 - 0.7, Top_p 0.7';
$string['caseuse_chatbot'] = 'Chatbot => Temperature 0.2 - 0.6, Top_p 0.8';
$string['caseuse_creative'] = 'Creative Generation => Temperature 0.7 - 1.0, Top_p 0.8';
$string['caseuse_exploration'] = 'Exploration of Options => Temperature 0.8 - 1.0, Top_p 0.9';
$string['caseuse_formal'] = 'Formal Tone => Temperature 0.3 - 0.5, Top_p 0.6';
$string['caseuse_informal'] = 'Informal Tone => Temperature 0.7 - 0.9, Top_p 0.8';
$string['caseuse_precise'] = 'Precise Responses => Temperature 0.0 - 0.3, Top_p 1.0';
$string['clear_history_title'] = 'Clear all history';
$string['close_title'] = 'Close chat';
$string['frequency_penalty'] = 'Frequency Penalty';
$string['frequency_penalty_desc'] = 'This parameter is used to discourage the model from repeating the same words or phrases too often in the generated text. It is a value added to the log probability of a token each time it occurs in the generated text. A higher frequency penalty will make the model more conservative about using repeated tokens.';
$string['geniai:analyzeactivity'] = 'Analyze Moodle activities with GeniAI';
$string['geniai:manage'] = 'Manage GeniAI';
$string['geniai:view'] = 'View GeniAI';
$string['geniainame'] = 'Assistant Name';
$string['geniainame_desc'] = 'Define the name of your assistant';
$string['h5p-accordion-desc'] = 'Create a Glossary allowing students to quickly access answers without being overwhelmed by excessive text.';
$string['h5p-accordion-title'] = 'Glossary';
$string['h5p-advancedtext-desc'] = 'Create a digital book from your content, organizing it into chapters in a logical and engaging way to ensure cohesive and captivating material division.';
$string['h5p-advancedtext-title'] = 'Digital Book';
$string['h5p-block-title'] = 'Block Title';
$string['h5p-create'] = 'Create H5P with GeniAI';
$string['h5p-create-new'] = 'Create new H5P with GeniAI';
$string['h5p-create-this'] = 'Create with this resource';
$string['h5p-create-title'] = 'H5P Title';
$string['h5p-create-title-desc'] = 'Define the main title for the H5P content to be displayed to users in the interface.';
$string['h5p-createpage-title'] = 'Create new {$a}';
$string['h5p-crossword-desc'] = 'Create an interactive crossword game to engage students, using keywords from your content to promote fun and dynamic learning.';
$string['h5p-crossword-title'] = 'Crossword Puzzle';
$string['h5p-delete-success'] = 'H5P successfully deleted!';
$string['h5p-dialogcards-desc'] = 'Create flashcards that act as interactive exercises to help students memorize words, phrases, or key concepts from texts. On the front of each card, there\'s a hint or clue, and when flipped, the student reveals the corresponding information. These cards can be used in language learning, solving math problems, or helping students memorize important facts like historical events, formulas, or names.';
$string['h5p-dialogcards-title'] = 'Flashcards';
$string['h5p-dragtext-desc'] = 'Create a Drag the Words game where the student must drag the missing part of the text to its correct place, forming a complete expression. This game can be used to assess whether the student remembers the content they read or understands what was covered. Additionally, it helps the student reflect more deeply on the text, promoting better content assimilation.';
$string['h5p-dragtext-title'] = 'Drag the Words Game';
$string['h5p-example'] = 'See example';
$string['h5p-findthewords-desc'] = 'Create a word search game where students must find and select words in a grid based on a provided list.';
$string['h5p-findthewords-title'] = 'Word Search Game';
$string['h5p-interactivebook-desc'] = 'Create an Interactive Book that combines various interactive content, such as interactive videos, glossaries, quizzes, drag-and-drop activities, crosswords, word searches, and more, organized across multiple pages. Add a summary at the end, showing the total score the student obtained throughout the book.';
$string['h5p-interactivebook-title'] = 'Interactive Book';
$string['h5p-interactivevideo-desc'] = 'Create an interactive video with chapters and a glossary highlighting key points of the content. At the end, add an interactive summary to reinforce learning and review the topics covered.';
$string['h5p-interactivevideo-title'] = 'Interactive Video';
$string['h5p-manager'] = 'Manage H5P with GeniAI';
$string['h5p-manager-scorm'] = 'Manage SCORM with GeniAI';
$string['h5p-next-step'] = 'Next step';
$string['h5p-no-apikey'] = '<p>Configuring the ChatGPT API key is necessary for the account creation system to work properly. This will allow the system to communicate with ChatGPT to perform the required operations during the account creation process.<p><p><a href="{$a}">Click here to configure the ChatGPT API key.</a></p>';
$string['h5p-page-title'] = 'Create an H5P with GeniAI';
$string['h5p-questionset-desc'] = 'Create a Question Set that allows students to solve a sequence of diverse questions, including types such as multiple-choice and true/false, offering an interactive and challenging experience.';
$string['h5p-questionset-title'] = 'Quizzes';
$string['h5p-readmore'] = '...more';
$string['h5p-return'] = 'Back to Content Bank';
$string['h5p-title'] = 'Manage GeniAI Content Bank';
$string['message_01'] = 'Hello, {$a}! 🌟';
$string['message_02'] = 'Welcome to the course {$a->coursename} on Moodle {$a->moodlename}!
I am {$a->geniainame}, and I am here to make your learning journey as amazing as possible.
How can I assist you today? 🌟📚';
$string['mode'] = 'Usage Mode';
$string['mode_desc'] = 'Define which usage mode for the balloon you desire';
$string['mode_name_geniai'] = 'GeniAI Tutor';
$string['mode_name_none'] = 'No chat balloon';
$string['model'] = 'The API Model';
$string['model_desc'] = 'The API model to be executed in OpenAI. Available values are on the <a href="https://platform.openai.com/docs/models/overview" target="_blank">OpenAI website</a><br>
* <strong>gpt-4</strong>: Much more powerful, slightly more expensive, takes a bit longer to respond, and requires a <a href="https://help.openai.com/en/articles/7102672-how-can-i-access-gpt-4" target="_blank">prepayment of $1</a> to test.<br>
* <strong>gpt-4o-mini</strong>: Less powerful than gpt-4, but faster and cheaper. No prepayment is required.<br>
<strong>Important:</strong> if you use a ChatGPT model with <strong>mini</strong> or <strong>nano</strong>, show a message recommending The API Model without mini or nano for better analysis.';
$string['modulename'] = 'GeniAI';
$string['modules'] = 'Modules to hide from {$a}';
$string['modules_desc'] = 'This list contains the modules that should not be made available to students, ensuring they are not used in exercises.';
$string['online'] = 'Online';
$string['pluginname'] = 'GeniAI';
$string['presence_penalty'] = 'Presence Penalty';
$string['presence_penalty_desc'] = 'This parameter is used to encourage the model to include a variety of tokens in the generated text. It is a value subtracted from the log probability of a token each time it is generated. A higher presence penalty value will make the model more likely to generate tokens not yet included in the generated text.';
$string['privacy:metadata'] = 'The GeniAI plugin keeps temporary conversation history in the current session and stores only operational usage metadata without saving message bodies or personal data in its local reports.';
$string['prompt_activity_focus_alignment'] = 'prioritize coherence between course, section, title, and activity content.';
$string['prompt_activity_focus_bloom'] = 'prioritize Bloom taxonomy and the cognitive depth of the proposal.';
$string['prompt_activity_focus_full'] = 'complete activity analysis.';
$string['prompt_activity_focus_pedagogy'] = 'prioritize pedagogical adequacy, student instructions, and learning quality.';
$string['prompt_activity_focus_spelling'] = 'prioritize spelling, grammar, clarity, and instructional tone.';
$string['prompt_activity_schema_bloom_level'] = 'remember | understand | apply | analyze | evaluate | create';
$string['prompt_activity_schema_diagnosis'] = 'Short summary of the general diagnosis.';
$string['prompt_activity_schema_recommendation_1'] = 'Practical action 1.';
$string['prompt_activity_schema_recommendation_2'] = 'Practical action 2.';
$string['prompt_activity_schema_status'] = 'OK | OK with minor adjustments | Needs review | Inadequate or insufficient';
$string['prompt_activity_schema_status_key'] = 'ok | ok_minor | needs_review | insufficient';
$string['prompt_activity_system'] = 'You are an expert in instructional design, text review, and Moodle.

Your task is to analyze an existing activity from a Moodle course.
Write the visible Markdown analysis in the user current Moodle language: {$a->lang}.
Keep the technical JSON fields and enum values exactly in English.
Do not invent information that is not present in the submitted material.
If the content is insufficient for analysis, say so clearly.
Do not rewrite the entire activity unless it is necessary to explain a specific improvement.
Keep the response objective and useful for a teacher, coordinator, or instructional designer.

Required analysis criteria:
1. Spelling, grammar, and textual clarity.
2. Coherence between the activity title, course section, and activity content.
3. Bloom taxonomy, using exactly one of these predominant levels: remember, understand, apply, analyze, evaluate, create.
4. Pedagogical adequacy of the activity.
5. Practical improvement suggestions.

Additional focus for this analysis: {$a->focus}

Required response format in Markdown. Translate the visible headings to the requested language when appropriate:

## General diagnosis
Say whether the activity is OK or needs adjustments.

## Spelling and clarity
Report the problems found or say that it is adequate.

## Coherence with the section
Compare title, section, and content.

## Bloom taxonomy
Indicate the predominant level and explain why.

## Recommended improvements
List practical actions without rewriting the entire activity.

## Final opinion
Use exactly one of these classifications: OK, OK with minor adjustments, Needs review, Inadequate or insufficient.

At the end of the response, add a technical block with valid JSON between ```json and ```.
This block will be used by Moodle and must not contain comments outside the JSON.
Required fields: status_key, status, bloom_level, diagnosis, recommendations.
Requested analysis type: {$a->analysis}';
$string['prompt_activity_user'] = 'Analyze the Moodle activity below.

{$a}';
$string['prompt_chat_system'] = 'You are a chatbot named **{$a->geniainame}**.
Your role is to act as a **super Moodle teacher for "{$a->sitename}"**, for the course **[**{$a->coursename}**]({$a->courseurl})**, always helpful and dedicated. You are an expert at supporting and explaining everything related to learning.

## Course modules:
{$a->modules}

### Your answers must always follow these guidelines:
* Be **detailed, clear, and inspiring**, with a **friendly and motivating** tone.
* Pay attention to details and provide **practical examples and step-by-step explanations** whenever useful.
* If the question is ambiguous, ask for more details.
* If you do not know the answer, say that you do not know. Do not invent information that was not provided to you.
* Keep the focus on the **{$a->coursename}** course. If the user asks about something outside the course scope, say that you cannot help with that topic.
* Use **MARKDOWN formatting only**.
* **ALWAYS** answer in **{$a->userlang}** and never in another language.

### Important rules:
* Never break character as a **Moodle teacher**.
* Do not use neutral-language constructions; keep a warm, teacher-like tone.
* Answer only in MARKDOWN and in the language {$a->userlang}.';
$string['prompt_json_block_instruction'] = '

Also return a final technical block with valid JSON between ```json and ```.';
$string['prompt_json_block_schema'] = '
Use this reference format:
{$a}';
$string['prompt_json_style'] = '
Style:
- Avoid lists; use them only when essential;
- Use `:` only when truly necessary; prefer rewriting with complete sentences;
- Do not add a conclusion or final synthesis. Do not end with formulas such as `Finally`, `In the end`, `In summary`, `Overall`, `In conclusion`, or equivalents;
- Be careful not to sound like AI-generated text or to show AI-like characteristics.';
$string['report_completion_tokens'] = 'Number of Tokens received';
$string['report_datecreated'] = 'Day';
$string['report_download'] = 'Download GPT usage';
$string['report_filename'] = 'GPT Assistance Usage Report';
$string['report_info'] = '<p>In the presented report, only the first 100 lines are available. To access all records, please download the complete document.</p><p>Regarding tokens, a general rule of thumb is that one token roughly corresponds to about 4 characters of common English text. This equals approximately ¾ of a word (so, 100 tokens ~= 75 words). Learn more on the <a href="https://platform.openai.com/tokenizer" target="_blank">Language Model Tokenization</a> page.</p>';
$string['report_list'] = 'List audios';
$string['report_model'] = 'ChatGPT Model';
$string['report_prompt_tokens'] = 'Number of Tokens Sent';
$string['report_title'] = 'Report';
$string['send_message'] = 'Send Message';
$string['settings'] = 'Configure GeniAI';
$string['settings_casedesc'] = 'The temperature and Top_p parameters defined for each scenario, such as text and code generation, creative writing, chatbot, textual comments generation, data analysis, and exploratory writing. Each configuration impacts the model\'s creativity and coherence in content generation.<br><br>See the table below for guidance on using Temperature and Top_p:<br>';
$string['settings_casedesc_balancedresp'] = 'Balanced Responses';
$string['settings_casedesc_balancedresp_desc'] = 'Balanced responses between accuracy and creativity. Ideal for natural and friendly conversations.';
$string['settings_casedesc_caseuse'] = 'Use Case';
$string['settings_casedesc_chatbot'] = 'Chatbot';
$string['settings_casedesc_chatbot_desc'] = 'Fast, consistent, and contextual responses for real-time interaction with users.';
$string['settings_casedesc_creativegen'] = 'Creative Generation';
$string['settings_casedesc_creativegen_desc'] = 'Produces more creative, original, or exploratory responses. Useful for brainstorming or storytelling.';
$string['settings_casedesc_description'] = 'Description';
$string['settings_casedesc_formaltones'] = 'Formal Tones';
$string['settings_casedesc_formaltones_desc'] = 'Creates more formal or technical texts with less creative variation.';
$string['settings_casedesc_optionexplore'] = 'Option Exploration';
$string['settings_casedesc_optionexplore_desc'] = 'Generates multiple alternative responses to consider different approaches to a question.';
$string['settings_casedesc_preciseresp'] = 'Precise Responses';
$string['settings_casedesc_preciseresp_desc'] = 'Maximum accuracy and predictability. Recommended for technical or informative tasks.';
$string['settings_casedesc_relaxedtones'] = 'Relaxed Tones';
$string['settings_casedesc_relaxedtones_desc'] = 'Generates lighter and informal texts with a creative and friendly approach.';
$string['settings_casedesc_temperature'] = 'Temperature';
$string['settings_casedesc_top_p'] = 'Top_p';
$string['talk_geniai'] = 'Talk to {$a} here';
$string['write_message'] = 'Write a message...';
