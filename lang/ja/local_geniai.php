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
 * lang ja file.
 *
 * @package   local_geniai
 * @copyright 2024 Eduardo Kraus {@link https://eduardokraus.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

$string['agentphoto'] = 'AIエージェントの写真';
$string['agentphoto_desc'] = 'チャット会話中にAIエージェントのアバターとして表示される画像です。';
$string['analysis_ai_block'] = 'AI分析';
$string['analysis_bloom_analyze'] = '分析';
$string['analysis_bloom_apply'] = '適用';
$string['analysis_bloom_create'] = '作成';
$string['analysis_bloom_evaluate'] = '評価';
$string['analysis_bloom_remember'] = '記憶';
$string['analysis_bloom_understand'] = '理解';
$string['analysis_cached'] = 'キャッシュされた分析';
$string['analysis_close'] = '閉じる';
$string['analysis_error'] = 'この活動を分析できませんでした。';
$string['analysis_force_new'] = '新しい分析を実行';
$string['analysis_history'] = '分析履歴';
$string['analysis_last'] = '最新の分析';
$string['analysis_latest'] = '最新の分析';
$string['analysis_model_warning'] = 'この分析では mini/nano モデルが使用されました。より良い分析のため、mini または nano を含まない <a href="{$a}/admin/settings.php?section=local_geniai" target="_blank">APIモデル</a> を設定してください。';
$string['analysis_no_content'] = '分析内容は返されませんでした。';
$string['analysis_print'] = '印刷';
$string['analysis_print_analysis'] = '印刷 分析';
$string['analysis_print_popup_blocked'] = 'ブラウザが印刷タブをブロックしました。ポップアップを許可してもう一度お試しください。';
$string['analysis_reanalyze'] = '再分析';
$string['analysis_recommendations'] = '推奨事項';
$string['analysis_result'] = '活動分析';
$string['analysis_status_insufficient'] = '不十分';
$string['analysis_status_needs_review'] = '確認が必要';
$string['analysis_status_ok'] = 'OK';
$string['analysis_status_ok_minor'] = '軽微な調整でOK';
$string['analyze_activity'] = '分析 AIで';
$string['analyze_course'] = '分析 コース AIで';
$string['analyzing_activity'] = 'スペル、教育的な一貫性、ブルーム分類を分析しています...';
$string['analyzing_course'] = 'コース活動を分析しています...';
$string['apikey'] = 'OpenAI API Key';
$string['apikey_desc'] = 'OpenAIアカウントのAPIキー';
$string['case'] = '利用例';
$string['caseuse_balanced'] = 'バランスの取れた応答 => Temperature 0.5 - 0.7, Top_p 0.7';
$string['caseuse_chatbot'] = 'Chatbot => Temperature 0.2 - 0.6, Top_p 0.8';
$string['caseuse_creative'] = '創造的生成 => Temperature 0.7 - 1.0, Top_p 0.8';
$string['caseuse_exploration'] = '選択肢の探索 => Temperature 0.8 - 1.0, Top_p 0.9';
$string['caseuse_formal'] = 'フォーマルなトーン => Temperature 0.3 - 0.5, Top_p 0.6';
$string['caseuse_informal'] = 'インフォーマルなトーン => Temperature 0.7 - 0.9, Top_p 0.8';
$string['caseuse_precise'] = '正確な応答 => Temperature 0.0 - 0.3, Top_p 1.0';
$string['clear_history_title'] = 'すべての履歴を消去';
$string['close_title'] = 'チャットを閉じる';
$string['frequency_penalty'] = '頻度ペナルティ';
$string['frequency_penalty_desc'] = 'このパラメータは、生成されたテキストで同じ単語やフレーズが頻繁に繰り返されることを抑えるために使用されます。値が高いほど、モデルは繰り返しに対してより慎重になります。';
$string['geniai:analyzeactivity'] = 'GeniAIでMoodle活動を分析';
$string['geniai:manage'] = '管理 GeniAI';
$string['geniai:view'] = '表示 GeniAI';
$string['geniainame'] = 'アシスタント名';
$string['geniainame_desc'] = 'アシスタントの名前を定義します';
$string['h5p-accordion-desc'] = 'あなたのコンテンツから用語集を作成し、学生がよりインタラクティブで分かりやすく学べるようにします。';
$string['h5p-accordion-title'] = '用語集';
$string['h5p-advancedtext-desc'] = 'あなたのコンテンツからデジタルブックを作成し、学生がよりインタラクティブで分かりやすく学べるようにします。';
$string['h5p-advancedtext-title'] = 'デジタルブック';
$string['h5p-block-title'] = 'ブロックタイトル';
$string['h5p-create'] = 'GeniAIでH5Pを作成';
$string['h5p-create-new'] = 'GeniAIで新しいH5Pを作成';
$string['h5p-create-this'] = 'このリソースで作成';
$string['h5p-create-title'] = 'H5Pタイトル';
$string['h5p-create-title-desc'] = 'インターフェースでユーザーに表示されるH5Pコンテンツのメインタイトルを定義します。';
$string['h5p-createpage-title'] = '新しい{$a}を作成';
$string['h5p-crossword-desc'] = 'あなたのコンテンツからクロスワードパズルを作成し、学生がよりインタラクティブで分かりやすく学べるようにします。';
$string['h5p-crossword-title'] = 'クロスワードパズル';
$string['h5p-delete-success'] = 'H5Pを正常に削除しました！';
$string['h5p-dialogcards-desc'] = 'あなたのコンテンツからフラッシュカードを作成し、学生がよりインタラクティブで分かりやすく学べるようにします。';
$string['h5p-dialogcards-title'] = 'フラッシュカード';
$string['h5p-dragtext-desc'] = 'あなたのコンテンツから単語ドラッグゲームを作成し、学生がよりインタラクティブで分かりやすく学べるようにします。';
$string['h5p-dragtext-title'] = '単語ドラッグゲーム';
$string['h5p-example'] = '例を見る';
$string['h5p-findthewords-desc'] = 'あなたのコンテンツから単語検索ゲームを作成し、学生がよりインタラクティブで分かりやすく学べるようにします。';
$string['h5p-findthewords-title'] = '単語検索ゲーム';
$string['h5p-interactivebook-desc'] = 'あなたのコンテンツからインタラクティブブックを作成し、学生がよりインタラクティブで分かりやすく学べるようにします。';
$string['h5p-interactivebook-title'] = 'インタラクティブブック';
$string['h5p-interactivevideo-desc'] = 'あなたのコンテンツからインタラクティブ動画を作成し、学生がよりインタラクティブで分かりやすく学べるようにします。';
$string['h5p-interactivevideo-title'] = 'インタラクティブ動画';
$string['h5p-manager'] = 'GeniAIでH5Pを管理';
$string['h5p-manager-scorm'] = 'GeniAIでSCORMを管理';
$string['h5p-next-step'] = '次のステップ';
$string['h5p-no-apikey'] = '<p>アカウント作成システムを正しく動作させるには、ChatGPT APIキーの設定が必要です。<p><p><a href="{$a}">ChatGPT APIキーを設定するにはここをクリックしてください。</a></p>';
$string['h5p-page-title'] = 'GeniAIでH5Pを作成';
$string['h5p-questionset-desc'] = 'あなたのコンテンツからクイズを作成し、学生がよりインタラクティブで分かりやすく学べるようにします。';
$string['h5p-questionset-title'] = 'クイズ';
$string['h5p-readmore'] = '...もっと見る';
$string['h5p-return'] = 'コンテンツバンクへ戻る';
$string['h5p-title'] = 'GeniAIコンテンツバンクを管理';
$string['message_01'] = 'こんにちは、{$a}！🌟';
$string['message_02'] = 'Moodle {$a->moodlename} のコース {$a->coursename} へようこそ！
私は {$a->geniainame} です。あなたの学習体験をできるだけ素晴らしいものにするためにここにいます。
今日はどのようにお手伝いできますか？🌟📚';
$string['mode'] = '使用モード';
$string['mode_desc'] = '吹き出しの使用モードを定義します';
$string['mode_name_geniai'] = 'GeniAIチューター';
$string['mode_name_none'] = 'チャット吹き出しなし';
$string['model'] = 'APIモデル';
$string['model_desc'] = 'OpenAIで実行されるAPIモデルです。利用可能な値は <a href="https://platform.openai.com/docs/models/overview" target="_blank">OpenAIサイト</a> で確認できます。<br>
<strong>重要:</strong> <strong>mini</strong> または <strong>nano</strong> を含むChatGPTモデルを使用する場合、より良い分析のためにminiまたはnanoを含まないAPIモデルを推奨するメッセージを表示してください。';
$string['modulename'] = 'GeniAI';
$string['modules'] = '{$a} から非表示にするモジュール';
$string['modules_desc'] = 'この一覧には、学生が演習で使用しないように利用不可にするモジュールが含まれています。';
$string['online'] = 'オンライン';
$string['pluginname'] = 'GeniAI';
$string['presence_penalty'] = '存在ペナルティ';
$string['presence_penalty_desc'] = 'このパラメータは、生成されたテキストにより多様なトークンを含めるようモデルを促します。値が高いほど、新しいトークンが生成されやすくなります。';
$string['privacy:metadata'] = 'GeniAIプラグインは現在のセッションに一時的な会話履歴を保持し、メッセージ本文や個人データをローカルレポートに保存せず、運用上の使用メタデータのみを保存します。';
$string['prompt_activity_focus_alignment'] = 'コース、セクション、タイトル、活動内容の一貫性を優先してください。';
$string['prompt_activity_focus_bloom'] = 'ブルーム分類と提案の認知的な深さを優先してください。';
$string['prompt_activity_focus_full'] = '活動の完全な分析。';
$string['prompt_activity_focus_pedagogy'] = '教育的妥当性、学生への指示、学習品質を優先してください。';
$string['prompt_activity_focus_spelling'] = 'スペル、文法、明確さ、指示的なトーンを優先してください。';
$string['prompt_activity_schema_bloom_level'] = 'remember | understand | apply | analyze | evaluate | create';
$string['prompt_activity_schema_diagnosis'] = '一般診断の短い要約。';
$string['prompt_activity_schema_recommendation_1'] = '実践的な対応 1。';
$string['prompt_activity_schema_recommendation_2'] = '実践的な対応 2。';
$string['prompt_activity_schema_status'] = 'OK | OK with minor adjustments | Needs review | Inadequate or insufficient';
$string['prompt_activity_schema_status_key'] = 'ok | ok_minor | needs_review | insufficient';
$string['prompt_activity_system'] = 'あなたはインストラクショナルデザイン、文章レビュー、Moodleの専門家です。ユーザーの現在のMoodle言語 {$a->lang} で既存のMoodle活動を分析してください。技術的なJSONフィールドとenum値は正確に英語のままにしてください。情報を作らず、内容が不十分な場合は明確に述べてください。

必須基準: スペルと明確さ、タイトル・セクション・内容の一貫性、remember, understand, apply, analyze, evaluate, create のいずれか1つを使ったブルーム分類、教育的妥当性、実践的な改善提案。

追加フォーカス: {$a->focus}

最後に ```json と ``` の間に有効なJSONの技術ブロックを追加してください。必須フィールド: status_key, status, bloom_level, diagnosis, recommendations。要求された分析タイプ: {$a->analysis}';
$string['prompt_activity_user'] = '以下のMoodle活動を分析してください。

{$a}';
$string['prompt_chat_system'] = 'あなたは **{$a->geniainame}** という名前のチャットボットです。役割は、"{$a->sitename}" のコース **[**{$a->coursename}**]({$a->courseurl})** を支援するMoodle教師として振る舞うことです。

## コースモジュール:
{$a->modules}

明確で親しみやすく、学習意欲を高める回答をしてください。質問が曖昧な場合は詳細を尋ねてください。答えが分からない場合はそう伝え、情報を作らないでください。**{$a->coursename}** の範囲に集中してください。MARKDOWNのみを使用し、常に **{$a->userlang}** で回答してください。';
$string['prompt_json_block_instruction'] = '

最後に、有効なJSONを ```json と ``` の間に入れた技術ブロックも返してください。';
$string['prompt_json_block_schema'] = '
この参照形式を使用してください:
{$a}';
$string['prompt_json_style'] = '
スタイル:
- リストは避け、必要な場合のみ使用してください;
- `:` は本当に必要な場合だけ使用し、完全な文で書き直すことを優先してください;
- 結論や最終的な要約を追加しないでください;
- AI生成文のように聞こえないよう注意してください。';
$string['report_completion_tokens'] = '受信したトークン数';
$string['report_datecreated'] = '日';
$string['report_download'] = 'GPT使用状況をダウンロード';
$string['report_filename'] = 'GPT支援使用レポート';
$string['report_info'] = '<p>表示されたレポートでは最初の100行のみ利用できます。すべての記録にアクセスするには、完全なドキュメントをダウンロードしてください。</p><p>1トークンは一般的な英語テキスト約4文字に相当します。詳しくは <a href="https://platform.openai.com/tokenizer" target="_blank">Language Model Tokenization</a> ページをご覧ください。</p>';
$string['report_list'] = '音声一覧';
$string['report_model'] = 'ChatGPTモデル';
$string['report_prompt_tokens'] = '送信したトークン数';
$string['report_title'] = 'レポート';
$string['send_message'] = 'メッセージを送信';
$string['settings'] = 'GeniAIを設定';
$string['settings_casedesc'] = 'Temperature と Top_p パラメータは、テキストやコード生成、創造的文章、チャットボット、テキストコメント生成、データ分析、探索的文章などのシナリオごとに設定されます。<br><br>Temperature と Top_p の使用については、下の表を参考にしてください:<br>';
$string['settings_casedesc_balancedresp'] = 'バランスの取れた応答';
$string['settings_casedesc_balancedresp_desc'] = 'バランスの取れた応答.';
$string['settings_casedesc_caseuse'] = '利用例';
$string['settings_casedesc_chatbot'] = 'Chatbot';
$string['settings_casedesc_chatbot_desc'] = 'ユーザーとのリアルタイム対話に向けた高速で一貫性があり文脈に沿った応答。';
$string['settings_casedesc_creativegen'] = '創造的生成';
$string['settings_casedesc_creativegen_desc'] = 'より創造的、独創的、または探索的な応答を生成します。ブレインストーミングやストーリーテリングに役立ちます。';
$string['settings_casedesc_description'] = '説明';
$string['settings_casedesc_formaltones'] = 'フォーマルなトーン';
$string['settings_casedesc_formaltones_desc'] = '創造的なばらつきを抑えた、よりフォーマルまたは技術的な文章を作成します。';
$string['settings_casedesc_optionexplore'] = '選択肢の探索';
$string['settings_casedesc_optionexplore_desc'] = '質問に対する異なるアプローチを検討できるよう、複数の代替応答を生成します。';
$string['settings_casedesc_preciseresp'] = '正確な応答';
$string['settings_casedesc_preciseresp_desc'] = '最大限の正確性と予測可能性。技術的または情報提供型のタスクに推奨されます。';
$string['settings_casedesc_relaxedtones'] = 'リラックスしたトーン';
$string['settings_casedesc_relaxedtones_desc'] = '創造的で親しみやすいアプローチの軽くインフォーマルな文章を生成します。';
$string['settings_casedesc_temperature'] = 'Temperature';
$string['settings_casedesc_top_p'] = 'Top_p';
$string['talk_geniai'] = 'ここで {$a} と話す';
$string['write_message'] = 'メッセージを書く...';
