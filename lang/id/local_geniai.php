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
 * lang id file.
 *
 * @package   local_geniai
 * @copyright 2024 Eduardo Kraus {@link https://eduardokraus.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

$string['agentphoto'] = 'Foto agen AI';
$string['agentphoto_desc'] = 'Gambar yang ditampilkan sebagai avatar agen AI selama percakapan chat.';
$string['analysis_ai_block'] = 'Analisis AI';
$string['analysis_bloom_analyze'] = 'Analisis';
$string['analysis_bloom_apply'] = 'Terapkan';
$string['analysis_bloom_create'] = 'Buat';
$string['analysis_bloom_evaluate'] = 'Evaluasi';
$string['analysis_bloom_remember'] = 'Ingat';
$string['analysis_bloom_understand'] = 'Pahami';
$string['analysis_cached'] = 'Analisis tersimpan cache';
$string['analysis_close'] = 'Tutup';
$string['analysis_error'] = 'Aktivitas ini tidak dapat dianalisis.';
$string['analysis_excluded_plugins'] = 'Modul yang dikecualikan dari analisis aktivitas';
$string['analysis_excluded_plugins_desc'] = 'Modul yang dipilih tidak akan menampilkan tombol analisis dan akan dikecualikan dari analisis kursus.';
$string['analysis_force_new'] = 'Jalankan analisis baru';
$string['analysis_history'] = 'Riwayat analisis';
$string['analysis_last'] = 'Analisis terakhir';
$string['analysis_latest'] = 'Analisis terbaru';
$string['analysis_model_warning'] = 'Analisis ini menggunakan model mini/nano. Untuk analisis yang lebih baik, konfigurasikan <a href="{$a}/admin/settings.php?section=local_geniai" target="_blank">Model API</a> tanpa mini atau nano.';
$string['analysis_no_content'] = 'Tidak ada konten analisis yang dikembalikan.';
$string['analysis_not_supported'] = 'Jenis aktivitas ini tidak tersedia untuk analisis dengan GeniAI.';
$string['analysis_print'] = 'Cetak';
$string['analysis_print_analysis'] = 'Cetak analisis';
$string['analysis_print_popup_blocked'] = 'Browser memblokir tab cetak. Izinkan pop-up dan coba lagi.';
$string['analysis_reanalyze'] = 'Analisis lagi';
$string['analysis_recommendations'] = 'Rekomendasi';
$string['analysis_result'] = 'Analisis aktivitas';
$string['analysis_status_insufficient'] = 'Tidak mencukupi';
$string['analysis_status_needs_review'] = 'Perlu ditinjau';
$string['analysis_status_ok'] = 'OK';
$string['analysis_status_ok_minor'] = 'OK dengan penyesuaian kecil';
$string['analyze_activity'] = 'Analisis dengan AI';
$string['analyze_course'] = 'Analisis kursus dengan AI';
$string['analyzing_activity'] = 'Menganalisis ejaan, koherensi pedagogis, dan taksonomi Bloom...';
$string['analyzing_course'] = 'Menganalisis aktivitas kursus...';
$string['apikey'] = 'OpenAI API Key';
$string['apikey_desc'] = 'Kunci API akun OpenAI Anda';
$string['case'] = 'Kasus penggunaan';
$string['caseuse_balanced'] = 'Respons seimbang => Temperature 0.5 - 0.7, Top_p 0.7';
$string['caseuse_chatbot'] = 'Chatbot => Temperature 0.2 - 0.6, Top_p 0.8';
$string['caseuse_creative'] = 'Generasi kreatif => Temperature 0.7 - 1.0, Top_p 0.8';
$string['caseuse_exploration'] = 'Eksplorasi opsi => Temperature 0.8 - 1.0, Top_p 0.9';
$string['caseuse_formal'] = 'Nada formal => Temperature 0.3 - 0.5, Top_p 0.6';
$string['caseuse_informal'] = 'Nada informal => Temperature 0.7 - 0.9, Top_p 0.8';
$string['caseuse_precise'] = 'Respons tepat => Temperature 0.0 - 0.3, Top_p 1.0';
$string['clear_history_title'] = 'Hapus semua riwayat';
$string['close_title'] = 'Tutup chat';
$string['frequency_penalty'] = 'Penalti frekuensi';
$string['frequency_penalty_desc'] = 'Parameter ini digunakan untuk mencegah model terlalu sering mengulang kata atau frasa yang sama dalam teks yang dihasilkan. Nilai yang lebih tinggi membuat model lebih konservatif terhadap pengulangan.';
$string['geniai:analyzeactivity'] = 'Analisis aktivitas Moodle dengan GeniAI';
$string['geniai:manage'] = 'Kelola GeniAI';
$string['geniai:view'] = 'Lihat GeniAI';
$string['geniainame'] = 'Nama asisten';
$string['geniainame_desc'] = 'Tentukan nama asisten Anda';
$string['h5p-accordion-desc'] = 'Buat Glosarium dari konten Anda agar siswa dapat belajar secara lebih interaktif, jelas, dan menarik.';
$string['h5p-accordion-title'] = 'Glosarium';
$string['h5p-advancedtext-desc'] = 'Buat Buku digital dari konten Anda agar siswa dapat belajar secara lebih interaktif, jelas, dan menarik.';
$string['h5p-advancedtext-title'] = 'Buku digital';
$string['h5p-block-title'] = 'Judul blok';
$string['h5p-create'] = 'Buat H5P dengan GeniAI';
$string['h5p-create-new'] = 'Buat H5P baru dengan GeniAI';
$string['h5p-create-this'] = 'Buat dengan sumber daya ini';
$string['h5p-create-title'] = 'Judul H5P';
$string['h5p-create-title-desc'] = 'Tentukan judul utama konten H5P yang akan ditampilkan kepada pengguna di antarmuka.';
$string['h5p-createpage-title'] = 'Buat {$a} baru';
$string['h5p-crossword-desc'] = 'Buat Teka-teki silang dari konten Anda agar siswa dapat belajar secara lebih interaktif, jelas, dan menarik.';
$string['h5p-crossword-title'] = 'Teka-teki silang';
$string['h5p-delete-success'] = 'H5P berhasil dihapus!';
$string['h5p-dialogcards-desc'] = 'Buat Kartu flash dari konten Anda agar siswa dapat belajar secara lebih interaktif, jelas, dan menarik.';
$string['h5p-dialogcards-title'] = 'Kartu flash';
$string['h5p-dragtext-desc'] = 'Buat Permainan seret kata dari konten Anda agar siswa dapat belajar secara lebih interaktif, jelas, dan menarik.';
$string['h5p-dragtext-title'] = 'Permainan seret kata';
$string['h5p-example'] = 'Lihat contoh';
$string['h5p-findthewords-desc'] = 'Buat Pencarian kata dari konten Anda agar siswa dapat belajar secara lebih interaktif, jelas, dan menarik.';
$string['h5p-findthewords-title'] = 'Pencarian kata';
$string['h5p-interactivebook-desc'] = 'Buat Buku interaktif dari konten Anda agar siswa dapat belajar secara lebih interaktif, jelas, dan menarik.';
$string['h5p-interactivebook-title'] = 'Buku interaktif';
$string['h5p-interactivevideo-desc'] = 'Buat Video interaktif dari konten Anda agar siswa dapat belajar secara lebih interaktif, jelas, dan menarik.';
$string['h5p-interactivevideo-title'] = 'Video interaktif';
$string['h5p-manager'] = 'Kelola H5P dengan GeniAI';
$string['h5p-manager-scorm'] = 'Kelola SCORM dengan GeniAI';
$string['h5p-next-step'] = 'Langkah berikutnya';
$string['h5p-no-apikey'] = '<p>Konfigurasi kunci API ChatGPT diperlukan agar sistem pembuatan akun berfungsi dengan benar.<p><p><a href="{$a}">Klik di sini untuk mengonfigurasi kunci API ChatGPT.</a></p>';
$string['h5p-page-title'] = 'Buat H5P dengan GeniAI';
$string['h5p-questionset-desc'] = 'Buat Kuis dari konten Anda agar siswa dapat belajar secara lebih interaktif, jelas, dan menarik.';
$string['h5p-questionset-title'] = 'Kuis';
$string['h5p-readmore'] = '...lagi';
$string['h5p-return'] = 'Kembali ke Bank Konten';
$string['h5p-title'] = 'Kelola Bank Konten GeniAI';
$string['message_01'] = 'Halo, {$a}! 🌟';
$string['message_02'] = 'Selamat datang di kursus {$a->coursename} di Moodle {$a->moodlename}!
Saya {$a->geniainame}, dan saya di sini untuk membuat perjalanan belajar Anda sebaik mungkin.
Bagaimana saya dapat membantu Anda hari ini? 🌟📚';
$string['mode'] = 'Mode penggunaan';
$string['mode_desc'] = 'Tentukan mode penggunaan balon yang Anda inginkan';
$string['mode_name_geniai'] = 'Tutor GeniAI';
$string['mode_name_none'] = 'Tanpa balon chat';
$string['model'] = 'Model API';
$string['model_desc'] = 'Model API yang dijalankan di OpenAI. Nilai yang tersedia ada di <a href="https://platform.openai.com/docs/models/overview" target="_blank">situs OpenAI</a><br>
<strong>Penting:</strong> jika menggunakan model ChatGPT dengan <strong>mini</strong> atau <strong>nano</strong>, tampilkan pesan yang merekomendasikan Model API tanpa mini atau nano untuk analisis yang lebih baik.';
$string['modulename'] = 'GeniAI';
$string['modules'] = 'Modul yang akan disembunyikan dari {$a}';
$string['modules_desc'] = 'Daftar ini berisi modul yang tidak boleh tersedia bagi siswa, sehingga tidak digunakan dalam latihan.';
$string['online'] = 'Online';
$string['pluginname'] = 'GeniAI';
$string['presence_penalty'] = 'Penalti kehadiran';
$string['presence_penalty_desc'] = 'Parameter ini mendorong model memasukkan variasi token yang lebih luas dalam teks yang dihasilkan. Nilai yang lebih tinggi membuat token baru lebih mungkin muncul.';
$string['privacy:metadata'] = 'Plugin GeniAI menyimpan riwayat percakapan sementara pada sesi saat ini dan hanya menyimpan metadata penggunaan operasional tanpa menyimpan isi pesan atau data pribadi dalam laporan lokalnya.';
$string['prompt_activity_focus_alignment'] = 'prioritaskan koherensi antara kursus, bagian, judul, dan konten aktivitas.';
$string['prompt_activity_focus_bloom'] = 'prioritaskan taksonomi Bloom dan kedalaman kognitif proposal.';
$string['prompt_activity_focus_full'] = 'analisis aktivitas lengkap.';
$string['prompt_activity_focus_pedagogy'] = 'prioritaskan kesesuaian pedagogis, instruksi siswa, dan kualitas pembelajaran.';
$string['prompt_activity_focus_spelling'] = 'prioritaskan ejaan, tata bahasa, kejelasan, dan nada instruksional.';
$string['prompt_activity_schema_bloom_level'] = 'remember | understand | apply | analyze | evaluate | create';
$string['prompt_activity_schema_diagnosis'] = 'Ringkasan singkat diagnosis umum.';
$string['prompt_activity_schema_recommendation_1'] = 'Tindakan praktis 1.';
$string['prompt_activity_schema_recommendation_2'] = 'Tindakan praktis 2.';
$string['prompt_activity_schema_status'] = 'OK | OK with minor adjustments | Needs review | Inadequate or insufficient';
$string['prompt_activity_schema_status_key'] = 'ok | ok_minor | needs_review | insufficient';
$string['prompt_activity_system'] = 'Anda adalah ahli desain instruksional, peninjauan teks, dan Moodle. Analisis aktivitas Moodle yang ada dalam bahasa Moodle pengguna saat ini: {$a->lang}. Pertahankan field teknis JSON dan nilai enum tepat dalam bahasa Inggris. Jangan mengarang informasi dan nyatakan dengan jelas jika konten tidak cukup.

Kriteria wajib: ejaan dan kejelasan, koherensi antara judul, bagian, dan konten, taksonomi Bloom dengan salah satu nilai remember, understand, apply, analyze, evaluate, create, kesesuaian pedagogis, dan saran praktis.

Fokus tambahan: {$a->focus}

Di akhir, tambahkan blok teknis dengan JSON valid antara ```json dan ```. Field wajib: status_key, status, bloom_level, diagnosis, recommendations. Jenis analisis: {$a->analysis}';
$string['prompt_activity_user'] = 'Analisis aktivitas Moodle di bawah ini.

{$a}';
$string['prompt_chat_system'] = 'Anda adalah chatbot bernama **{$a->geniainame}**. Peran Anda adalah bertindak sebagai guru Moodle yang membantu untuk kursus **[**{$a->coursename}**]({$a->courseurl})** di "{$a->sitename}".

## Modul kursus:
{$a->modules}

Jawablah dengan jelas, ramah, dan memotivasi. Jika pertanyaan ambigu, minta detail. Jika tidak tahu jawabannya, katakan dengan jujur dan jangan mengarang. Tetap fokus pada kursus **{$a->coursename}**. Gunakan hanya MARKDOWN dan selalu jawab dalam bahasa **{$a->userlang}**.';
$string['prompt_json_block_instruction'] = '

Kembalikan juga blok teknis akhir dengan JSON valid di antara ```json dan ```.';
$string['prompt_json_block_schema'] = '
Gunakan format referensi ini:
{$a}';
$string['prompt_json_style'] = '
Gaya:
- Hindari daftar; gunakan hanya jika penting;
- Gunakan `:` hanya jika benar-benar diperlukan; lebih baik menulis ulang dengan kalimat lengkap;
- Jangan tambahkan kesimpulan atau sintesis akhir;
- Berhati-hatilah agar tidak terdengar seperti teks yang dibuat AI.';
$string['report_completion_tokens'] = 'Jumlah token diterima';
$string['report_datecreated'] = 'Hari';
$string['report_download'] = 'Unduh penggunaan GPT';
$string['report_filename'] = 'Laporan penggunaan bantuan GPT';
$string['report_info'] = '<p>Dalam laporan yang ditampilkan, hanya 100 baris pertama yang tersedia. Untuk mengakses semua catatan, unduh dokumen lengkap.</p><p>Satu token kira-kira setara dengan 4 karakter teks bahasa Inggris umum. Pelajari lebih lanjut di halaman <a href="https://platform.openai.com/tokenizer" target="_blank">Language Model Tokenization</a>.</p>';
$string['report_list'] = 'Daftar audio';
$string['report_model'] = 'Model ChatGPT';
$string['report_prompt_tokens'] = 'Jumlah token dikirim';
$string['report_title'] = 'Laporan';
$string['send_message'] = 'Kirim pesan';
$string['settings'] = 'Konfigurasikan GeniAI';
$string['settings_casedesc'] = 'Parameter Temperature dan Top_p ditentukan untuk berbagai skenario, seperti pembuatan teks dan kode, penulisan kreatif, chatbot, komentar teks, analisis data, dan penulisan eksploratif.<br><br>Gunakan tabel berikut sebagai panduan untuk Temperature dan Top_p:<br>';
$string['settings_casedesc_balancedresp'] = 'Respons seimbang';
$string['settings_casedesc_balancedresp_desc'] = 'Respons seimbang.';
$string['settings_casedesc_caseuse'] = 'Kasus penggunaan';
$string['settings_casedesc_chatbot'] = 'Chatbot';
$string['settings_casedesc_chatbot_desc'] = 'Respons cepat, konsisten, dan kontekstual untuk interaksi real-time dengan pengguna.';
$string['settings_casedesc_creativegen'] = 'Generasi kreatif';
$string['settings_casedesc_creativegen_desc'] = 'Menghasilkan respons yang lebih kreatif, orisinal, atau eksploratif. Berguna untuk brainstorming atau bercerita.';
$string['settings_casedesc_description'] = 'Deskripsi';
$string['settings_casedesc_formaltones'] = 'Nada formal';
$string['settings_casedesc_formaltones_desc'] = 'Membuat teks yang lebih formal atau teknis dengan variasi kreatif yang lebih sedikit.';
$string['settings_casedesc_optionexplore'] = 'Eksplorasi opsi';
$string['settings_casedesc_optionexplore_desc'] = 'Menghasilkan beberapa respons alternatif untuk mempertimbangkan pendekatan yang berbeda terhadap suatu pertanyaan.';
$string['settings_casedesc_preciseresp'] = 'Respons tepat';
$string['settings_casedesc_preciseresp_desc'] = 'Akurasi dan prediktabilitas maksimum. Direkomendasikan untuk tugas teknis atau informatif.';
$string['settings_casedesc_relaxedtones'] = 'Nada santai';
$string['settings_casedesc_relaxedtones_desc'] = 'Menghasilkan teks yang lebih ringan dan informal dengan pendekatan kreatif dan ramah.';
$string['settings_casedesc_temperature'] = 'Temperature';
$string['settings_casedesc_top_p'] = 'Top_p';
$string['talk_geniai'] = 'Bicara dengan {$a} di sini';
$string['write_message'] = 'Tulis pesan...';
