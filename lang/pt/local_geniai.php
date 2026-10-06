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
 * lang pt file.
 *
 * @package   local_geniai
 * @copyright 2024 Eduardo Kraus {@link https://eduardokraus.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

$string['agentphoto'] = 'Fotografia do agente de IA';
$string['agentphoto_desc'] = 'Imagem apresentada como avatar do agente de IA durante as conversas de chat.';
$string['apikey'] = 'OpenAI API Key';
$string['apikey_desc'] = 'A chave de API da sua conta OpenAI';
$string['case'] = 'Casos de uso';
$string['caseuse_balanced'] = 'Respostas equilibradas => Temperature 0.5 - 0.7, Top_p 0.7';
$string['caseuse_chatbot'] = 'Chatbot => Temperature 0.2 - 0.6, Top_p 0.8';
$string['caseuse_creative'] = 'Geração criativa => Temperature 0.7 - 1.0, Top_p 0.8';
$string['caseuse_exploration'] = 'Exploração de opções => Temperature 0.8 - 1.0, Top_p 0.9';
$string['caseuse_formal'] = 'Tom formal => Temperature 0.3 - 0.5, Top_p 0.6';
$string['caseuse_informal'] = 'Tom informal => Temperature 0.7 - 0.9, Top_p 0.8';
$string['caseuse_precise'] = 'Respostas precisas => Temperature 0.0 - 0.3, Top_p 1.0';
$string['clear_history_title'] = 'Limpar todo o histórico';
$string['close_title'] = 'Fechar chat';
$string['frequency_penalty'] = 'Penalização de frequência';
$string['frequency_penalty_desc'] = 'Este parâmetro é usado para desencorajar o modelo a repetir as mesmas palavras ou frases com muita frequência no texto gerado. É um valor adicionado à probabilidade logarítmica de um token cada vez que ele ocorre no texto gerado. Uma penalização maior torna o modelo mais conservador no uso de tokens repetidos.';
$string['geniai:manage'] = 'Gerenciar GeniAI';
$string['geniai:view'] = 'Visualizar GeniAI';
$string['geniainame'] = 'Nome do assistente';
$string['geniainame_desc'] = 'Defina o nome do seu assistente';
$string['h5p-accordion-desc'] = 'Crie um glossário que permita aos estudantes acessar respostas rapidamente sem excesso de texto.';
$string['h5p-accordion-title'] = 'Glossário';
$string['h5p-advancedtext-desc'] = 'Crie um livro digital a partir do seu conteúdo, organizado em capítulos de forma lógica e envolvente.';
$string['h5p-advancedtext-title'] = 'Livro digital';
$string['h5p-block-title'] = 'Título do bloco';
$string['h5p-create'] = 'Criar H5P com GeniAI';
$string['h5p-create-new'] = 'Criar novo H5P com GeniAI';
$string['h5p-create-this'] = 'Criar com este recurso';
$string['h5p-create-title'] = 'Título do H5P';
$string['h5p-create-title-desc'] = 'Defina o título principal do conteúdo H5P que será exibido aos usuários na interface.';
$string['h5p-createpage-title'] = 'Criar novo {$a}';
$string['h5p-crossword-desc'] = 'Crie um jogo interativo de palavras cruzadas para envolver os estudantes usando palavras-chave do seu conteúdo.';
$string['h5p-crossword-title'] = 'Palavras cruzadas';
$string['h5p-delete-success'] = 'H5P excluído com sucesso!';
$string['h5p-dialogcards-desc'] = 'Crie flashcards interativos para ajudar os estudantes a memorizar palavras, frases ou conceitos-chave.';
$string['h5p-dialogcards-title'] = 'Flashcards';
$string['h5p-dragtext-desc'] = 'Crie um jogo de arrastar palavras no qual o estudante deve colocar as partes faltantes do texto no local correto.';
$string['h5p-dragtext-title'] = 'Jogo de arrastar palavras';
$string['h5p-example'] = 'Ver exemplo';
$string['h5p-findthewords-desc'] = 'Crie um caça-palavras onde os estudantes devem encontrar e selecionar palavras em uma grade com base em uma lista.';
$string['h5p-findthewords-title'] = 'Caça-palavras';
$string['h5p-interactivebook-desc'] = 'Crie um livro interativo que combina vídeos, glossários, questionários, atividades de arrastar e soltar, palavras cruzadas e muito mais.';
$string['h5p-interactivebook-title'] = 'Livro interativo';
$string['h5p-interactivevideo-desc'] = 'Crie um vídeo interativo com capítulos e glossário, destacando pontos-chave do conteúdo e reforçando a aprendizagem ao final.';
$string['h5p-interactivevideo-title'] = 'Vídeo interativo';
$string['h5p-manager'] = 'Gerenciar H5P com GeniAI';
$string['h5p-manager-scorm'] = 'Gerenciar SCORM com GeniAI';
$string['h5p-next-step'] = 'Próxima etapa';
$string['h5p-no-apikey'] = '<p>É necessário configurar a chave da API do ChatGPT para que o sistema de criação de conta funcione correctamente. Isto permitirá que o sistema comunique com o ChatGPT para executar as operações necessárias durante o processo de criação da conta.<p><p><a href="{$a}">Clique aqui para configurar a chave da API do ChatGPT.</a></p>';
$string['h5p-page-title'] = 'Criar um H5P com GeniAI';
$string['h5p-questionset-desc'] = 'Crie um conjunto de perguntas com tipos variados, como múltipla escolha e verdadeiro/falso, oferecendo uma experiência interativa e desafiadora.';
$string['h5p-questionset-title'] = 'Questionários';
$string['h5p-readmore'] = '...mais';
$string['h5p-return'] = 'Voltar ao Banco de Conteúdos';
$string['h5p-title'] = 'Gerir Banco de Conteúdos GeniAI';
$string['message_01'] = 'Olá, {$a}! 🌟';
$string['message_02'] = 'Bem-vindo ao curso {$a->coursename} no Moodle {$a->moodlename}!
Eu sou {$a->geniainame} e estou aqui para tornar sua jornada de aprendizagem a melhor possível.
Como posso ajudar você hoje? 🌟📚';
$string['mode'] = 'Modo de utilização';
$string['mode_desc'] = 'Defina o modo de utilização pretendido para o balão';
$string['mode_name_geniai'] = 'Tutor GeniAI';
$string['mode_name_none'] = 'Sem balão de chat';
$string['model'] = 'O modelo da API';
$string['model_desc'] = 'O modelo da API a ser executado na OpenAI. Os valores disponíveis estão no <a href="https://platform.openai.com/docs/models/overview" target="_blank">site da OpenAI</a><br>
* <strong>gpt-4</strong>: Muito mais poderoso, um pouco mais caro, demora um pouco mais para responder e exige um <a href="https://help.openai.com/en/articles/7102672-how-can-i-access-gpt-4" target="_blank">pré-pagamento de $1</a> para testar.<br>
* <strong>gpt-4o-mini</strong>: Menos poderoso que gpt-4, porém mais rápido e barato. Não exige pré-pagamento.<br>
<strong>Importante:</strong> se você usar um modelo do ChatGPT com <strong>mini</strong> ou <strong>nano</strong>, mostre uma mensagem recomendando o Modelo da API sem mini ou nano para uma análise melhor.';
$string['modulename'] = 'GeniAI';
$string['modules'] = 'Módulos a ocultar de {$a}';
$string['modules_desc'] = 'Esta lista contém os módulos que não devem ser disponibilizados aos estudantes, garantindo que não sejam usados em exercícios.';
$string['online'] = 'Online';
$string['pluginname'] = 'GeniAI';
$string['presence_penalty'] = 'Penalização de presença';
$string['presence_penalty_desc'] = 'Este parâmetro é usado para incentivar o modelo a incluir uma variedade maior de tokens no texto gerado. É um valor subtraído da probabilidade logarítmica de um token cada vez que ele é gerado. Um valor maior aumenta a chance de o modelo gerar tokens ainda não incluídos no texto.';
$string['privacy:metadata'] = 'O plugin GeniAI mantém o histórico temporário da conversa na sessão atual e armazena apenas metadados operacionais de uso, sem salvar corpos de mensagens ou dados pessoais em seus relatórios locais.';
$string['prompt_chat_system'] = 'Você é um chatbot chamado **{$a->geniainame}**.
Sua função é atuar como um **super professor Moodle para "{$a->sitename}"**, no curso **[**{$a->coursename}**]({$a->courseurl})**, sempre prestativo e dedicado. Você é especialista em apoiar e explicar tudo relacionado à aprendizagem.

## Módulos do curso:
{$a->modules}

### Suas respostas devem sempre seguir estas orientações:
* Seja **detalhado, claro e inspirador**, com tom **amigável e motivador**.
* Preste atenção aos detalhes e forneça **exemplos práticos e explicações passo a passo** quando for útil.
* Se a pergunta for ambígua, peça mais detalhes.
* Se você não souber a resposta, diga que não sabe. Não invente informações que não foram fornecidas.
* Mantenha o foco no curso **{$a->coursename}**. Se o usuário perguntar algo fora do escopo do curso, diga que não pode ajudar com esse tema.
* Use **apenas formatação MARKDOWN**.
* **SEMPRE** responda em **{$a->userlang}** e nunca em outro idioma.

### Regras importantes:
* Nunca saia do personagem de **professor Moodle**.
* Não use construções de linguagem neutra; mantenha um tom acolhedor de professor.
* Responda apenas em MARKDOWN e no idioma {$a->userlang}.';
$string['report_completion_tokens'] = 'Número de tokens recebidos';
$string['report_datecreated'] = 'Dia';
$string['report_download'] = 'Baixar uso do GPT';
$string['report_filename'] = 'Relatório de uso da assistência GPT';
$string['report_info'] = '<p>No relatório apresentado, apenas as primeiras 100 linhas estão disponíveis. Para acessar todos os registros, baixe o documento completo.</p><p>Sobre tokens, uma regra geral é que um token corresponde aproximadamente a 4 caracteres de texto comum em inglês. Isso equivale a cerca de ¾ de uma palavra, então 100 tokens ~= 75 palavras. Saiba mais na página <a href="https://platform.openai.com/tokenizer" target="_blank">Tokenização de modelos de linguagem</a>.</p>';
$string['report_list'] = 'Listar áudios';
$string['report_model'] = 'Modelo ChatGPT';
$string['report_prompt_tokens'] = 'Número de tokens enviados';
$string['report_title'] = 'Relatório';
$string['send_message'] = 'Enviar mensagem';
$string['settings'] = 'Configurar o GeniAI';
$string['settings_casedesc'] = 'Os parâmetros de temperatura e Top_p definidos para cada cenário, como geração de texto e código, escrita criativa, chatbot, geração de comentários textuais, análise de dados e escrita exploratória. Cada configuração impacta a criatividade e a coerência do modelo na geração de conteúdo.<br><br>Veja a tabela abaixo para orientação sobre o uso de Temperature e Top_p:<br>';
$string['settings_casedesc_balancedresp'] = 'Respostas equilibradas';
$string['settings_casedesc_balancedresp_desc'] = 'Respostas equilibradas entre precisão e criatividade. Ideal para conversas naturais e amigáveis.';
$string['settings_casedesc_caseuse'] = 'Casos de uso';
$string['settings_casedesc_chatbot'] = 'Chatbot';
$string['settings_casedesc_chatbot_desc'] = 'Respostas rápidas, consistentes e contextuais para interação em tempo real com os usuários.';
$string['settings_casedesc_creativegen'] = 'Geração criativa';
$string['settings_casedesc_creativegen_desc'] = 'Produz respostas mais criativas, originais ou exploratórias. Útil para brainstorming ou criação de histórias.';
$string['settings_casedesc_description'] = 'Descrição';
$string['settings_casedesc_formaltones'] = 'Tom formal';
$string['settings_casedesc_formaltones_desc'] = 'Cria textos mais formais ou técnicos, com menor variação criativa.';
$string['settings_casedesc_optionexplore'] = 'Exploração de opções';
$string['settings_casedesc_optionexplore_desc'] = 'Gera várias respostas alternativas para considerar diferentes abordagens para uma pergunta.';
$string['settings_casedesc_preciseresp'] = 'Respostas precisas';
$string['settings_casedesc_preciseresp_desc'] = 'Máxima precisão e previsibilidade. Recomendado para tarefas técnicas ou informativas.';
$string['settings_casedesc_relaxedtones'] = 'Tons descontraídos';
$string['settings_casedesc_relaxedtones_desc'] = 'Gera textos mais leves e informais com uma abordagem criativa e amigável.';
$string['settings_casedesc_temperature'] = 'Temperature';
$string['settings_casedesc_top_p'] = 'Top_p';
$string['talk_geniai'] = 'Fale com {$a} aqui';
$string['write_message'] = 'Escreva uma mensagem...';
