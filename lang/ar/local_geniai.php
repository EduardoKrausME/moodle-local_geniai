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
 * lang ar file.
 *
 * @package   local_geniai
 * @copyright 2024 Eduardo Kraus {@link https://eduardokraus.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

$string['agentphoto'] = 'صورة وكيل الذكاء الاصطناعي';
$string['agentphoto_desc'] = 'الصورة المعروضة كصورة رمزية لوكيل الذكاء الاصطناعي أثناء محادثات الدردشة.';
$string['analysis_ai_block'] = 'تحليل الذكاء الاصطناعي';
$string['analysis_bloom_analyze'] = 'تحليل';
$string['analysis_bloom_apply'] = 'تطبيق';
$string['analysis_bloom_create'] = 'إنشاء';
$string['analysis_bloom_evaluate'] = 'تقييم';
$string['analysis_bloom_remember'] = 'تذكّر';
$string['analysis_bloom_understand'] = 'فهم';
$string['analysis_cached'] = 'تحليل مخزن مؤقتًا';
$string['analysis_close'] = 'إغلاق';
$string['analysis_error'] = 'تعذر تحليل هذا النشاط.';
$string['analysis_excluded_plugins'] = 'الوحدات المستبعدة من تحليل الأنشطة';
$string['analysis_excluded_plugins_desc'] = 'لن تعرض الوحدات المحددة أزرار التحليل، وسيتم استبعادها من تحليل المقرر.';
$string['analysis_force_new'] = 'تشغيل تحليل جديد';
$string['analysis_history'] = 'سجل التحليلات';
$string['analysis_last'] = 'آخر تحليل';
$string['analysis_latest'] = 'أحدث تحليل';
$string['analysis_model_warning'] = 'استخدم هذا التحليل نموذج mini/nano. لتحليل أفضل، اضبط <a href="{$a}/admin/settings.php?section=local_geniai" target="_blank">نموذج API</a> بدون mini أو nano.';
$string['analysis_no_content'] = 'لم يتم إرجاع أي محتوى تحليل.';
$string['analysis_not_supported'] = 'هذا النوع من الأنشطة غير متاح للتحليل باستخدام GeniAI.';
$string['analysis_print'] = 'طباعة';
$string['analysis_print_analysis'] = 'طباعة تحليل';
$string['analysis_print_popup_blocked'] = 'حظر المتصفح تبويب الطباعة. اسمح بالنوافذ المنبثقة وحاول مرة أخرى.';
$string['analysis_reanalyze'] = 'تحليل مرة أخرى';
$string['analysis_recommendations'] = 'توصيات';
$string['analysis_result'] = 'تحليل النشاط';
$string['analysis_status_insufficient'] = 'غير كافٍ';
$string['analysis_status_needs_review'] = 'يحتاج إلى مراجعة';
$string['analysis_status_ok'] = 'OK';
$string['analysis_status_ok_minor'] = 'جيد مع تعديلات بسيطة';
$string['analyze_activity'] = 'تحليل بالذكاء الاصطناعي';
$string['analyze_course'] = 'تحليل مقرر بالذكاء الاصطناعي';
$string['analyzing_activity'] = 'يتم تحليل الإملاء والاتساق التربوي وتصنيف بلوم...';
$string['analyzing_course'] = 'يتم تحليل أنشطة المقرر...';
$string['apikey'] = 'OpenAI API Key';
$string['apikey_desc'] = 'مفتاح API لحسابك في OpenAI';
$string['case'] = 'حالات الاستخدام';
$string['caseuse_balanced'] = 'استجابات متوازنة => Temperature 0.5 - 0.7, Top_p 0.7';
$string['caseuse_chatbot'] = 'Chatbot => Temperature 0.2 - 0.6, Top_p 0.8';
$string['caseuse_creative'] = 'توليد إبداعي => Temperature 0.7 - 1.0, Top_p 0.8';
$string['caseuse_exploration'] = 'استكشاف الخيارات => Temperature 0.8 - 1.0, Top_p 0.9';
$string['caseuse_formal'] = 'نبرة رسمية => Temperature 0.3 - 0.5, Top_p 0.6';
$string['caseuse_informal'] = 'نبرة غير رسمية => Temperature 0.7 - 0.9, Top_p 0.8';
$string['caseuse_precise'] = 'استجابات دقيقة => Temperature 0.0 - 0.3, Top_p 1.0';
$string['clear_history_title'] = 'مسح كل السجل';
$string['close_title'] = 'إغلاق الدردشة';
$string['frequency_penalty'] = 'عقوبة التكرار';
$string['frequency_penalty_desc'] = 'يُستخدم هذا المعامل لتقليل تكرار الكلمات أو العبارات نفسها كثيرًا في النص الناتج. كلما زادت القيمة أصبح النموذج أكثر تحفظًا تجاه التكرار.';
$string['geniai:analyzeactivity'] = 'تحليل أنشطة Moodle باستخدام GeniAI';
$string['geniai:manage'] = 'إدارة GeniAI';
$string['geniai:view'] = 'عرض GeniAI';
$string['geniainame'] = 'اسم المساعد';
$string['geniainame_desc'] = 'حدد اسم مساعدك';
$string['h5p-accordion-desc'] = 'أنشئ مسرد من محتواك لمساعدة الطلاب على التعلم بطريقة أكثر تفاعلية ووضوحًا وجاذبية.';
$string['h5p-accordion-title'] = 'مسرد';
$string['h5p-advancedtext-desc'] = 'أنشئ كتاب رقمي من محتواك لمساعدة الطلاب على التعلم بطريقة أكثر تفاعلية ووضوحًا وجاذبية.';
$string['h5p-advancedtext-title'] = 'كتاب رقمي';
$string['h5p-block-title'] = 'عنوان الكتلة';
$string['h5p-create'] = 'إنشاء H5P باستخدام GeniAI';
$string['h5p-create-new'] = 'إنشاء H5P جديد باستخدام GeniAI';
$string['h5p-create-this'] = 'إنشاء باستخدام هذا المورد';
$string['h5p-create-title'] = 'عنوان H5P';
$string['h5p-create-title-desc'] = 'حدد العنوان الرئيسي لمحتوى H5P الذي سيظهر للمستخدمين في الواجهة.';
$string['h5p-createpage-title'] = 'إنشاء {$a} جديد';
$string['h5p-crossword-desc'] = 'أنشئ كلمات متقاطعة من محتواك لمساعدة الطلاب على التعلم بطريقة أكثر تفاعلية ووضوحًا وجاذبية.';
$string['h5p-crossword-title'] = 'كلمات متقاطعة';
$string['h5p-delete-success'] = 'تم حذف H5P بنجاح!';
$string['h5p-dialogcards-desc'] = 'أنشئ بطاقات تعليمية من محتواك لمساعدة الطلاب على التعلم بطريقة أكثر تفاعلية ووضوحًا وجاذبية.';
$string['h5p-dialogcards-title'] = 'بطاقات تعليمية';
$string['h5p-dragtext-desc'] = 'أنشئ لعبة سحب الكلمات من محتواك لمساعدة الطلاب على التعلم بطريقة أكثر تفاعلية ووضوحًا وجاذبية.';
$string['h5p-dragtext-title'] = 'لعبة سحب الكلمات';
$string['h5p-example'] = 'عرض مثال';
$string['h5p-findthewords-desc'] = 'أنشئ البحث عن الكلمات من محتواك لمساعدة الطلاب على التعلم بطريقة أكثر تفاعلية ووضوحًا وجاذبية.';
$string['h5p-findthewords-title'] = 'البحث عن الكلمات';
$string['h5p-interactivebook-desc'] = 'أنشئ كتاب تفاعلي من محتواك لمساعدة الطلاب على التعلم بطريقة أكثر تفاعلية ووضوحًا وجاذبية.';
$string['h5p-interactivebook-title'] = 'كتاب تفاعلي';
$string['h5p-interactivevideo-desc'] = 'أنشئ فيديو تفاعلي من محتواك لمساعدة الطلاب على التعلم بطريقة أكثر تفاعلية ووضوحًا وجاذبية.';
$string['h5p-interactivevideo-title'] = 'فيديو تفاعلي';
$string['h5p-manager'] = 'إدارة H5P باستخدام GeniAI';
$string['h5p-manager-scorm'] = 'إدارة SCORM باستخدام GeniAI';
$string['h5p-next-step'] = 'الخطوة التالية';
$string['h5p-no-apikey'] = '<p>يلزم إعداد مفتاح API الخاص بـ ChatGPT لكي يعمل نظام إنشاء الحسابات بشكل صحيح.<p><p><a href="{$a}">انقر هنا لإعداد مفتاح API الخاص بـ ChatGPT.</a></p>';
$string['h5p-page-title'] = 'إنشاء H5P باستخدام GeniAI';
$string['h5p-questionset-desc'] = 'أنشئ اختبارات من محتواك لمساعدة الطلاب على التعلم بطريقة أكثر تفاعلية ووضوحًا وجاذبية.';
$string['h5p-questionset-title'] = 'اختبارات';
$string['h5p-readmore'] = '...المزيد';
$string['h5p-return'] = 'العودة إلى بنك المحتوى';
$string['h5p-title'] = 'إدارة بنك محتوى GeniAI';
$string['message_01'] = 'مرحبًا، {$a}! 🌟';
$string['message_02'] = 'مرحبًا بك في المقرر {$a->coursename} على Moodle {$a->moodlename}!
أنا {$a->geniainame}، وأنا هنا لجعل رحلة تعلمك رائعة قدر الإمكان.
كيف يمكنني مساعدتك اليوم؟ 🌟📚';
$string['mode'] = 'وضع الاستخدام';
$string['mode_desc'] = 'حدد وضع استخدام الفقاعة الذي تريده';
$string['mode_name_geniai'] = 'مدرّس GeniAI';
$string['mode_name_none'] = 'لا توجد فقاعة دردشة';
$string['model'] = 'نموذج API';
$string['model_desc'] = 'نموذج API الذي سيتم تشغيله في OpenAI. القيم المتاحة موجودة في <a href="https://platform.openai.com/docs/models/overview" target="_blank">موقع OpenAI</a><br>
<strong>مهم:</strong> إذا استخدمت نموذج ChatGPT يحتوي على <strong>mini</strong> أو <strong>nano</strong>، فاعرض رسالة توصي بنموذج API بدون mini أو nano لتحليل أفضل.';
$string['modulename'] = 'GeniAI';
$string['modules'] = 'الوحدات التي سيتم إخفاؤها عن {$a}';
$string['modules_desc'] = 'تحتوي هذه القائمة على الوحدات التي لا ينبغي إتاحتها للطلاب، لضمان عدم استخدامها في التمارين.';
$string['online'] = 'متصل';
$string['pluginname'] = 'GeniAI';
$string['presence_penalty'] = 'عقوبة الحضور';
$string['presence_penalty_desc'] = 'يُستخدم هذا المعامل لتشجيع النموذج على إدراج تنوع أكبر من الرموز في النص الناتج. كلما زادت القيمة زادت احتمالية ظهور رموز جديدة.';
$string['privacy:metadata'] = 'يحتفظ ملحق GeniAI بسجل المحادثة المؤقت في الجلسة الحالية، ويخزن فقط بيانات استخدام تشغيلية دون حفظ محتوى الرسائل أو البيانات الشخصية في تقاريره المحلية.';
$string['prompt_activity_focus_alignment'] = 'أعط الأولوية للاتساق بين المقرر والقسم والعنوان ومحتوى النشاط.';
$string['prompt_activity_focus_bloom'] = 'أعط الأولوية لتصنيف بلوم والعمق المعرفي للمقترح.';
$string['prompt_activity_focus_full'] = 'تحليل كامل للنشاط.';
$string['prompt_activity_focus_pedagogy'] = 'أعط الأولوية للملاءمة التربوية وتعليمات الطالب وجودة التعلم.';
$string['prompt_activity_focus_spelling'] = 'أعط الأولوية للإملاء والقواعد والوضوح والنبرة التعليمية.';
$string['prompt_activity_schema_bloom_level'] = 'remember | understand | apply | analyze | evaluate | create';
$string['prompt_activity_schema_diagnosis'] = 'ملخص قصير للتشخيص العام.';
$string['prompt_activity_schema_recommendation_1'] = 'إجراء عملي 1.';
$string['prompt_activity_schema_recommendation_2'] = 'إجراء عملي 2.';
$string['prompt_activity_schema_status'] = 'OK | OK with minor adjustments | Needs review | Inadequate or insufficient';
$string['prompt_activity_schema_status_key'] = 'ok | ok_minor | needs_review | insufficient';
$string['prompt_activity_system'] = 'أنت خبير في التصميم التعليمي ومراجعة النصوص وMoodle. حلّل نشاط Moodle موجودًا بلغة المستخدم الحالية في Moodle: {$a->lang}. أبقِ حقول JSON التقنية وقيم enum باللغة الإنجليزية تمامًا. لا تخترع معلومات، وإذا كان المحتوى غير كافٍ فاذكر ذلك بوضوح.

معايير التحليل الإلزامية: الإملاء والوضوح، الاتساق بين العنوان والقسم والمحتوى، تصنيف بلوم باستخدام قيمة واحدة من remember, understand, apply, analyze, evaluate, create، الملاءمة التربوية، واقتراحات عملية.

التركيز الإضافي: {$a->focus}

في النهاية أضف كتلة تقنية تحتوي على JSON صالح بين ```json و ```. الحقول المطلوبة: status_key, status, bloom_level, diagnosis, recommendations. نوع التحليل المطلوب: {$a->analysis}';
$string['prompt_activity_user'] = 'حلّل نشاط Moodle أدناه.

{$a}';
$string['prompt_chat_system'] = 'أنت روبوت دردشة اسمه **{$a->geniainame}**. دورك هو العمل كمدرس Moodle مساعد ومخلص للمقرر **[**{$a->coursename}**]({$a->courseurl})** في "{$a->sitename}".

## وحدات المقرر:
{$a->modules}

أجب بوضوح وود وتحفيز. إذا كان السؤال غامضًا، اطلب تفاصيل إضافية. إذا كنت لا تعرف الإجابة، قل ذلك ولا تخترع معلومات. حافظ على التركيز على المقرر **{$a->coursename}**. استخدم MARKDOWN فقط وأجب دائمًا باللغة **{$a->userlang}**.';
$string['prompt_json_block_instruction'] = '

أرجع أيضًا كتلة تقنية نهائية تحتوي على JSON صالح بين ```json و ```.';
$string['prompt_json_block_schema'] = '
استخدم هذا التنسيق المرجعي:
{$a}';
$string['prompt_json_style'] = '
النمط:
- تجنب القوائم؛ استخدمها فقط عند الضرورة؛
- استخدم `:` فقط عندما يكون ذلك ضروريًا حقًا؛ وفضّل الجمل الكاملة؛
- لا تضف خاتمة أو ملخصًا نهائيًا؛
- احرص على ألا يبدو النص مولدًا بالذكاء الاصطناعي.';
$string['report_completion_tokens'] = 'عدد الرموز المستلمة';
$string['report_datecreated'] = 'اليوم';
$string['report_download'] = 'تنزيل استخدام GPT';
$string['report_filename'] = 'تقرير استخدام مساعدة GPT';
$string['report_info'] = '<p>في التقرير المعروض، تتوفر أول 100 سطر فقط. للوصول إلى جميع السجلات، يرجى تنزيل المستند الكامل.</p><p>يرتبط الرمز الواحد تقريبًا بـ 4 أحرف من النص الإنجليزي الشائع. تعرّف على المزيد في صفحة <a href="https://platform.openai.com/tokenizer" target="_blank">Language Model Tokenization</a>.</p>';
$string['report_list'] = 'قائمة الملفات الصوتية';
$string['report_model'] = 'نموذج ChatGPT';
$string['report_prompt_tokens'] = 'عدد الرموز المرسلة';
$string['report_title'] = 'تقرير';
$string['send_message'] = 'إرسال رسالة';
$string['settings'] = 'تهيئة GeniAI';
$string['settings_casedesc'] = 'تُحدد معاملات Temperature و Top_p لكل سيناريو، مثل إنشاء النصوص والأكواد، والكتابة الإبداعية، والروبوتات الحوارية، والتعليقات النصية، وتحليل البيانات، والكتابة الاستكشافية.<br><br>استخدم الجدول أدناه كدليل لاستخدام Temperature و Top_p:<br>';
$string['settings_casedesc_balancedresp'] = 'استجابات متوازنة';
$string['settings_casedesc_balancedresp_desc'] = 'استجابات متوازنة.';
$string['settings_casedesc_caseuse'] = 'حالات الاستخدام';
$string['settings_casedesc_chatbot'] = 'Chatbot';
$string['settings_casedesc_chatbot_desc'] = 'استجابات سريعة ومتسقة وسياقية للتفاعل الفوري مع المستخدمين.';
$string['settings_casedesc_creativegen'] = 'توليد إبداعي';
$string['settings_casedesc_creativegen_desc'] = 'ينتج استجابات أكثر إبداعًا أو أصالة أو استكشافًا. مفيد للعصف الذهني أو السرد القصصي.';
$string['settings_casedesc_description'] = 'الوصف';
$string['settings_casedesc_formaltones'] = 'نبرة رسمية';
$string['settings_casedesc_formaltones_desc'] = 'ينشئ نصوصًا أكثر رسمية أو تقنية مع تنوع إبداعي أقل.';
$string['settings_casedesc_optionexplore'] = 'استكشاف الخيارات';
$string['settings_casedesc_optionexplore_desc'] = 'ينشئ عدة استجابات بديلة للنظر في طرق مختلفة للإجابة عن سؤال.';
$string['settings_casedesc_preciseresp'] = 'استجابات دقيقة';
$string['settings_casedesc_preciseresp_desc'] = 'أقصى قدر من الدقة وإمكانية التنبؤ. موصى به للمهام التقنية أو المعلوماتية.';
$string['settings_casedesc_relaxedtones'] = 'نبرات مريحة';
$string['settings_casedesc_relaxedtones_desc'] = 'ينشئ نصوصًا أخف وغير رسمية بأسلوب إبداعي وودود.';
$string['settings_casedesc_temperature'] = 'Temperature';
$string['settings_casedesc_top_p'] = 'Top_p';
$string['talk_geniai'] = 'تحدث إلى {$a} هنا';
$string['write_message'] = 'اكتب رسالة...';
