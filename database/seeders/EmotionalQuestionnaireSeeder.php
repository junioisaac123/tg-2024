<?php

namespace Database\Seeders;

use App\Models\Forms\Question;
use App\Models\Forms\Questionnaire;
use App\Models\Forms\QuestionnaireCategory;
use App\Models\Forms\QuestionOption;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmotionalQuestionnaireSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear categoría de cuestionario
        $category = QuestionnaireCategory::firstOrCreate(['text' => 'Estado Emocional']);


        // Crear cuestionario
        $questionnaire = Questionnaire::firstOrCreate([
            'title' => 'Cuestionario Emocional para niños de 3ro de Primaria',
            'description' => 'Este cuestionario ayuda a evaluar el estado emocional del niño y determinar si se encuentra feliz o triste.',
            'rating_mode' => 'scores',
            'questionnaire_category_id' => $category->id,
            'is_default' => true,
        ]);

        // Preguntas y opciones
        $questions = [
            [
                'title' => '¿Te sientes triste la mayor parte del tiempo?',
                'description' => 'Pregunta para evaluar el sentimiento de tristeza general.',
                'is_required' => true,
                'type' => 'radio',
                'options' => [
                    ['text' => 'Sí', 'score' => 5],
                    ['text' => 'No', 'score' => 0],
                ],
            ],
            [
                'title' => '¿Has perdido interés en jugar o en actividades que te gustan?',
                'description' => 'Evalúa si el niño ha perdido interés en sus actividades habituales.',
                'is_required' => true,
                'type' => 'radio',
                'options' => [
                    ['text' => 'Sí', 'score' => 5],
                    ['text' => 'No', 'score' => 0],
                ],
            ],
            [
                'title' => '¿Te sientes con mucha energía últimamente?',
                'description' => 'Pregunta para medir la energía y vitalidad del niño.',
                'is_required' => true,
                'type' => 'radio',
                'options' => [
                    ['text' => 'Sí', 'score' => 0],
                    ['text' => 'No', 'score' => 5],
                ],
            ],
            [
                'title' => '¿Tienes problemas para dormir o te despiertas durante la noche?',
                'description' => 'Pregunta sobre la calidad del sueño.',
                'is_required' => true,
                'type' => 'radio',
                'options' => [
                    ['text' => 'Sí', 'score' => 5],
                    ['text' => 'No', 'score' => 0],
                ],
            ],
            [
                'title' => '¿Te sientes alegre cuando estás con tus amigos?',
                'description' => 'Pregunta para evaluar la interacción social positiva.',
                'is_required' => true,
                'type' => 'radio',
                'options' => [
                    ['text' => 'Sí', 'score' => 0],
                    ['text' => 'No', 'score' => 5],
                ],
            ],
            [
                'title' => '¿Te resulta difícil concentrarte en clase?',
                'description' => 'Evalúa la capacidad de concentración y enfoque.',
                'is_required' => true,
                'type' => 'radio',
                'options' => [
                    ['text' => 'Sí', 'score' => 5],
                    ['text' => 'No', 'score' => 0],
                ],
            ],
            [
                'title' => '¿Sientes que nadie te entiende?',
                'description' => 'Pregunta sobre la sensación de incomprensión y aislamiento.',
                'is_required' => true,
                'type' => 'radio',
                'options' => [
                    ['text' => 'Sí', 'score' => 5],
                    ['text' => 'No', 'score' => 0],
                ],
            ],
            [
                'title' => '¿Te ríes y disfrutas las actividades en la escuela?',
                'description' => 'Pregunta para medir el disfrute de la escuela y las actividades.',
                'is_required' => true,
                'type' => 'radio',
                'options' => [
                    ['text' => 'Sí', 'score' => 0],
                    ['text' => 'No', 'score' => 5],
                ],
            ],
            [
                'title' => '¿Te sientes aburrido(a) la mayor parte del tiempo?',
                'description' => 'Evalúa si el niño experimenta aburrimiento constante.',
                'is_required' => true,
                'type' => 'radio',
                'options' => [
                    ['text' => 'Sí', 'score' => 5],
                    ['text' => 'No', 'score' => 0],
                ],
            ],
            [
                'title' => '¿Te sientes bienvenido(a) en la escuela?',
                'description' => 'Pregunta sobre el sentido de pertenencia en la escuela.',
                'is_required' => true,
                'type' => 'radio',
                'options' => [
                    ['text' => 'Sí', 'score' => 0],
                    ['text' => 'No', 'score' => 5],
                ],
            ],
        ];

        // Crear preguntas y opciones en la base de datos
        foreach ($questions as $qData) {
            $question = Question::firstOrCreate([
                'title' => $qData['title'],
                'description' => $qData['description'],
                'is_required' => $qData['is_required'],
                'type' => $qData['type'],
                'questionnaire_id' => $questionnaire->id,
            ]);

            foreach ($qData['options'] as $option) {
                QuestionOption::firstOrCreate([
                    'text' => $option['text'],
                    'score' => $option['score'],
                    'question_id' => $question->id,
                ]);
            }
        }
    }
}
