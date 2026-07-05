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
 * Builds prompts for activity analysis.
 *
 * @package   local_geniai
 * @copyright 2024 Eduardo Kraus {@link https://eduardokraus.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace local_geniai\analyzer;

/**
 * Class prompt_builder
 */
class prompt_builder {
    /**
     * Build chat messages for the current activity analysis.
     *
     * @param activity_content $content Activity content.
     * @param string $analysis Analysis type.
     * @return array
     */
    public static function build_messages(activity_content $content, $analysis = "full") {
        $system = self::system_prompt($analysis);
        $user = self::user_prompt($content);

        return [
            [
                "role" => "system",
                "content" => $system,
            ],
            [
                "role" => "user",
                "content" => $user,
            ],
        ];
    }

    /**
     * Structured schema used by ai_client::generate_json().
     *
     * @return array
     */
    public static function structured_schema() {
        return [
            "status_key" => 'ok | ok_minor | needs_review | insufficient',
            "status" => 'OK | OK com ajustes leves | Precisa revisão | Inadequado ou insuficiente',
            "bloom_level" => 'lembrar | compreender | aplicar | analisar | avaliar | criar',
            "diagnosis" => 'Resumo curto do diagnóstico geral.',
            "recommendations" => [
                'Ação prática 1.',
                'Ação prática 2.',
            ],
        ];
    }

    /**
     * Build the system prompt.
     *
     * @param string $analysis Analysis type.
     * @return string
     */
    private static function system_prompt($analysis) {
        $focus = self::analysis_focus($analysis);

        return "Você é um especialista em design instrucional, revisão textual e Moodle.\n\n" .
            "Sua tarefa é analisar uma atividade existente de um curso Moodle.\n" .
            "Responda sempre em português do Brasil.\n" .
            "Não invente informações que não estejam no material enviado.\n" .
            "Se o conteúdo for insuficiente para análise, diga isso claramente.\n" .
            "Não reescreva toda a atividade, a menos que seja necessário para explicar uma melhoria pontual.\n" .
            "Mantenha a resposta objetiva, útil para professor, coordenador ou designer instrucional.\n\n" .
            "Critérios obrigatórios de análise:\n" .
            "1. Ortografia, gramática e clareza textual.\n" .
            "2. Coerência entre título da atividade, seção do curso e conteúdo da atividade.\n" .
            "3. Taxonomia de Bloom, usando exatamente um destes níveis predominantes:" .
            " lembrar, compreender, aplicar, analisar, avaliar, criar.\n" .
            "4. Adequação pedagógica da atividade.\n" .
            "5. Sugestões práticas de melhoria.\n\n" .
            "Foco adicional desta análise: {$focus}\n\n" .
            "Formato obrigatório da resposta em Markdown:\n\n" .
            "## Diagnóstico geral\n" .
            "Diga se a atividade está ok ou se precisa de ajustes.\n\n" .
            "## Ortografia e clareza\n" .
            "Informe problemas encontrados ou diga que está adequado.\n\n" .
            "## Coerência com a seção\n" .
            "Compare título, seção e conteúdo.\n\n" .
            "## Taxonomia de Bloom\n" .
            "Indique o nível predominante e explique por quê.\n\n" .
            "## Melhorias recomendadas\n" .
            "Liste ações práticas, sem reescrever toda a atividade.\n\n" .
            "## Parecer final\n" .
            "Use exatamente uma destas classificações:" .
            " OK, OK com ajustes leves, Precisa revisão, Inadequado ou insuficiente.\n\n" .
            "Ao final da resposta, adicione um bloco técnico em JSON válido entre ```json e ```.\n" .
            "Este bloco será usado pelo Moodle e não deve conter comentários fora do JSON.\n" .
            "Campos obrigatórios: status_key, status, bloom_level, diagnosis, recommendations.\n" .
            "Tipo de análise solicitado: {$analysis}";
    }

    /**
     * Build the user prompt.
     *
     * @param activity_content $content Activity content.
     * @return string
     */
    private static function user_prompt(activity_content $content) {
        return "Analise a atividade Moodle abaixo.\n\n" . $content->to_prompt_text();
    }

    /**
     * Describe the analysis focus.
     *
     * @param string $analysis Analysis type.
     * @return string
     */
    private static function analysis_focus($analysis) {
        $analysis = trim($analysis);

        $focus = [
            "full" => 'análise completa da atividade.',
            "spelling" => 'priorize ortografia, gramática, clareza e tom instrucional.',
            "alignment" => 'priorize coerência entre curso, seção, título e conteúdo da atividade.',
            "bloom" => 'priorize a Taxonomia de Bloom e a profundidade cognitiva da proposta.',
            "pedagogy" => 'priorize adequação pedagógica, instruções ao estudante e qualidade da aprendizagem.',
        ];

        return $focus[$analysis] ?? $focus["full"];
    }
}
