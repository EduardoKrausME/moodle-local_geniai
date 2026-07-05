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
 * lang ru file.
 *
 * @package   local_geniai
 * @copyright 2024 Eduardo Kraus {@link https://eduardokraus.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

$string['agentphoto'] = 'Фото ИИ-агента';
$string['agentphoto_desc'] = 'Изображение, отображаемое как аватар ИИ-агента во время чат-бесед.';
$string['analysis_ai_block'] = 'Анализ ИИ';
$string['analysis_bloom_analyze'] = 'Анализировать';
$string['analysis_bloom_apply'] = 'Применить';
$string['analysis_bloom_create'] = 'Создать';
$string['analysis_bloom_evaluate'] = 'Оценить';
$string['analysis_bloom_remember'] = 'Запомнить';
$string['analysis_bloom_understand'] = 'Понять';
$string['analysis_cached'] = 'Кэшированный анализ';
$string['analysis_close'] = 'Закрыть';
$string['analysis_error'] = 'Не удалось проанализировать эту активность.';
$string['analysis_force_new'] = 'Запустить новый анализ';
$string['analysis_history'] = 'История анализов';
$string['analysis_last'] = 'Последний анализ';
$string['analysis_latest'] = 'Последний анализ';
$string['analysis_model_warning'] = 'В этом анализе использована модель mini/nano. Для лучшего анализа настройте <a href="{$a}/admin/settings.php?section=local_geniai" target="_blank">модель API</a> без mini или nano.';
$string['analysis_no_content'] = 'Содержимое анализа не было возвращено.';
$string['analysis_print'] = 'Печать';
$string['analysis_print_analysis'] = 'Печать анализ';
$string['analysis_print_popup_blocked'] = 'Браузер заблокировал вкладку печати. Разрешите всплывающие окна и попробуйте снова.';
$string['analysis_reanalyze'] = 'Проанализировать снова';
$string['analysis_recommendations'] = 'Рекомендации';
$string['analysis_result'] = 'Анализ активности';
$string['analysis_status_insufficient'] = 'Недостаточно';
$string['analysis_status_needs_review'] = 'Требует проверки';
$string['analysis_status_ok'] = 'OK';
$string['analysis_status_ok_minor'] = 'OK с небольшими корректировками';
$string['analyze_activity'] = 'Анализировать с ИИ';
$string['analyze_course'] = 'Анализировать курс с ИИ';
$string['analyzing_activity'] = 'Анализ орфографии, педагогической согласованности и таксономии Блума...';
$string['analyzing_course'] = 'Анализ активностей курса...';
$string['apikey'] = 'OpenAI API Key';
$string['apikey_desc'] = 'API-ключ вашей учетной записи OpenAI';
$string['case'] = 'Сценарии использования';
$string['caseuse_balanced'] = 'Сбалансированные ответы => Temperature 0.5 - 0.7, Top_p 0.7';
$string['caseuse_chatbot'] = 'Chatbot => Temperature 0.2 - 0.6, Top_p 0.8';
$string['caseuse_creative'] = 'Креативная генерация => Temperature 0.7 - 1.0, Top_p 0.8';
$string['caseuse_exploration'] = 'Исследование вариантов => Temperature 0.8 - 1.0, Top_p 0.9';
$string['caseuse_formal'] = 'Формальный тон => Temperature 0.3 - 0.5, Top_p 0.6';
$string['caseuse_informal'] = 'Неформальный тон => Temperature 0.7 - 0.9, Top_p 0.8';
$string['caseuse_precise'] = 'Точные ответы => Temperature 0.0 - 0.3, Top_p 1.0';
$string['clear_history_title'] = 'Очистить всю историю';
$string['close_title'] = 'Закрыть чат';
$string['frequency_penalty'] = 'Штраф за частоту';
$string['frequency_penalty_desc'] = 'Этот параметр используется, чтобы уменьшить слишком частое повторение одних и тех же слов или фраз в сгенерированном тексте. Более высокое значение делает модель более осторожной с повторами.';
$string['geniai:analyzeactivity'] = 'Анализировать активности Moodle с GeniAI';
$string['geniai:manage'] = 'Управлять GeniAI';
$string['geniai:view'] = 'Просмотр GeniAI';
$string['geniainame'] = 'Имя ассистента';
$string['geniainame_desc'] = 'Укажите имя вашего ассистента';
$string['h5p-accordion-desc'] = 'Создайте Глоссарий на основе своего содержимого, чтобы помочь студентам учиться более интерактивно, понятно и увлекательно.';
$string['h5p-accordion-title'] = 'Глоссарий';
$string['h5p-advancedtext-desc'] = 'Создайте Цифровая книга на основе своего содержимого, чтобы помочь студентам учиться более интерактивно, понятно и увлекательно.';
$string['h5p-advancedtext-title'] = 'Цифровая книга';
$string['h5p-block-title'] = 'Заголовок блока';
$string['h5p-create'] = 'Создать H5P с GeniAI';
$string['h5p-create-new'] = 'Создать новый H5P с GeniAI';
$string['h5p-create-this'] = 'Создать с этим ресурсом';
$string['h5p-create-title'] = 'Заголовок H5P';
$string['h5p-create-title-desc'] = 'Укажите основной заголовок H5P-контента, который будет отображаться пользователям в интерфейсе.';
$string['h5p-createpage-title'] = 'Создать новый {$a}';
$string['h5p-crossword-desc'] = 'Создайте Кроссворд на основе своего содержимого, чтобы помочь студентам учиться более интерактивно, понятно и увлекательно.';
$string['h5p-crossword-title'] = 'Кроссворд';
$string['h5p-delete-success'] = 'H5P успешно удален!';
$string['h5p-dialogcards-desc'] = 'Создайте Флешкарточки на основе своего содержимого, чтобы помочь студентам учиться более интерактивно, понятно и увлекательно.';
$string['h5p-dialogcards-title'] = 'Флешкарточки';
$string['h5p-dragtext-desc'] = 'Создайте Игра перетаскивания слов на основе своего содержимого, чтобы помочь студентам учиться более интерактивно, понятно и увлекательно.';
$string['h5p-dragtext-title'] = 'Игра перетаскивания слов';
$string['h5p-example'] = 'Смотреть пример';
$string['h5p-findthewords-desc'] = 'Создайте Поиск слов на основе своего содержимого, чтобы помочь студентам учиться более интерактивно, понятно и увлекательно.';
$string['h5p-findthewords-title'] = 'Поиск слов';
$string['h5p-interactivebook-desc'] = 'Создайте Интерактивная книга на основе своего содержимого, чтобы помочь студентам учиться более интерактивно, понятно и увлекательно.';
$string['h5p-interactivebook-title'] = 'Интерактивная книга';
$string['h5p-interactivevideo-desc'] = 'Создайте Интерактивное видео на основе своего содержимого, чтобы помочь студентам учиться более интерактивно, понятно и увлекательно.';
$string['h5p-interactivevideo-title'] = 'Интерактивное видео';
$string['h5p-manager'] = 'Управлять H5P с GeniAI';
$string['h5p-manager-scorm'] = 'Управлять SCORM с GeniAI';
$string['h5p-next-step'] = 'Следующий шаг';
$string['h5p-no-apikey'] = '<p>Для корректной работы системы создания учетных записей необходимо настроить API-ключ ChatGPT.<p><p><a href="{$a}">Нажмите здесь, чтобы настроить API-ключ ChatGPT.</a></p>';
$string['h5p-page-title'] = 'Создать H5P с GeniAI';
$string['h5p-questionset-desc'] = 'Создайте Тесты на основе своего содержимого, чтобы помочь студентам учиться более интерактивно, понятно и увлекательно.';
$string['h5p-questionset-title'] = 'Тесты';
$string['h5p-readmore'] = '...еще';
$string['h5p-return'] = 'Вернуться в банк контента';
$string['h5p-title'] = 'Управлять банком контента GeniAI';
$string['message_01'] = 'Здравствуйте, {$a}! 🌟';
$string['message_02'] = 'Добро пожаловать на курс {$a->coursename} в Moodle {$a->moodlename}!
Я {$a->geniainame}, и я здесь, чтобы сделать ваше обучение максимально полезным.
Чем я могу помочь сегодня? 🌟📚';
$string['mode'] = 'Режим использования';
$string['mode_desc'] = 'Определите режим использования всплывающего окна';
$string['mode_name_geniai'] = 'Тьютор GeniAI';
$string['mode_name_none'] = 'Без чат-пузыря';
$string['model'] = 'Модель API';
$string['model_desc'] = 'Модель API, которая будет выполняться в OpenAI. Доступные значения указаны на <a href="https://platform.openai.com/docs/models/overview" target="_blank">сайте OpenAI</a><br>
<strong>Важно:</strong> если используется модель ChatGPT с <strong>mini</strong> или <strong>nano</strong>, показывайте сообщение с рекомендацией модели API без mini или nano для лучшего анализа.';
$string['modulename'] = 'GeniAI';
$string['modules'] = 'Модули, скрываемые от {$a}';
$string['modules_desc'] = 'Этот список содержит модули, которые не должны быть доступны студентам, чтобы они не использовались в упражнениях.';
$string['online'] = 'Онлайн';
$string['pluginname'] = 'GeniAI';
$string['presence_penalty'] = 'Штраф за присутствие';
$string['presence_penalty_desc'] = 'Этот параметр побуждает модель использовать большее разнообразие токенов в сгенерированном тексте. Более высокое значение повышает вероятность появления новых токенов.';
$string['privacy:metadata'] = 'Плагин GeniAI хранит временную историю беседы в текущей сессии и только операционные метаданные использования, не сохраняя тела сообщений или персональные данные в локальных отчетах.';
$string['prompt_activity_focus_alignment'] = 'сделайте приоритетом согласованность между курсом, разделом, названием и содержанием активности.';
$string['prompt_activity_focus_bloom'] = 'сделайте приоритетом таксономию Блума и когнитивную глубину предложения.';
$string['prompt_activity_focus_full'] = 'полный анализ активности.';
$string['prompt_activity_focus_pedagogy'] = 'сделайте приоритетом педагогическую уместность, инструкции для студента и качество обучения.';
$string['prompt_activity_focus_spelling'] = 'сделайте приоритетом орфографию, грамматику, ясность и инструктивный тон.';
$string['prompt_activity_schema_bloom_level'] = 'remember | understand | apply | analyze | evaluate | create';
$string['prompt_activity_schema_diagnosis'] = 'Краткое резюме общего диагноза.';
$string['prompt_activity_schema_recommendation_1'] = 'Практическое действие 1.';
$string['prompt_activity_schema_recommendation_2'] = 'Практическое действие 2.';
$string['prompt_activity_schema_status'] = 'OK | OK with minor adjustments | Needs review | Inadequate or insufficient';
$string['prompt_activity_schema_status_key'] = 'ok | ok_minor | needs_review | insufficient';
$string['prompt_activity_system'] = 'Вы эксперт по instructional design, проверке текстов и Moodle. Проанализируйте существующую активность Moodle на текущем языке пользователя: {$a->lang}. Технические поля JSON и значения enum оставляйте точно на английском. Не выдумывайте информацию и ясно указывайте, если содержимого недостаточно.

Обязательные критерии: орфография и ясность, согласованность между названием, разделом и содержимым, таксономия Блума с одним значением remember, understand, apply, analyze, evaluate или create, педагогическая уместность и практические рекомендации.

Дополнительный фокус: {$a->focus}

В конце добавьте технический блок с валидным JSON между ```json и ```. Обязательные поля: status_key, status, bloom_level, diagnosis, recommendations. Тип анализа: {$a->analysis}';
$string['prompt_activity_user'] = 'Проанализируйте активность Moodle ниже.

{$a}';
$string['prompt_chat_system'] = 'Вы чатбот по имени **{$a->geniainame}**. Ваша роль — быть полезным преподавателем Moodle для курса **[**{$a->coursename}**]({$a->courseurl})** на сайте "{$a->sitename}".

## Модули курса:
{$a->modules}

Отвечайте ясно, дружелюбно и мотивирующе. Если вопрос неоднозначен, попросите детали. Если ответа не знаете, скажите об этом и не выдумывайте информацию. Держите фокус на курсе **{$a->coursename}**. Используйте только MARKDOWN и всегда отвечайте на языке **{$a->userlang}**.';
$string['prompt_json_block_instruction'] = '

Также верните финальный технический блок с валидным JSON между ```json и ```.';
$string['prompt_json_block_schema'] = '
Используйте этот справочный формат:
{$a}';
$string['prompt_json_style'] = '
Стиль:
- Избегайте списков; используйте их только при необходимости;
- Используйте `:` только когда это действительно нужно; лучше переписывайте полными предложениями;
- Не добавляйте вывод или итоговое резюме;
- Следите, чтобы текст не звучал как сгенерированный ИИ.';
$string['report_completion_tokens'] = 'Количество полученных токенов';
$string['report_datecreated'] = 'День';
$string['report_download'] = 'Скачать использование GPT';
$string['report_filename'] = 'Отчет об использовании помощи GPT';
$string['report_info'] = '<p>В представленном отчете доступны только первые 100 строк. Чтобы получить все записи, скачайте полный документ.</p><p>Один токен примерно соответствует 4 символам обычного английского текста. Подробнее см. на странице <a href="https://platform.openai.com/tokenizer" target="_blank">Language Model Tokenization</a>.</p>';
$string['report_list'] = 'Список аудио';
$string['report_model'] = 'Модель ChatGPT';
$string['report_prompt_tokens'] = 'Количество отправленных токенов';
$string['report_title'] = 'Отчет';
$string['send_message'] = 'Отправить сообщение';
$string['settings'] = 'Настроить GeniAI';
$string['settings_casedesc'] = 'Параметры Temperature и Top_p задаются для разных сценариев, таких как генерация текста и кода, творческое письмо, чатбот, текстовые комментарии, анализ данных и исследовательское письмо.<br><br>Используйте таблицу ниже как руководство по Temperature и Top_p:<br>';
$string['settings_casedesc_balancedresp'] = 'Сбалансированные ответы';
$string['settings_casedesc_balancedresp_desc'] = 'Сбалансированные ответы.';
$string['settings_casedesc_caseuse'] = 'Сценарии использования';
$string['settings_casedesc_chatbot'] = 'Chatbot';
$string['settings_casedesc_chatbot_desc'] = 'Быстрые, последовательные и контекстные ответы для взаимодействия с пользователями в реальном времени.';
$string['settings_casedesc_creativegen'] = 'Креативная генерация';
$string['settings_casedesc_creativegen_desc'] = 'Создает более творческие, оригинальные или исследовательские ответы. Полезно для мозгового штурма или сторителлинга.';
$string['settings_casedesc_description'] = 'Описание';
$string['settings_casedesc_formaltones'] = 'Формальный тон';
$string['settings_casedesc_formaltones_desc'] = 'Создает более формальные или технические тексты с меньшей творческой вариативностью.';
$string['settings_casedesc_optionexplore'] = 'Исследование вариантов';
$string['settings_casedesc_optionexplore_desc'] = 'Генерирует несколько альтернативных ответов для рассмотрения разных подходов к вопросу.';
$string['settings_casedesc_preciseresp'] = 'Точные ответы';
$string['settings_casedesc_preciseresp_desc'] = 'Максимальная точность и предсказуемость. Рекомендуется для технических или информационных задач.';
$string['settings_casedesc_relaxedtones'] = 'Свободные тона';
$string['settings_casedesc_relaxedtones_desc'] = 'Создает более легкие и неформальные тексты с творческим и дружелюбным подходом.';
$string['settings_casedesc_temperature'] = 'Temperature';
$string['settings_casedesc_top_p'] = 'Top_p';
$string['talk_geniai'] = 'Поговорите с {$a} здесь';
$string['write_message'] = 'Напишите сообщение...';
