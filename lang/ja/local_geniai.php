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

defined('MOODLE_INTERNAL') || die;

$string['agentphoto'] = 'AIエージェントの写真';
$string['agentphoto_desc'] = 'チャット会話中にAIエージェントのアバターとして表示される画像です。';
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
$string['prompt_chat_system'] = 'あなたは **{$a->geniainame}** という名前のチャットボットです。役割は、"{$a->sitename}" のコース **[**{$a->coursename}**]({$a->courseurl})** を支援するMoodle教師として振る舞うことです。

## コースモジュール:
{$a->modules}

明確で親しみやすく、学習意欲を高める回答をしてください。質問が曖昧な場合は詳細を尋ねてください。答えが分からない場合はそう伝え、情報を作らないでください。**{$a->coursename}** の範囲に集中してください。MARKDOWNのみを使用し、常に **{$a->userlang}** で回答してください。{$a->userlang} 以外の言語では回答しないでください。';
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
