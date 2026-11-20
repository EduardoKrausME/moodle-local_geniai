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
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle. If not, see <http://www.gnu.org/licenses/>.

namespace local_geniai;

/**
 * Tests for OpenAI request compatibility.
 *
 * @package local_geniai
 * @covers \geniaicontroller_chatgpt\controller
 */
final class openai_compatibility_test extends \advanced_testcase {
    /**
     * Ensure optional sampling settings are never sent to unknown/reasoning models.
     *
     * @dataProvider model_provider
     * @param string $model
     * @param bool $expected
     */
    public function test_sampling_compatibility(string $model, bool $expected): void {
        $controller = new \geniaicontroller_chatgpt\controller();
        $method = new \ReflectionMethod($controller, 'supports_sampling_parameters');
        $this->assertSame($expected, $method->invoke($controller, $model));
    }

    /** @return array */
    public static function model_provider(): array {
        return [
            'gpt4' => ['gpt-4', true],
            'gpt4o' => ['gpt-4o-mini', true],
            'gpt41' => ['gpt-4.1-2025-04-14', true],
            'gpt5' => ['gpt-5', false],
            'gpt54' => ['gpt-5.4-mini', false],
            'gpt5pro' => ['gpt-5-pro', false],
            'o3' => ['o3-mini', false],
            'unknown' => ['future-model', false],
        ];
    }
}
