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
 * lang uk file.
 *
 * @package   local_geniai
 * @copyright 2024 Eduardo Kraus {@link https://eduardokraus.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

$string['agentphoto'] = 'Фото агента ШІ';
$string['agentphoto_desc'] = 'Зображення, що відображається як аватар агента ШІ під час чат-розмов.';
$string['analysis_ai_block'] = 'Аналіз ШІ';
$string['analysis_bloom_analyze'] = 'Аналізувати';
$string['analysis_bloom_apply'] = 'Застосувати';
$string['analysis_bloom_create'] = 'Створити';
$string['analysis_bloom_evaluate'] = 'Оцінити';
$string['analysis_bloom_remember'] = 'Запам’ятати';
$string['analysis_bloom_understand'] = 'Зрозуміти';
$string['analysis_cached'] = 'Кешований аналіз';
$string['analysis_close'] = 'Закрити';
$string['analysis_error'] = 'Не вдалося проаналізувати цю активність.';
$string['analysis_force_new'] = 'Запустити новий аналіз';
$string['analysis_history'] = 'Історія аналізів';
$string['analysis_last'] = 'Останній аналіз';
$string['analysis_latest'] = 'Останній аналіз';
$string['analysis_model_warning'] = 'У цьому аналізі використано модель mini/nano. Для кращого аналізу налаштуйте <a href="{$a}/admin/settings.php?section=local_geniai" target="_blank">модель API</a> без mini або nano.';
$string['analysis_no_content'] = 'Вміст аналізу не повернуто.';
$string['analysis_print'] = 'Друк';
$string['analysis_print_analysis'] = 'Друк аналіз';
$string['analysis_print_popup_blocked'] = 'Браузер заблокував вкладку друку. Дозвольте спливаючі вікна й спробуйте ще раз.';
$string['analysis_reanalyze'] = 'Проаналізувати знову';
$string['analysis_recommendations'] = 'Рекомендації';
$string['analysis_result'] = 'Аналіз активності';
$string['analysis_status_insufficient'] = 'Недостатньо';
$string['analysis_status_needs_review'] = 'Потребує перегляду';
$string['analysis_status_ok'] = 'OK';
$string['analysis_status_ok_minor'] = 'OK з незначними коригуваннями';
$string['analyze_activity'] = 'Аналізувати з ШІ';
$string['analyze_course'] = 'Аналізувати курс з ШІ';
$string['analyzing_activity'] = 'Аналіз правопису, педагогічної узгодженості та таксономії Блума...';
$string['analyzing_course'] = 'Аналіз активностей курсу...';
$string['apikey'] = 'OpenAI API Key';
$string['apikey_desc'] = 'API-ключ вашого облікового запису OpenAI';
$string['case'] = 'Сценарії використання';
$string['caseuse_balanced'] = 'Збалансовані відповіді => Temperature 0.5 - 0.7, Top_p 0.7';
$string['caseuse_chatbot'] = 'Chatbot => Temperature 0.2 - 0.6, Top_p 0.8';
$string['caseuse_creative'] = 'Креативна генерація => Temperature 0.7 - 1.0, Top_p 0.8';
$string['caseuse_exploration'] = 'Дослідження варіантів => Temperature 0.8 - 1.0, Top_p 0.9';
$string['caseuse_formal'] = 'Формальний тон => Temperature 0.3 - 0.5, Top_p 0.6';
$string['caseuse_informal'] = 'Неформальний тон => Temperature 0.7 - 0.9, Top_p 0.8';
$string['caseuse_precise'] = 'Точні відповіді => Temperature 0.0 - 0.3, Top_p 1.0';
$string['clear_history_title'] = 'Очистити всю історію';
$string['close_title'] = 'Закрити чат';
$string['frequency_penalty'] = 'Штраф за частоту';
$string['frequency_penalty_desc'] = 'Цей параметр використовується, щоб зменшити надто часте повторення тих самих слів або фраз у згенерованому тексті. Вища величина робить модель обережнішою щодо повторів.';
$string['geniai:analyzeactivity'] = 'Аналізувати активності Moodle з GeniAI';
$string['geniai:manage'] = 'Керувати GeniAI';
$string['geniai:view'] = 'Переглянути GeniAI';
$string['geniainame'] = 'Ім’я асистента';
$string['geniainame_desc'] = 'Визначте ім’я свого асистента';
$string['h5p-accordion-desc'] = 'Створіть Глосарій зі свого вмісту, щоб допомогти студентам навчатися більш інтерактивно, зрозуміло й цікаво.';
$string['h5p-accordion-title'] = 'Глосарій';
$string['h5p-advancedtext-desc'] = 'Створіть Цифрова книга зі свого вмісту, щоб допомогти студентам навчатися більш інтерактивно, зрозуміло й цікаво.';
$string['h5p-advancedtext-title'] = 'Цифрова книга';
$string['h5p-block-title'] = 'Назва блоку';
$string['h5p-create'] = 'Створити H5P з GeniAI';
$string['h5p-create-new'] = 'Створити новий H5P з GeniAI';
$string['h5p-create-this'] = 'Створити з цим ресурсом';
$string['h5p-create-title'] = 'Назва H5P';
$string['h5p-create-title-desc'] = 'Визначте основну назву H5P-вмісту, яка відображатиметься користувачам в інтерфейсі.';
$string['h5p-createpage-title'] = 'Створити новий {$a}';
$string['h5p-crossword-desc'] = 'Створіть Кросворд зі свого вмісту, щоб допомогти студентам навчатися більш інтерактивно, зрозуміло й цікаво.';
$string['h5p-crossword-title'] = 'Кросворд';
$string['h5p-delete-success'] = 'H5P успішно видалено!';
$string['h5p-dialogcards-desc'] = 'Створіть Флешкартки зі свого вмісту, щоб допомогти студентам навчатися більш інтерактивно, зрозуміло й цікаво.';
$string['h5p-dialogcards-title'] = 'Флешкартки';
$string['h5p-dragtext-desc'] = 'Створіть Гра перетягування слів зі свого вмісту, щоб допомогти студентам навчатися більш інтерактивно, зрозуміло й цікаво.';
$string['h5p-dragtext-title'] = 'Гра перетягування слів';
$string['h5p-example'] = 'Переглянути приклад';
$string['h5p-findthewords-desc'] = 'Створіть Пошук слів зі свого вмісту, щоб допомогти студентам навчатися більш інтерактивно, зрозуміло й цікаво.';
$string['h5p-findthewords-title'] = 'Пошук слів';
$string['h5p-interactivebook-desc'] = 'Створіть Інтерактивна книга зі свого вмісту, щоб допомогти студентам навчатися більш інтерактивно, зрозуміло й цікаво.';
$string['h5p-interactivebook-title'] = 'Інтерактивна книга';
$string['h5p-interactivevideo-desc'] = 'Створіть Інтерактивне відео зі свого вмісту, щоб допомогти студентам навчатися більш інтерактивно, зрозуміло й цікаво.';
$string['h5p-interactivevideo-title'] = 'Інтерактивне відео';
$string['h5p-manager'] = 'Керувати H5P з GeniAI';
$string['h5p-manager-scorm'] = 'Керувати SCORM з GeniAI';
$string['h5p-next-step'] = 'Наступний крок';
$string['h5p-no-apikey'] = '<p>Для правильної роботи системи створення облікових записів потрібно налаштувати API-ключ ChatGPT.<p><p><a href="{$a}">Натисніть тут, щоб налаштувати API-ключ ChatGPT.</a></p>';
$string['h5p-page-title'] = 'Створити H5P з GeniAI';
$string['h5p-questionset-desc'] = 'Створіть Тести зі свого вмісту, щоб допомогти студентам навчатися більш інтерактивно, зрозуміло й цікаво.';
$string['h5p-questionset-title'] = 'Тести';
$string['h5p-readmore'] = '...більше';
$string['h5p-return'] = 'Повернутися до банку вмісту';
$string['h5p-title'] = 'Керувати банком вмісту GeniAI';
$string['message_01'] = 'Вітаю, {$a}! 🌟';
$string['message_02'] = 'Ласкаво просимо до курсу {$a->coursename} у Moodle {$a->moodlename}!
Я {$a->geniainame}, і я тут, щоб зробити ваше навчання якомога кращим.
Чим я можу допомогти сьогодні? 🌟📚';
$string['mode'] = 'Режим використання';
$string['mode_desc'] = 'Визначте режим використання бульбашки';
$string['mode_name_geniai'] = 'Тьютор GeniAI';
$string['mode_name_none'] = 'Без чат-бульбашки';
$string['model'] = 'Модель API';
$string['model_desc'] = 'Модель API, яка виконуватиметься в OpenAI. Доступні значення наведено на <a href="https://platform.openai.com/docs/models/overview" target="_blank">сайті OpenAI</a><br>
<strong>Важливо:</strong> якщо використовується модель ChatGPT з <strong>mini</strong> або <strong>nano</strong>, покажіть повідомлення з рекомендацією моделі API без mini або nano для кращого аналізу.';
$string['modulename'] = 'GeniAI';
$string['modules'] = 'Модулі, які потрібно приховати від {$a}';
$string['modules_desc'] = 'Цей список містить модулі, які не мають бути доступні студентам, щоб вони не використовувалися у вправах.';
$string['online'] = 'Онлайн';
$string['pluginname'] = 'GeniAI';
$string['presence_penalty'] = 'Штраф за присутність';
$string['presence_penalty_desc'] = 'Цей параметр заохочує модель включати більшу різноманітність токенів у згенерований текст. Вища величина підвищує ймовірність появи нових токенів.';
$string['privacy:metadata'] = 'Плагін GeniAI зберігає тимчасову історію розмови в поточному сеансі та лише операційні метадані використання, не зберігаючи тіла повідомлень або персональні дані у локальних звітах.';
$string['prompt_activity_focus_alignment'] = 'пріоритет узгодженості між курсом, розділом, назвою та вмістом активності.';
$string['prompt_activity_focus_bloom'] = 'пріоритет таксономії Блума та когнітивної глибини пропозиції.';
$string['prompt_activity_focus_full'] = 'повний аналіз активності.';
$string['prompt_activity_focus_pedagogy'] = 'пріоритет педагогічної доцільності, інструкцій для студента та якості навчання.';
$string['prompt_activity_focus_spelling'] = 'пріоритет правопису, граматики, чіткості та інструктивного тону.';
$string['prompt_activity_schema_bloom_level'] = 'remember | understand | apply | analyze | evaluate | create';
$string['prompt_activity_schema_diagnosis'] = 'Короткий підсумок загального діагнозу.';
$string['prompt_activity_schema_recommendation_1'] = 'Практична дія 1.';
$string['prompt_activity_schema_recommendation_2'] = 'Практична дія 2.';
$string['prompt_activity_schema_status'] = 'OK | OK with minor adjustments | Needs review | Inadequate or insufficient';
$string['prompt_activity_schema_status_key'] = 'ok | ok_minor | needs_review | insufficient';
$string['prompt_activity_system'] = 'Ви експерт з instructional design, перевірки текстів і Moodle. Проаналізуйте наявну активність Moodle поточною мовою користувача: {$a->lang}. Технічні поля JSON і значення enum залишайте точно англійською. Не вигадуйте інформацію й чітко зазначайте, якщо вмісту недостатньо.

Обов’язкові критерії: правопис і чіткість, узгодженість між назвою, розділом і вмістом, таксономія Блума з одним значенням remember, understand, apply, analyze, evaluate або create, педагогічна доцільність і практичні рекомендації.

Додатковий фокус: {$a->focus}

Наприкінці додайте технічний блок із дійсним JSON між ```json і ```. Обов’язкові поля: status_key, status, bloom_level, diagnosis, recommendations. Тип аналізу: {$a->analysis}';
$string['prompt_activity_user'] = 'Проаналізуйте Moodle-активність нижче.

{$a}';
$string['prompt_chat_system'] = 'Ви чатбот на ім’я **{$a->geniainame}**. Ваша роль — бути корисним викладачем Moodle для курсу **[**{$a->coursename}**]({$a->courseurl})** на сайті "{$a->sitename}".

## Модулі курсу:
{$a->modules}

Відповідайте чітко, дружньо й мотивувально. Якщо питання неоднозначне, попросіть деталей. Якщо відповіді не знаєте, скажіть це й не вигадуйте інформацію. Залишайтеся в межах курсу **{$a->coursename}**. Використовуйте лише MARKDOWN і завжди відповідайте мовою **{$a->userlang}**.';
$string['prompt_json_block_instruction'] = '

Також поверніть фінальний технічний блок із дійсним JSON між ```json і ```.';
$string['prompt_json_block_schema'] = '
Використайте цей еталонний формат:
{$a}';
$string['prompt_json_style'] = '
Стиль:
- Уникайте списків; використовуйте їх лише за потреби;
- Використовуйте `:` лише тоді, коли це справді необхідно; краще переписуйте повними реченнями;
- Не додавайте висновок або фінальне резюме;
- Стежте, щоб текст не звучав як створений ШІ.';
$string['report_completion_tokens'] = 'Кількість отриманих токенів';
$string['report_datecreated'] = 'День';
$string['report_download'] = 'Завантажити використання GPT';
$string['report_filename'] = 'Звіт про використання допомоги GPT';
$string['report_info'] = '<p>У представленому звіті доступні лише перші 100 рядків. Щоб отримати всі записи, завантажте повний документ.</p><p>Один токен приблизно відповідає 4 символам звичайного англійського тексту. Докладніше на сторінці <a href="https://platform.openai.com/tokenizer" target="_blank">Language Model Tokenization</a>.</p>';
$string['report_list'] = 'Список аудіо';
$string['report_model'] = 'Модель ChatGPT';
$string['report_prompt_tokens'] = 'Кількість надісланих токенів';
$string['report_title'] = 'Звіт';
$string['send_message'] = 'Надіслати повідомлення';
$string['settings'] = 'Налаштувати GeniAI';
$string['settings_casedesc'] = 'Параметри Temperature і Top_p задаються для різних сценаріїв, таких як генерація тексту й коду, творче письмо, чатбот, текстові коментарі, аналіз даних і дослідницьке письмо.<br><br>Скористайтеся таблицею нижче як орієнтиром для Temperature і Top_p:<br>';
$string['settings_casedesc_balancedresp'] = 'Збалансовані відповіді';
$string['settings_casedesc_balancedresp_desc'] = 'Збалансовані відповіді.';
$string['settings_casedesc_caseuse'] = 'Сценарії використання';
$string['settings_casedesc_chatbot'] = 'Chatbot';
$string['settings_casedesc_chatbot_desc'] = 'Швидкі, послідовні та контекстні відповіді для взаємодії з користувачами в реальному часі.';
$string['settings_casedesc_creativegen'] = 'Креативна генерація';
$string['settings_casedesc_creativegen_desc'] = 'Створює більш креативні, оригінальні або дослідницькі відповіді. Корисно для мозкового штурму або сторітелінгу.';
$string['settings_casedesc_description'] = 'Опис';
$string['settings_casedesc_formaltones'] = 'Формальний тон';
$string['settings_casedesc_formaltones_desc'] = 'Створює більш формальні або технічні тексти з меншою творчою варіативністю.';
$string['settings_casedesc_optionexplore'] = 'Дослідження варіантів';
$string['settings_casedesc_optionexplore_desc'] = 'Генерує кілька альтернативних відповідей для розгляду різних підходів до питання.';
$string['settings_casedesc_preciseresp'] = 'Точні відповіді';
$string['settings_casedesc_preciseresp_desc'] = 'Максимальна точність і передбачуваність. Рекомендовано для технічних або інформаційних завдань.';
$string['settings_casedesc_relaxedtones'] = 'Невимушені тони';
$string['settings_casedesc_relaxedtones_desc'] = 'Створює легші та неформальні тексти з творчим і дружнім підходом.';
$string['settings_casedesc_temperature'] = 'Temperature';
$string['settings_casedesc_top_p'] = 'Top_p';
$string['talk_geniai'] = 'Поговоріть з {$a} тут';
$string['write_message'] = 'Напишіть повідомлення...';
