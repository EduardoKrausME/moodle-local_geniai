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

$string['modulename'] = 'Assistente ChatGPT';
$string['pluginname'] = 'Assistente ChatGPT';
$string['geniai:view'] = 'Ver Assistente ChatGPT';
$string['geniai:manage'] = 'Gerenciar Assistente ChatGPT';
$string['settings'] = 'Configurar Assistente ChatGPT';

$string['apikey'] = 'API da OpenAI';
$string['apikeydesc'] = 'A chave da API da sua conta OpenAI';
$string['model'] = 'O Modelo da API';
$string['modeldesc'] = 'O Modelo da API que será executada na OpenAI. Valores disponíveis estão no <a href="https://platform.openai.com/docs/models/overview" target="_blank">site da OpenAI</a><br>
* <strong>gpt-3.5-turbo</strong>: é muito bom, tem um custo/benefício vom e responde muito rápido.<br>
* <strong>gpt-4</strong>: é muito mais podersos, um pouco mais caro e demora um pouco mais para responder e necessíta que você faça um <a href="https://help.openai.com/en/articles/7102672-how-can-i-access-gpt-4" target="_blank">pagamento inicial de $1</a> para poder testar';
$string['model_default'] = 'Você é um chatboot e seu nome é GeniAI e você é do sexo feminino. 
Você é uma professora super prestativa do Moodle e só responde em {user-lang} e coloca emoji nas respostas quando puder. 
Você adora responder sobre o Moodle com mensagens inspiradoras, cheia de detalhes e é muito atencioso aos detalhes.';
$string['prompt'] = 'Prompt Inicial';
$string['promptdesc'] = 'O Prompt que a IA receberá antes de comecar a conversa';

$string['clear_history'] = 'Limpar';
$string['clear_history_title'] = 'Limpar todo histórico';
$string['online'] = 'Online';
$string['write_message'] = 'Escreve uma mensagem...';
$string['send_message'] = 'Enviar a mensagem';
$string['message_01'] = 'Olá, querido(a) aluno(a) {$a}! 🌟';
$string['message_02_home'] = 'Sou a GeniAI e estou aqui para tornar sua jornada de aprendizado o mais incrível possível.
Como posso ajudar você hoje? 🌟📚';
$string['message_02_course'] = 'Bem-vindo ao curso {$a->coursename} no Moodle {$a->moodlename}!
Sou a GeniAI e estou aqui para tornar sua jornada de aprendizado o mais incrível possível.
Como posso ajudar você hoje? 🌟📚';


$string['url_moodle'] = 'A URL do Moodle é "{$a->wwwroot}" e o nome do Moodle é "{$a->fullname}"';
$string['course_user'] = 'O aluno está no curso "{$a->course}" e nome do aluno é "{$a->userfullname}"';
$string['course_home'] = 'O aluno está fora do curso e nome do aluno é "{$a->userfullname}".';