<?php

namespace Database\Seeders;

use App\Models\Forms\QuestionCategory as FormsQuestionCategory;
use Illuminate\Database\Seeder;

class QuestionCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        FormsQuestionCategory::insert([
            ['text' => 'emocional'],
            ['text' => 'matematico'],
        ]);
    }
}
