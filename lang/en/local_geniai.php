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
 * lang en file.
 *
 * @package    local_geniai
 * @copyright  2024 Eduardo Kraus {@link http://eduardokraus.com}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

$string['modulename'] = 'ChatGPT Assistant';
$string['pluginname'] = 'ChatGPT Assistant';
$string['geniai:view'] = 'View ChatGPT Assistant';
$string['geniai:manage'] = 'Manage ChatGPT Assistant';
$string['settings'] = 'Configure ChatGPT Assistant';

$string['privacy:metadata'] = 'The ChatGPT Assistant plugin stores the history of the conversations you send and will transmit to OpenAI only the full name, course name, and URL, without sharing any other personal data of yours.';

$string['apikey'] = 'OpenAI API Key';
$string['apikeydesc'] = 'The API key from your OpenAI account';
$string['geniainame'] = 'Assistant name';
$string['geniainamedesc'] = 'Set the name of your assistant';
$string['model'] = 'API Model';
$string['modeldesc'] = 'The API model that will run on OpenAI. Available values can be found on the <a href="https://platform.openai.com/docs/models/overview" target="_blank">OpenAI website</a><br>
* <strong>gpt-3.5-turbo</strong>: It is very good, has great cost-effectiveness, and responds very quickly.<br>
* <strong>gpt-4</strong>: It is much more powerful, a bit more expensive, and takes a little longer to respond. You also need to make an <a href="https://help.openai.com/en/articles/7102672-how-can-i-access-gpt-4" target="_blank">initial payment of $1</a> to test it.';
$string['model_default'] = 'You are a chatbot, your name is {geniainame}, and you are female.
You are a super helpful Moodle teacher who only responds in {user-lang} and adds emojis to responses when possible.
You love responding about Moodle {moodle-name} with inspiring messages, full of details, and are very attentive to details.';
$string['prompt'] = 'Initial Prompt';
$string['promptdesc'] = 'The prompt that the AI will receive before starting the conversation';

$string['case'] = 'Use Cases';
$string['casedesc'] = 'The temperature and Top_p parameters set for each scenario, such as text and code generation, creative writing, chatbot, text comment generation, data analysis, and exploratory writing. Each configuration affects the creativity and coherence of the model in content generation.<br><br>See the table below that shows how to use Temperature and Top_p:<br>
<table class="table table-bordered">
<thead>
<tr>
    <th>Use Case</th>
    <th>Temperature</th>
    <th>Top_p</th>
    <th>Case Description</th>
</tr>
</thead>
<tbody>
<tr>
    <td>Text and Code Generation</td>
    <td class="text-center">0.1</td>
    <td class="text-center">0.1</td>
    <td>The output is more deterministic and focused. Useful for generating syntactically correct text or code.</td>
</tr>
<tr>
    <td>Data Analysis Script</td>
    <td class="text-center">0.2</td>
    <td class="text-center">0.1</td>
    <td>Generates data analysis scripts more likely to be correct and efficient. The output is more deterministic and focused.</td>
</tr>
<tr>
    <td>Text Comment Generation</td>
    <td class="text-center">0.3</td>
    <td class="text-center">0.2</td>
    <td>Generates text comments more likely to be concise and relevant. The output is more deterministic and adheres to conventions.</td>
</tr>
<tr>
    <td>Chatbot</td>
    <td class="text-center">0.5</td>
    <td class="text-center">0.5</td>
    <td>Generates conversational responses that balance coherence and diversity. The output is more natural and engaging.</td>
</tr>
<tr>
    <td>Exploratory Writing</td>
    <td class="text-center">0.6</td>
    <td class="text-center">0.7</td>
    <td>Generates texts that explore alternative solutions and creative approaches. The output is less restricted by established patterns.</td>
</tr>
<tr>
    <td>Creative Writing</td>
    <td class="text-center">0.7</td>
    <td class="text-center">0.8</td>
    <td>Generates creative and diverse text for storytelling.</td>
</tr>
<tr>
    <td>Idea Exploration and Brainstorming</td>
    <td class="text-center">0.8</td>
    <td class="text-center">0.9</td>
    <td>Generates broad, creative, and less structured ideas for brainstorming sessions.</td>
</tr>
<tr>
    <td>Fictitious Dialogue Generation</td>
    <td class="text-center">0.9</td>
    <td class="text-center">0.95</td>
    <td>Creates unpredictable and original dialogues with more variation in language and tone.</td>
</tr>
<tr>
    <td>Surreal or Absurd Stories</td>
    <td class="text-center">1.0</td>
    <td class="text-center">1.0</td>
    <td>Generates highly creative, abstract stories with less concern for logic or structure.</td>
</tr>
</tbody>
</table>';
$string['case_text_code_generation'] = 'Text and Code Generation           => Temperature 0.1, Top_p 0.1';
$string['case_data_analysis_script'] = 'Data Analysis Script               => Temperature 0.2, Top_p 0.1';
$string['case_text_comment_generation'] = 'Text Comment Generation            => Temperature 0.3, Top_p 0.2';
$string['case_chatbot'] = 'Chatbot                            => Temperature 0.5, Top_p 0.5';
$string['case_exploratory_writing'] = 'Exploratory Writing                => Temperature 0.6, Top_p 0.7';
$string['case_creative_writing'] = 'Creative Writing                   => Temperature 0.7, Top_p 0.8';
$string['case_idea_brainstorming'] = 'Idea Exploration and Brainstorming => Temperature 0.8, Top_p 0.9';
$string['case_fictitious_dialogue_generation'] = 'Fictitious Dialogue Generation     => Temperature 0.9, Top_p 0.95';
$string['case_surreal_story_generation'] = 'Surreal or Absurd Stories          => Temperature 1.0, Top_p 1.0';

$string['modules'] = 'Modules that {$a} should hide';
$string['modulesdesc'] = 'This list contains the modules that {$a} should not make available to students, ensuring that they are not used in exercises.';

$string['max_tokens'] = 'Maximum Words in Response';
$string['max_tokensdesc'] = 'Maximum number of words that can be generated in each request.';
$string['frequency_penalty'] = 'Frequency Penalty';
$string['frequency_penaltydesc'] = 'This parameter is used to discourage the model from repeating the same words or phrases too frequently within the generated text. It is a value added to the log-probability of a token each time it occurs in the generated text. A higher frequency penalty value will make the model more conservative in using repeated tokens.';
$string['presence_penalty'] = 'Presence Penalty';
$string['presence_penaltydesc'] = 'This parameter is used to encourage the model to include a variety of tokens in the generated text. It is a value subtracted from the log-probability of a token each time it is generated. A higher presence penalty value will make the model more likely to generate tokens that have not yet been included in the generated text.';


$string['clear_history'] = 'Clear';
$string['clear_history_title'] = 'Clear entire history';
$string['online'] = 'Online';
$string['write_message'] = 'Write a message...';
$string['send_message'] = 'Send Message';
$string['message_01'] = 'Hello, dear student {$a}! 🌟';
$string['message_02_home'] = 'I am {$a}, and I am here to make your learning journey as amazing as possible.
How can I help you today? 🌟📚';
$string['message_02_course'] = 'Welcome to the {$a->coursename} course on Moodle {$a->moodlename}!
I am {a->geniainame}, and I am here to make your learning journey as amazing as possible.
How can I help you today? 🌟📚';

$string['url_moodle'] = 'The Moodle URL is "{$a->wwwroot}" and the Moodle name is "{$a->fullname}"';
$string['course_user'] = 'The student is in the "{$a->course}" course, and the student\'s name is "{$a->userfullname}"';
$string['course_home'] = 'The student is outside of any course, and the student\'s name is "{$a->userfullname}".';

$string['report_title'] = 'Informe';
$string['report_filename'] = 'GPT Assistance Usage Report';
$string['report_info'] = '<p>In the presented report, only the first 100 lines are available. To access all records, please download the complete document.</p><p>Regarding tokens, a practical rule is that a token typically corresponds to about 4 characters of common English text. This translates to approximately ¾ of a word (thus, 100 tokens ~= 75 words). Learn more on the <a href="https://platform.openai.com/tokenizer" target="_blank">Model Language Tokenization page</a>.</p>';
$string['report_datecreated'] = 'Day';
$string['report_model'] = 'ChatGPT Model';
$string['report_prompt_tokens'] = 'Number of Sent Tokens';
$string['report_completion_tokens'] = 'Number of Received Tokens';

