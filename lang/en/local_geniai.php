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
$string['modulename'] = 'ChatGPT Assistant';
$string['pluginname'] = 'ChatGPT Assistant';
$string['geniai:view'] = 'View ChatGPT Assistant';
$string['geniai:manage'] = 'Manage ChatGPT Assistant';
$string['settings'] = 'Configure ChatGPT Assistant';

$string['apikey'] = 'OpenAI API Key';
$string['apikeydesc'] = 'The API key from your OpenAI account';
$string['model'] = 'API Model';
$string['modeldesc'] = 'The API model that will run on OpenAI. Available values can be found on the <a href="https://platform.openai.com/docs/models/overview" target="_blank">OpenAI website</a><br>
* <strong>gpt-3.5-turbo</strong>: It is very good, has great cost-effectiveness, and responds very quickly.<br>
* <strong>gpt-4</strong>: It is much more powerful, a bit more expensive, and takes a little longer to respond. You also need to make an <a href="https://help.openai.com/en/articles/7102672-how-can-i-access-gpt-4" target="_blank">initial payment of $1</a> to test it.';
$string['model_default'] = 'You are a chatbot, your name is GeniAI, and you are female. 
You are a super helpful Moodle teacher who only responds in {user-lang} and adds emojis to responses when possible. 
You love responding about Moodle with inspiring messages, full of details, and are very attentive to details.';
$string['prompt'] = 'Initial Prompt';
$string['promptdesc'] = 'The prompt that the AI will receive before starting the conversation';
$string['temperature'] = 'Response Temperature';
$string['temperaturedesc'] = 'Temperatures in GPT serve as a control mechanism. Higher temperatures introduce randomness, which is beneficial for creative tasks. In contrast, a temperature of zero ensures consistent responses, making GPT a reliable tool for obtaining consistent results without variation.';
$string['top_p'] = 'Top_p';
$string['top_pdesc'] = 'Top_p sampling is an alternative to temperature sampling. Instead of considering all possible tokens, GPT considers only a subset of tokens whose cumulative probability mass reaches a certain threshold (top_p). For example, if top_p is set to 0.1, GPT will consider only the tokens that make up the top 10% of the probability mass for the next token. This allows dynamic vocabulary selection based on context.<br>
See the following table that shows how to use Temperature and Top_p:<br>
<table class="table table-bordered">
<thead>
<tr>
    <th>Use Case</th>
    <th>Temperature</th>
    <th>Top_p</th>
    <th>Description</th>
</tr>
</thead>
<tbody>
<tr>
    <td>Text and Code Generation</td>
    <td class="text-center">0.2</td>
    <td class="text-center">0.1</td>
    <td>The output is more deterministic and focused. Useful for generating syntactically correct texts or codes.</td>
</tr>
<tr>
    <td>Creative Writing</td>
    <td class="text-center">0.7</td>
    <td class="text-center">0.8</td>
    <td>Generates creative and diverse text for storytelling.</td>
</tr>
<tr>
    <td>Chatbot</td>
    <td class="text-center">0.5</td>
    <td class="text-center">0.5</td>
    <td>Generates conversational responses balancing coherence and diversity. The output is more natural and engaging.</td>
</tr>
<tr>
    <td>Text Comments Generation</td>
    <td class="text-center">0.3</td>
    <td class="text-center">0.2</td>
    <td>Generates text comments more likely to be concise and relevant. The output is more deterministic and adheres to conventions.</td>
</tr>
<tr>
    <td>Data Analysis Script</td>
    <td class="text-center">0.2</td>
    <td class="text-center">0.1</td>
    <td>Generates data analysis scripts more likely to be correct and efficient. The output is more deterministic and focused.</td>
</tr>
<tr>
    <td>Exploratory Text Writing</td>
    <td class="text-center">0.6</td>
    <td class="text-center">0.7</td>
    <td>Generates texts exploring alternative solutions and creative approaches. The output is less restricted by established patterns.</td>
</tr>
</tbody>
</table>';
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
$string['message_02_home'] = 'I am GeniAI, and I am here to make your learning journey as amazing as possible.
How can I help you today? 🌟📚';
$string['message_02_course'] = 'Welcome to the {$a->coursename} course on Moodle {$a->moodlename}!
I am GeniAI, and I am here to make your learning journey as amazing as possible.
How can I help you today? 🌟📚';

$string['url_moodle'] = 'The Moodle URL is "{$a->wwwroot}" and the Moodle name is "{$a->fullname}"';
$string['course_user'] = 'The student is in the "{$a->course}" course, and the student\'s name is "{$a->userfullname}"';
$string['course_home'] = 'The student is outside of any course, and the student\'s name is "{$a->userfullname}".';

$string['report_title'] = 'Informe';
$string['report_filename'] = 'GPT Assistance Usage Report';
$string['report_info'] = 'In the report below, only the first 100 lines are shown. To get all records, please download the full report!';
$string['report_prompt_tokens'] = 'Number of Sent Prompts';
$string['report_completion_tokens'] = 'Number of Received Prompts';
$string['report_datecreated'] = 'Day';

