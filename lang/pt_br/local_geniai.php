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

$string['modulename'] = 'Assistente ChatGPT';
$string['pluginname'] = 'Assistente ChatGPT';
$string['geniai:view'] = 'Ver Assistente ChatGPT';
$string['geniai:manage'] = 'Gerenciar Assistente ChatGPT';
$string['settings'] = 'Configurar Assistente ChatGPT';

$string['privacy:metadata'] = 'O plugin GeniAI armazena o histórico das conversas que você envia e transmitirá à OpenAI apenas o o nome completo, nome do curso e a URL, sem compartilhar qualquer outro dado pessoal seu.';

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
$string['temperature'] = 'Temperatura da resposta';
$string['temperaturedesc'] = 'As temperaturas no GPT servem como mecanismo de controle. Temperaturas mais altas introduzem aleatoriedade, o que é benéfico para tarefas criativas. Em contraste, uma temperatura zero garante respostas consistentes, tornando o GPT uma ferramenta confiável para obter resultados determinados sem variação.';
$string['top_p'] = 'Top_p';
$string['top_pdesc'] = 'Amostragem Top_p é uma alternativa à amostragem de temperatura. Em vez de considerar todos os tokens possíveis, o GPT considera apenas um subconjunto de tokens cuja massa cumulativa de probabilidade atinge um determinado limite (top_p). Por exemplo, se top_p for definido como 0,1, o GPT considerará apenas os tokens que compõem os 10% principais da massa de probabilidade para o próximo token. Isso permite a seleção dinâmica de vocabulário com base no contexto.<br>
Veja a tabela a seguir que mostra como deve usar a Temperatura e Top_p<br>
<table class="table table-bordered">
<thead>
<tr>
    <th>Caso de Uso</th>
    <th>Temperatura</th>
    <th>Top_p</th>
    <th>Descrição</th>
</tr>
</thead>
<tbody>
<tr>
    <td>Geração de textos e códigos</td>
    <td class="text-center">0.2</td>
    <td class="text-center">0.1</td>
    <td>A saída é mais determinística e focada. Útil para gerar textos ou códigos sintaticamente correto.</td>
</tr>
<tr>
    <td>Escrita Criativa</td>
    <td class="text-center">0.7</td>
    <td class="text-center">0.8</td>
    <td>Gera texto criativo e diversificado para contar histórias.</td>
</tr>
<tr>
    <td>Chatbot</td>
    <td class="text-center">0.5</td>
    <td class="text-center">0.5</td>
    <td>Gera respostas de conversação que equilibram coerência e diversidade. A saída é mais natural e envolvente.</td>
</tr>
<tr>
    <td>Geração de Comentários de textos</td>
    <td class="text-center">0.3</td>
    <td class="text-center">0.2</td>
    <td>Gera comentários de textos mais propensos a serem concisos e relevantes. A saída é mais determinística e adere a convenções.</td>
</tr>
<tr>
    <td>Script de Análise de Dados</td>
    <td class="text-center">0.2</td>
    <td class="text-center">0.1</td>
    <td>Gera scripts de análise de dados mais propensos a serem corretos e eficientes. A saída é mais determinística e focada.</td>
</tr>
<tr>
    <td>Escrita Exploratória de textos</td>
    <td class="text-center">0.6</td>
    <td class="text-center">0.7</td>
    <td>Gera textos que explora soluções alternativas e abordagens criativas. A saída é menos restrita por padrões estabelecidos.</td>
</tr>
</tbody>
</table>';
$string['max_tokens'] = 'Máximo de palavras na resposta';
$string['max_tokensdesc'] = 'Número máximo de palavras que pode ser gerado em cada solicitação.';
$string['frequency_penalty'] = 'Frequência de Penalidade';
$string['frequency_penaltydesc'] = 'Este parâmetro é utilizado para desencorajar o modelo de repetir as mesmas palavras ou frases com muita frequência dentro do texto gerado. É um valor adicionado à log-probabilidade de um token cada vez que ele ocorre no texto gerado. Um valor de frequência de penalidade mais alto fará com que o modelo seja mais conservador ao usar tokens repetidos.';
$string['presence_penalty'] = 'Penalidade de Presença';
$string['presence_penaltydesc'] = 'Este parâmetro é utilizado para incentivar o modelo a incluir uma variedade de tokens no texto gerado. É um valor subtraído da log-probabilidade de um token cada vez que é gerado. Um valor de penalidade de presença mais alto fará com que o modelo tenha mais probabilidade de gerar tokens que ainda não foram incluídos no texto gerado.';

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

$string['report_title'] = 'Relatório';
$string['report_filename'] = 'Relatório de uso do GPT Assistence';
$string['report_info'] = '<p>No relatório apresentado, somente as primeiras 100 linhas estão disponíveis. Para acessar todos os registros, por favor, realize o download completo do documento.</p><p>Quanto aos tokens, uma regra prática é que um token geralmente corresponde a aproximadamente 4 caracteres de texto comum em inglês. Isso equivale a aproximadamente ¾ de uma palavra (portanto, 100 tokens ~= 75 palavras). Saiba mais na página <a href="https://platform.openai.com/tokenizer" target="_blank">Saiba mais sobre a tokenização do modelo de linguagem</a>.</p>';
$string['report_datecreated'] = 'Dia';
$string['report_model'] = 'Modelo do ChatGPT';
$string['report_prompt_tokens'] = 'Quantidade de Tokens enviados';
$string['report_completion_tokens'] = 'Quantidade de Tokens recebidos';
