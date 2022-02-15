<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ResearchTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('questions')->insert([
            'question_description' => 'КАКИЕ ЖИВОТНЫЕ У ВАС ЕСТЬ',
            'questionnaire_id' => '1',
        ]);

        DB::table('questionnaires')->insert([
            'name' => 'Питомцы',
        ]);
        DB::table('question_options')->insert([
            [
            'question_id' => 1,
            'value' => 1,
            'option_description' => 'Кошка',
        ], [
            'question_id' => 1,
            'value' => 2,
            'option_description' => 'Собака',
        ],[
            'question_id' => 1,
            'value' => 4,
            'option_description' => 'Попугай',
        ],[
            'question_id' => 1,
            'value' => 8,
            'option_description' => 'Рыбки',
        ],[
            'question_id' => 1,
            'value' => 16,
            'option_description' => 'Рептилии',
        ],[
            'question_id' => 1,
            'value' => 0,
            'option_description' => 'ЖИВОТНЫЕ ОТСУТСТВУЮТ',
        ]]
        );
    }
}
