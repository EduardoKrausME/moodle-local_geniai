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
