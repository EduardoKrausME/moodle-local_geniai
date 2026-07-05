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
 * Reusable AI client facade.
 *
 * This keeps activity analysis, course analysis and future generators independent
 * from the current provider implementation used by the chat feature.
 *
 * @package   local_geniai
 * @copyright 2024 Eduardo Kraus {@link https://eduardokraus.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace local_geniai\gpt\util;

use local_geniai\gpt\chatgpt;
use Throwable;

/**
 * Class ai_client
 */
class ai_client {
    /**
     * Generate a text response using the current plugin provider.
     *
     * @param array $messages Chat messages.
     * @return ai_response
     */
    public static function generate_text(array $messages) {
        try {
            $payload = chatgpt::completions($messages);
        } catch (Throwable $e) {
            return ai_response::error($e->getMessage());
        }

        if (!is_array($payload)) {
            return ai_response::error('The AI provider returned an invalid payload.');
        }

        return ai_response::from_chatgpt_completions($payload);
    }

    /**
     * Generate a response that should include a JSON technical block.
     *
     * The current plugin provider still uses Chat Completions. This method does not
     * require native structured outputs; instead it appends a precise instruction
     * and lets result_parser extract the JSON block from the final text.
     *
     * @param array $messages Chat messages.
     * @param array $schema Human-readable schema description.
     * @return ai_response
     */
    public static function generate_json(array $messages, array $schema = []) {
        if (!empty($messages)) {
            $last = count($messages) - 1;
            $schemajson = json_encode($schema, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
            $messages[$last]["content"] .= "\n\nRetorne também um bloco técnico final em JSON válido entre ```json e ```.";
            if ($schemajson !== false) {
                $messages[$last]["content"] .= "\nUse este formato de referência:\n{$schemajson}";
            }

            $messages[$last]["content"] .= "
Estilo:
- Evite listas; só use se for indispensável;
- Use `:` apenas quando for realmente necessário; prefira reescrever com frases completas;
- Não faça conclusão nem síntese final. Proibido encerrar com fórmulas como `Por fim`, `No fim`, `Em suma`, `No conjunto`, `Em conclusão` ou equivalentes;
- Cuidado para não parecer IA, Criado por IA ou com características de IA.";
        }

        return self::generate_text($messages);
    }
}
