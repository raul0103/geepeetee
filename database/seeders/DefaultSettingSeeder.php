<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DefaultSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('gpt_parser_default_settings')->insert(
            [
                [
                    'key' => 'temperature',
                    'default' => '0.7',
                    'type' => 'select',
                    'values' => '0.1,0.2,0.3,0.4,0.5,0.6,0.7,0.8,0.9,1.0',
                    'description' => 'Параметр "temperature" в API GPT управляет степенью случайности и разнообразия генерируемого текста. Он определяет, насколько модель будет "креативной" при генерации ответов.',
                ],
                [
                    'key' => 'max_tokens',
                    'default' => '2048',
                    'type' => '',
                    'values' => '',
                    'description' => 'Ограничивает количество генерируемых токенов в ответе. Вы можете установить максимальное количество токенов, которые модель должна сгенерировать. ',
                ]
            ]
        );
    }
}
