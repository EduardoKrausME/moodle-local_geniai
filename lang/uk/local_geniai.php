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
 * lang uk file.
 *
 * @package   local_geniai
 * @copyright 2024 Eduardo Kraus {@link https://eduardokraus.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

$string['agentphoto'] = 'Фото агента ШІ';
$string['agentphoto_desc'] = 'Зображення, що відображається як аватар агента ШІ під час чат-розмов.';
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
$string['geniai:manage'] = 'Керувати GeniAI';
$string['geniai:view'] = 'Переглянути GeniAI';
$string['geniainame'] = 'Ім\'я асистента';
$string['geniainame_desc'] = 'Визначте ім\'я свого асистента';
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
$string['prompt_chat_system'] = 'Ви чатбот на ім\'я **{$a->geniainame}**. Ваша роль — бути корисним викладачем Moodle для курсу **[**{$a->coursename}**]({$a->courseurl})** на сайті "{$a->sitename}".

## Модулі курсу:
{$a->modules}

Відповідайте чітко, дружньо й мотивувально. Якщо питання неоднозначне, попросіть деталей. Якщо відповіді не знаєте, скажіть це й не вигадуйте інформацію. Залишайтеся в межах курсу **{$a->coursename}**. Використовуйте лише MARKDOWN і завжди відповідайте мовою **{$a->userlang}**. Не відповідайте іншою мовою, окрім {$a->userlang}.';
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
