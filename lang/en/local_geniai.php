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
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * lang pt_br file.
 *
 * @package   local_geniai
 * @copyright 2024 Eduardo Kraus {@link http://eduardokraus.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

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
$string['course_home'] = 'The student is outside the course, and their name is "{$a->userfullname}".';
$string['course_user'] = 'The student is in the course "{$a->course}", and their name is "{$a->userfullname}".';
$string['frequency_penalty'] = 'Frequency Penalty';
$string['frequency_penalty_desc'] = 'This parameter is used to discourage the model from repeating the same words or phrases too often in the generated text. It is a value added to the log probability of a token each time it occurs in the generated text. A higher frequency penalty will make the model more conservative about using repeated tokens.';
$string['geniai:manage'] = 'Manage GeniAI Tutor';
$string['geniai:view'] = 'View GeniAI Tutor';
$string['geniainame'] = 'Assistant Name';
$string['geniainame_desc'] = 'Define the name of your assistant';
$string['h5p-accordion-desc'] = 'Create a Glossary or FAQ allowing students to quickly access answers without being overwhelmed by excessive text.';
$string['h5p-accordion-title'] = 'Glossary/FAQ';
$string['h5p-advancedText-desc'] = 'Create a digital book from your content, organizing it into chapters in a logical and engaging way to ensure cohesive and captivating material division.';
$string['h5p-advancedText-title'] = 'Digital Book';
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
$string['h5p-dialogcards-desc'] = 'Create flashcards that act as interactive exercises to help students memorize words, phrases, or key concepts from texts. On the front of each card, there’s a hint or clue, and when flipped, the student reveals the corresponding information. These cards can be used in language learning, solving math problems, or helping students memorize important facts like historical events, formulas, or names.';
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
$string['h5p-next-step'] = 'Next step';
$string['h5p-no-apikey'] = '<p>Configuring the ChatGPT API key is necessary for the account creation system to work properly. This will allow the system to communicate with ChatGPT to perform the required operations during the account creation process.<p><p><a href="{$a}">Click here to configure the ChatGPT API key.</a></p>';
$string['h5p-page-title'] = 'Create an H5P with GeniAI';
$string['h5p-questionset-desc'] = 'Create a Question Set that allows students to solve a sequence of diverse questions, including types such as multiple-choice and true/false, offering an interactive and challenging experience.';
$string['h5p-questionset-title'] = 'Quizzes';
$string['h5p-readmore'] = '...more';
$string['h5p-return'] = 'Back to Content Bank';
$string['h5p-title'] = 'Manage GeniAI Content Bank';
$string['max_tokens'] = 'Maximum words in response';
$string['max_tokens_desc'] = 'Maximum number of words that can be generated in each request.';
$string['message_01'] = 'Hello, {$a}! 🌟';
$string['message_02_course'] = 'Welcome to the course {$a->coursename} on Moodle {$a->moodlename}!
I am {$a->geniainame}, and I am here to make your learning journey as amazing as possible.
How can I assist you today? 🌟📚';
$string['message_02_geniai'] = 'Hello! I am {$a}, here to help you. If you prefer, you can send me an audio message, and I will respond in audio as well. If you prefer to write, I will reply in text. Whichever you prefer!';
$string['message_02_home'] = 'I am {$a}, and I am here to make your learning journey as amazing as possible.
How can I assist you today? 🌟📚';
$string['mode'] = 'Usage Mode';
$string['mode_desc'] = 'Define which usage mode for the balloon you desire';
$string['mode_name_assistant'] = 'Moodle Assistant';
$string['mode_name_geniai'] = 'GeniAI Tutor';
$string['mode_name_none'] = 'No chat balloon';
$string['model'] = 'The API Model';
$string['model_desc'] = 'The API model to be executed in OpenAI. Available values are on the <a href="https://platform.openai.com/docs/models/overview" target="_blank">OpenAI website</a><br>
* <strong>gpt-3.5-turbo</strong>: Very good, has excellent cost-benefit, and responds very quickly.<br>
* <strong>gpt-4</strong>: Much more powerful, slightly more expensive, takes a bit longer to respond, and requires a <a href="https://help.openai.com/en/articles/7102672-how-can-i-access-gpt-4" target="_blank">prepayment of $1</a> to test.';
$string['modulename'] = 'GeniAI Tutor';
$string['modules'] = 'Modules to hide from {$a}';
$string['modules_desc'] = 'This list contains the modules that should not be made available to students, ensuring they are not used in exercises.';
$string['online'] = 'Online';
$string['pluginname'] = 'GeniAI Tutor';
$string['presence_penalty'] = 'Presence Penalty';
$string['presence_penalty_desc'] = 'This parameter is used to encourage the model to include a variety of tokens in the generated text. It is a value subtracted from the log probability of a token each time it is generated. A higher presence penalty value will make the model more likely to generate tokens not yet included in the generated text.';
$string['privacy:metadata'] = 'The GeniAI Tutor plugin stores conversation history and transmits only the full name, course name, and URL to OpenAI, without sharing any other personal data.';
$string['report_completion_tokens'] = 'Number of Tokens received';
$string['report_datecreated'] = 'Day';
$string['report_filename'] = 'GPT Assistance Usage Report';
$string['report_info'] = '<p>In the presented report, only the first 100 lines are available. To access all records, please download the complete document.</p><p>Regarding tokens, a general rule of thumb is that one token roughly corresponds to about 4 characters of common English text. This equals approximately ¾ of a word (so, 100 tokens ~= 75 words). Learn more on the <a href="https://platform.openai.com/tokenizer" target="_blank">Language Model Tokenization</a> page.</p>';
$string['report_model'] = 'ChatGPT Model';
$string['report_prompt_tokens'] = 'Number of Tokens Sent';
$string['report_title'] = 'Report';
$string['send_message'] = 'Send Message';
$string['settings'] = 'Configure GeniAI Tutor';
$string['settings_casedesc'] = 'The temperature and Top_p parameters defined for each scenario, such as text and code generation, creative writing, chatbot, textual comments generation, data analysis, and exploratory writing. Each configuration impacts the model’s creativity and coherence in content generation.<br><br>See the table below for guidance on using Temperature and Top_p:<br>';
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
$string['talk_geniai'] = 'Talk to your GeniAI here';
$string['url_moodle'] = 'The Moodle URL is "{$a->wwwroot}" and the Moodle name is "{$a->fullname}"';
$string['voice'] = 'Voice used in the audio response';
$string['write_message'] = 'Write a message...';
