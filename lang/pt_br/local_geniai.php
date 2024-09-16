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
 * lang pt_br file.
 *
 * @package    local_geniai
 * @copyright  2024 Eduardo Kraus {@link http://eduardokraus.com}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

$string['apikey'] = 'API da OpenAI';
$string['apikeydesc'] = 'A chave da API da sua conta OpenAI';
$string['case'] = 'Casos de uso';
$string['case_chatbot'] = 'Chatbot                              => Temperatura 0.5, Top_p 0.5';
$string['case_creative_writing'] = 'Escrita Criativa                     => Temperatura 0.7, Top_p 0.8';
$string['case_data_analysis_script'] = 'Script de Análise de Dados           => Temperatura 0.2, Top_p 0.1';
$string['case_exploratory_writing'] = 'Escrita Exploratória de textos       => Temperatura 0.6, Top_p 0.7';
$string['case_fictitious_dialogue_generation'] = 'Geração de diálogos fictícios        => Temperatura 0.9, Top_p 0.95';
$string['case_idea_brainstorming'] = 'Exploração de ideias e brainstorming => Temperatura 0.8, Top_p 0.9';
$string['case_surreal_story_generation'] = 'Histórias Surreais ou Absurdas       => Temperatura 1.0, Top_p 1.0';
$string['case_text_code_generation'] = 'Geração de textos e códigos          => Temperatura 0.1, Top_p 0.1';
$string['case_text_comment_generation'] = 'Geração de Comentários de textos     => Temperatura 0.3, Top_p 0.2';
$string['casedesc'] = 'Os parâmetros de temperatura e Top_p definidos para cada cenário, como geração de texto e código, escrita criativa, chatbot, geração de comentários textuais, análise de dados e escrita exploratória. Cada configuração afeta a criatividade e a coerência do modelo na geração de conteúdo.<br><br>Veja a tabela a seguir que mostra como usar a Temperatura e o Top_p:<br>
<table class="table table-bordered">
<thead>
<tr>
    <th>Caso de uso</th>
    <th>Temperatura</th>
    <th>Top_p</th>
    <th>Descrição do caso</th>
</tr>
</thead>
<tbody>
<tr>
    <td>Geração de textos e códigos</td>
    <td class="text-center">0.1</td>
    <td class="text-center">0.1</td>
    <td>A saída é mais determinística e focada. Útil para gerar textos ou códigos sintaticamente correto.</td>
</tr>
<tr>
    <td>Script de Análise de Dados</td>
    <td class="text-center">0.2</td>
    <td class="text-center">0.1</td>
    <td>Gera scripts de análise de dados mais propensos a serem corretos e eficientes. A saída é mais determinística e focada.</td>
</tr>
<tr>
    <td>Geração de Comentários de textos</td>
    <td class="text-center">0.3</td>
    <td class="text-center">0.2</td>
    <td>Gera comentários de textos mais propensos a serem concisos e relevantes. A saída é mais determinística e adere a convenções.</td>
</tr>
<tr>
    <td>Chatbot</td>
    <td class="text-center">0.5</td>
    <td class="text-center">0.5</td>
    <td>Gera respostas de conversação que equilibram coerência e diversidade. A saída é mais natural e envolvente.</td>
</tr>
<tr>
    <td>Escrita Exploratória de textos</td>
    <td class="text-center">0.6</td>
    <td class="text-center">0.7</td>
    <td>Gera textos que explora soluções alternativas e abordagens criativas. A saída é menos restrita por padrões estabelecidos.</td>
</tr>
<tr>
    <td>Escrita Criativa</td>
    <td class="text-center">0.7</td>
    <td class="text-center">0.8</td>
    <td>Gera texto criativo e diversificado para contar histórias.</td>
</tr>
<tr>
    <td>Exploração de ideias e brainstorming</td>
    <td class="text-center">0.8</td>
    <td class="text-center">0.9</td>
    <td>Gera ideias amplas, criativas e menos estruturadas para sessões de brainstorming.</td>
</tr>
<tr>
    <td>Geração de diálogos fictícios</td>
    <td class="text-center">0.9</td>
    <td class="text-center">0.95</td>
    <td>Cria diálogos imprevisíveis e originais com mais variação na linguagem e tom.</td>
</tr>
<tr>
    <td>Histórias Surreais ou Absurdas</td>
    <td class="text-center">1.0</td>
    <td class="text-center">1.0</td>
    <td>Gera histórias altamente criativas, abstratas e com menos preocupação com a lógica ou estrutura.</td>
</tr>
</tbody>
</table>';
$string['clear_history'] = 'Limpar';
$string['clear_history_title'] = 'Limpar todo histórico';
$string['course_home'] = 'O aluno está fora do curso e nome do aluno é "{$a->userfullname}".';
$string['course_user'] = 'O aluno está no curso "{$a->course}" e nome do aluno é "{$a->userfullname}"';
$string['frequency_penalty'] = 'Frequência de Penalidade';
$string['frequency_penaltydesc'] = 'Este parâmetro é utilizado para desencorajar o modelo de repetir as mesmas palavras ou frases com muita frequência dentro do texto gerado. É um valor adicionado à log-probabilidade de um token cada vez que ele ocorre no texto gerado. Um valor de frequência de penalidade mais alto fará com que o modelo seja mais conservador ao usar tokens repetidos.';
$string['geniai:manage'] = 'Gerenciar Assistente ChatGPT';
$string['geniai:view'] = 'Ver Assistente ChatGPT';
$string['geniainame'] = 'Nome do assistente';
$string['geniainamedesc'] = 'Defina o nome do seu assistente';
$string['max_tokens'] = 'Máximo de palavras na resposta';
$string['max_tokensdesc'] = 'Número máximo de palavras que pode ser gerado em cada solicitação.';
$string['message_01'] = 'Olá, querido(a) aluno(a) {$a}! 🌟';
$string['message_02_course'] = 'Bem-vindo ao curso {$a->coursename} no Moodle {$a->moodlename}!
Sou a {a->geniainame} e estou aqui para tornar sua jornada de aprendizado o mais incrível possível.
Como posso ajudar você hoje? 🌟📚';
$string['message_02_home'] = 'Sou a {$a} e estou aqui para tornar sua jornada de aprendizado o mais incrível possível.
Como posso ajudar você hoje? 🌟📚';
$string['model'] = 'O Modelo da API';
$string['model_default'] = 'Você é um chatboot e seu nome é {geniainame} e você é do sexo feminino.
Você é uma professora super prestativa do Moodle e só responde em {user-lang} e coloca emoji nas respostas quando puder.
Você adora responder sobre o Moodle {moodle-name} com mensagens inspiradoras, cheia de detalhes e é muito atencioso aos detalhes.';
$string['modeldesc'] = 'O Modelo da API que será executada na OpenAI. Valores disponíveis estão no <a href="https://platform.openai.com/docs/models/overview" target="_blank">site da OpenAI</a><br>
* <strong>gpt-3.5-turbo</strong>: é muito bom, tem um custo/benefício vom e responde muito rápido.<br>
* <strong>gpt-4</strong>: é muito mais podersos, um pouco mais caro e demora um pouco mais para responder e necessíta que você faça um <a href="https://help.openai.com/en/articles/7102672-how-can-i-access-gpt-4" target="_blank">pagamento inicial de $1</a> para poder testar';
$string['modulename'] = 'Assistente ChatGPT';
$string['modules'] = 'Módulos que deve ocultar o {$a}';
$string['modulesdesc'] = 'Esta lista contém os módulos que não deve disponibilizar o {$a} aos alunos, assegurando que eles não sejam utilizados em exercícios.';
$string['online'] = 'Online';
$string['pluginname'] = 'Assistente ChatGPT';
$string['presence_penalty'] = 'Penalidade de Presença';
$string['presence_penaltydesc'] = 'Este parâmetro é utilizado para incentivar o modelo a incluir uma variedade de tokens no texto gerado. É um valor subtraído da log-probabilidade de um token cada vez que é gerado. Um valor de penalidade de presença mais alto fará com que o modelo tenha mais probabilidade de gerar tokens que ainda não foram incluídos no texto gerado.';
$string['privacy:metadata'] = 'O plugin Assistente ChatGPT armazena o histórico das conversas que você envia e transmitirá à OpenAI apenas o o nome completo, nome do curso e a URL, sem compartilhar qualquer outro dado pessoal seu.';
$string['prompt'] = 'Prompt Inicial';
$string['promptdesc'] = 'O Prompt que a IA receberá antes de comecar a conversa';
$string['report_completion_tokens'] = 'Quantidade de Tokens recebidos';
$string['report_datecreated'] = 'Dia';
$string['report_filename'] = 'Relatório de uso do GPT Assistence';
$string['report_info'] = '<p>No relatório apresentado, somente as primeiras 100 linhas estão disponíveis. Para acessar todos os registros, por favor, realize o download completo do documento.</p><p>Quanto aos tokens, uma regra prática é que um token geralmente corresponde a aproximadamente 4 caracteres de texto comum em inglês. Isso equivale a aproximadamente ¾ de uma palavra (portanto, 100 tokens ~= 75 palavras). Saiba mais na página <a href="https://platform.openai.com/tokenizer" target="_blank">Saiba mais sobre a tokenização do modelo de linguagem</a>.</p>';
$string['report_model'] = 'Modelo do ChatGPT';
$string['report_prompt_tokens'] = 'Quantidade de Tokens enviados';
$string['report_title'] = 'Relatório';
$string['send_message'] = 'Enviar a mensagem';
$string['settings'] = 'Configurar Assistente ChatGPT';
$string['url_moodle'] = 'A URL do Moodle é "{$a->wwwroot}" e o nome do Moodle é "{$a->fullname}"';
$string['write_message'] = 'Escreve uma mensagem...';
