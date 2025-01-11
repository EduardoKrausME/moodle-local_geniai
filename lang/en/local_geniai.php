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
$string['apikey_desc'] = 'A chave da API da sua conta OpenAI';
$string['case'] = 'Casos de uso';
$string['case_chatbot'] = 'Chatbot                              => Temperatura 0.5, Top_p 0.5';
$string['case_creative_writing'] = 'Escrita Criativa                     => Temperatura 0.7, Top_p 0.8';
$string['case_data_analysis_script'] = 'Script de Análise de Dados           => Temperatura 0.2, Top_p 0.1';
$string['case_desc'] = 'Os parâmetros de temperatura e Top_p definidos para cada cenário, como geração de texto e código, escrita criativa, chatbot, geração de comentários textuais, análise de dados e escrita exploratória. Cada configuração afeta a criatividade e a coerência do modelo na geração de conteúdo.<br><br>Veja a tabela a seguir que mostra como usar a Temperatura e o Top_p:<br>
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
$string['case_exploratory_writing'] = 'Escrita Exploratória de textos       => Temperatura 0.6, Top_p 0.7';
$string['case_fictitious_dialogue_generation'] = 'Geração de diálogos fictícios        => Temperatura 0.9, Top_p 0.95';
$string['case_idea_brainstorming'] = 'Exploração de ideias e brainstorming => Temperatura 0.8, Top_p 0.9';
$string['case_surreal_story_generation'] = 'Histórias Surreais ou Absurdas       => Temperatura 1.0, Top_p 1.0';
$string['case_text_code_generation'] = 'Geração de textos e códigos          => Temperatura 0.1, Top_p 0.1';
$string['case_text_comment_generation'] = 'Geração de Comentários de textos     => Temperatura 0.3, Top_p 0.2';
$string['clear_history_title'] = 'Limpar todo histórico';
$string['close_title'] = 'Fechar chat';
$string['course_home'] = 'O aluno está fora do curso e nome do aluno é "{$a->userfullname}".';
$string['course_user'] = 'O aluno está no curso "{$a->course}" e nome do aluno é "{$a->userfullname}"';
$string['frequency_penalty'] = 'Frequência de Penalidade';
$string['frequency_penalty_desc'] = 'Este parâmetro é utilizado para desencorajar o modelo de repetir as mesmas palavras ou frases com muita frequência dentro do texto gerado. É um valor adicionado à log-probabilidade de um token cada vez que ele ocorre no texto gerado. Um valor de frequência de penalidade mais alto fará com que o modelo seja mais conservador ao usar tokens repetidos.';
$string['geniai:manage'] = 'Gerenciar Tutor GeniAI';
$string['geniai:view'] = 'Ver Tutor GeniAI';
$string['geniainame'] = 'Nome do assistente';
$string['geniainame_desc'] = 'Defina o nome do seu assistente';
$string['h5p-accordion-desc'] = 'Crie um Glossário ou FAQ que permita aos alunos acessar rapidamente as respostas, sem se perder em um excesso de texto.';
$string['h5p-accordion-title'] = 'Glossário/FAQ';
$string['h5p-advancedText-desc'] = 'Crie um livro digital a partir do seu conteúdo, organizando-o em capítulos de maneira lógica e fluida, garantindo uma divisão coesa e envolvente do material.';
$string['h5p-advancedText-title'] = 'Livro digital';
$string['h5p-block-title'] = 'Título do bloco';
$string['h5p-create'] = 'Criar H5P com o GeniAI';
$string['h5p-create-new'] = 'Criar novo H5P com o GeniAI';
$string['h5p-create-this'] = 'Criar com este recurso';
$string['h5p-create-title'] = 'Título do H5P';
$string['h5p-create-title-desc'] = 'Defina o título principal para o conteúdo H5P, que será exibido aos usuários na interface.';
$string['h5p-createpage-title'] = 'Criar novo {$a}';
$string['h5p-crossword-desc'] = 'Crie um jogo de palavras cruzadas interativo para engajar seus alunos, utilizando palavras-chave do seu conteúdo e promovendo uma aprendizagem divertida e dinâmica.';
$string['h5p-crossword-title'] = 'Jogo de Palavras Cruzadas';
$string['h5p-delete-success'] = 'H5P excluído com sucesso!';
$string['h5p-dialogcards-desc'] = 'Crie cartões de memorização que funcionam como exercícios interativos para auxiliar os alunos na fixação de palavras, expressões ou conceitos-chave de textos. Na frente de cada cartão, há uma dica ou pista, e ao virá-lo, o aluno revela a informação correspondente. Esses cartões podem ser usados no aprendizado de idiomas, na resolução de problemas matemáticos ou para ajudar os alunos a memorizar fatos importantes, como eventos históricos, fórmulas ou nomes.';
$string['h5p-dialogcards-title'] = 'Cartões de memorização';
$string['h5p-dragtext-desc'] = 'Crie um jogo de Arraste Palavras em que o aluno deve arrastar a parte faltante do texto para o seu lugar correto, formando uma expressão completa. Esse jogo pode ser utilizado para avaliar se o aluno lembra do conteúdo que leu ou se compreende o que foi abordado. Além disso, auxilia o aluno a refletir mais profundamente sobre o texto, promovendo uma melhor assimilação do conteúdo.';
$string['h5p-dragtext-title'] = 'Jogo de Arrastar Palavras';
$string['h5p-example'] = 'Veja o exemplo';
$string['h5p-findthewords-desc'] = 'Crie um jogo de caça-palavras no qual os alunos devem encontrar e selecionar as palavras em uma grade, a partir de uma lista fornecida.';
$string['h5p-findthewords-title'] = 'Jogo de Caça-palavras';
$string['h5p-interactivebook-desc'] = 'Crie um Livro Interativo que permite combinar diversos conteúdos interativos, como vídeos interativos, glossários, quizzes, atividades de arrastar palavras, palavras cruzadas, caça-palavras e muito mais, organizados em várias páginas. Adicione um resumo ao final, exibindo a pontuação total obtida pelo aluno ao longo do livro.';
$string['h5p-interactivebook-title'] = 'Livro Interativo';
$string['h5p-interactivevideo-desc'] = 'Crie um vídeo interativo com capítulos e um glossário destacando os principais pontos do conteúdo. No final, adicione um resumo interativo para reforçar o aprendizado e revisar os tópicos abordados.';
$string['h5p-interactivevideo-title'] = 'Vídeo Interativo';
$string['h5p-manager'] = 'Criar H5P com o GeniAI';
$string['h5p-next-step'] = 'Próxima etapa';
$string['h5p-no-apikey'] = '<p>É necessário configurar a chave de API do ChatGPT para que o sistema de criação de contas funcione corretamente. Isso permitirá que o sistema se comunique com o ChatGPT para realizar as operações necessárias durante o processo de criação de contas.<p><p><a href="{$a}">Clique aqui para configurar a chave de API do ChatGPT.</a></p>';
$string['h5p-page-title'] = 'Criar um H5P com o GeniAI';
$string['h5p-questionset-desc'] = 'Crie um Conjunto de Perguntas que permita ao aluno resolver uma sequência de questões diversificadas, incluindo tipos como múltipla escolha e verdadeiro ou falso, oferecendo uma experiência interativa e desafiadora.';
$string['h5p-questionset-title'] = 'Quizes';
$string['h5p-readmore'] = '...mais';
$string['h5p-return'] = 'Voltar ao Banco de conteúdo';
$string['h5p-title'] = 'Gerenciar banco de conteúdo do GeniAI';
$string['max_tokens'] = 'Máximo de palavras na resposta';
$string['max_tokens_desc'] = 'Número máximo de palavras que pode ser gerado em cada solicitação.';
$string['message_01'] = 'Olá, {$a}! 🌟';
$string['message_02_course'] = 'Bem-vindo ao curso {$a->coursename} no Moodle {$a->moodlename}!
Sou a {$a->geniainame} e estou aqui para tornar sua jornada de aprendizado o mais incrível possível.
Como posso ajudar você hoje? 🌟📚';
$string['message_02_geniai'] = 'Olá! Eu sou o {$a} e estou aqui para te ajudar. Se preferir, pode me enviar um áudio, e eu responderei também em áudio. Se preferir escrever, responderei por texto. Como você preferir!';
$string['message_02_home'] = 'Sou a {$a} e estou aqui para tornar sua jornada de aprendizado o mais incrível possível.
Como posso ajudar você hoje? 🌟📚';
$string['mode'] = 'Modo de uso';
$string['mode_desc'] = 'Defina qual modo de uso do balão você deseja';
$string['mode_name_assistant'] = 'Assistente Moodle';
$string['mode_name_geniai'] = 'Tutor GeniAI';
$string['mode_name_none'] = 'Sem balão de chat';
$string['model'] = 'O Modelo da API';
$string['model_desc'] = 'O Modelo da API que será executada na OpenAI. Valores disponíveis estão no <a href="https://platform.openai.com/docs/models/overview" target="_blank">site da OpenAI</a><br>
* <strong>gpt-3.5-turbo</strong>: é muito bom, tem um custo/benefício vom e responde muito rápido.<br>
* <strong>gpt-4</strong>: é muito mais podersos, um pouco mais caro e demora um pouco mais para responder e necessíta que você faça um <a href="https://help.openai.com/en/articles/7102672-how-can-i-access-gpt-4" target="_blank">pagamento inicial de $1</a> para poder testar';
$string['modulename'] = 'Tutor GeniAI';
$string['modules'] = 'Módulos que deve ocultar o {$a}';
$string['modules_desc'] = 'Esta lista contém os módulos que não deve disponibilizar o {$a} aos alunos, assegurando que eles não sejam utilizados em exercícios.';
$string['online'] = 'Online';
$string['pluginname'] = 'Tutor GeniAI';
$string['presence_penalty'] = 'Penalidade de Presença';
$string['presence_penalty_desc'] = 'Este parâmetro é utilizado para incentivar o modelo a incluir uma variedade de tokens no texto gerado. É um valor subtraído da log-probabilidade de um token cada vez que é gerado. Um valor de penalidade de presença mais alto fará com que o modelo tenha mais probabilidade de gerar tokens que ainda não foram incluídos no texto gerado.';
$string['privacy:metadata'] = 'O plugin Tutor GeniAI armazena o histórico das conversas que você envia e transmitirá à OpenAI apenas o o nome completo, nome do curso e a URL, sem compartilhar qualquer outro dado pessoal seu.';
$string['report_completion_tokens'] = 'Quantidade de Tokens recebidos';
$string['report_datecreated'] = 'Dia';
$string['report_filename'] = 'Relatório de uso do GPT Assistence';
$string['report_info'] = '<p>No relatório apresentado, somente as primeiras 100 linhas estão disponíveis. Para acessar todos os registros, por favor, realize o download completo do documento.</p><p>Quanto aos tokens, uma regra prática é que um token geralmente corresponde a aproximadamente 4 caracteres de texto comum em inglês. Isso equivale a aproximadamente ¾ de uma palavra (portanto, 100 tokens ~= 75 palavras). Saiba mais na página <a href="https://platform.openai.com/tokenizer" target="_blank">Saiba mais sobre a tokenização do modelo de linguagem</a>.</p>';
$string['report_model'] = 'Modelo do ChatGPT';
$string['report_prompt_tokens'] = 'Quantidade de Tokens enviados';
$string['report_title'] = 'Relatório';
$string['send_message'] = 'Enviar a mensagem';
$string['settings'] = 'Configurar Tutor GeniAI';
$string['talk_geniai'] = 'Fale com seu geniai aqui';
$string['url_moodle'] = 'A URL do Moodle é "{$a->wwwroot}" e o nome do Moodle é "{$a->fullname}"';
$string['voice'] = 'Vóz usada na resposta com áudio';
$string['voice_desc'] = '<p style="display:flex;align-items:center;gap:10px;">Alloy:
    <audio src="https://cdn.openai.com/API/docs/audio/alloy.wav" controls></audio></p>
<p style="display:flex;align-items:center;gap:10px;">Echo:
    <audio src="https://cdn.openai.com/API/docs/audio/echo.wav" controls></audio></p>
<p style="display:flex;align-items:center;gap:10px;">Fable:
    <audio src="https://cdn.openai.com/API/docs/audio/fable.wav" controls></audio></p>
<p style="display:flex;align-items:center;gap:10px;">Onyx:
    <audio src="https://cdn.openai.com/API/docs/audio/onyx.wav" controls></audio></p>
<p style="display:flex;align-items:center;gap:10px;">Nova:
    <audio src="https://cdn.openai.com/API/docs/audio/nova.wav" controls></audio></p>
<p style="display:flex;align-items:center;gap:10px;">Shimmer:
    <audio src="https://cdn.openai.com/API/docs/audio/shimmer.wav" controls></audio></p>';
$string['write_message'] = 'Escreve uma mensagem...';
