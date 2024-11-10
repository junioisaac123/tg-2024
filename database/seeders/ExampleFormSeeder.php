<?php

namespace Database\Seeders;

use App\Models\Forms\Question;
use App\Models\Forms\Questionnaire;
use App\Models\Forms\QuestionnaireCategory;
use App\Models\Forms\QuestionOption;
use Illuminate\Database\Seeder;

class ExampleFormSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $emotionalCategory = QuestionnaireCategory::create([
            'text' => 'Evaluación Emocional'
        ]);

        $mathCategory = QuestionnaireCategory::create([
            'text' => 'Habilidades Matemáticas Básicas'
        ]);

        // Crear Cuestionario de Evaluación Emocional
        $emotionalQuestionnaire = Questionnaire::create([
            'title' => 'Evaluación del Estado Emocional - 3ro de Primaria',
            'description' => 'Cuestionario para evaluar el estado emocional de los niños de 3ro de primaria',
            'questionnaire_category_id' => $emotionalCategory->id
        ]);

        // Preguntas para el Cuestionario Emocional
        $questionsEmotional = [
            [
                'title' => '¿Cómo te sientes hoy?',
                'description' => 'Escribe en una palabra cómo te sientes',
                'is_required' => true,
                'type' => 'input'
            ],
            [
                'title' => 'Describe cómo fue tu día en la escuela',
                'description' => 'Cuentanos un poco sobre tu experiencia en el día',
                'is_required' => false,
                'type' => 'textarea'
            ],
            [
                'title' => '¿Te sientes feliz en la escuela?',
                'is_required' => true,
                'type' => 'radio',
                'options' => [
                    ['text' => 'Sí', 'score' => 5],
                    ['text' => 'A veces', 'score' => 3],
                    ['text' => 'No', 'score' => 1]
                ]
            ],
            [
                'title' => 'Selecciona las emociones que has sentido esta semana',
                'is_required' => false,
                'type' => 'checkbox',
                'options' => [
                    ['text' => 'Felicidad', 'score' => 5],
                    ['text' => 'Tristeza', 'score' => 1],
                    ['text' => 'Enojo', 'score' => 2],
                    ['text' => 'Miedo', 'score' => 1]
                ]
            ],
            [
                'title' => '¿Cómo te sientes al interactuar con tus compañeros?',
                'is_required' => true,
                'type' => 'select',
                'options' => [
                    ['text' => 'Muy cómodo', 'score' => 5],
                    ['text' => 'Cómodo', 'score' => 4],
                    ['text' => 'Neutro', 'score' => 3],
                    ['text' => 'Incómodo', 'score' => 2],
                    ['text' => 'Muy incómodo', 'score' => 1]
                ]
            ]
        ];

        foreach ($questionsEmotional as $q) {
            $question = Question::create([
                'title' => $q['title'],
                'description' => $q['description'] ?? null,
                'is_required' => $q['is_required'],
                'type' => $q['type'],
                'questionnaire_id' => $emotionalQuestionnaire->id
            ]);

            if (isset($q['options'])) {
                foreach ($q['options'] as $option) {
                    QuestionOption::create([
                        'text' => $option['text'],
                        'score' => $option['score'] ?? null,
                        'question_id' => $question->id
                    ]);
                }
            }
        }

        // Crear Cuestionario de Habilidades Matemáticas Básicas
        $mathQuestionnaire = Questionnaire::create([
            'title' => 'Evaluación de Habilidades Matemáticas Básicas - 3ro de Primaria',
            'description' => 'Cuestionario para evaluar habilidades matemáticas básicas en estudiantes de 3ro de primaria',
            'questionnaire_category_id' => $mathCategory->id
        ]);

        // Preguntas para el Cuestionario Matemático
        $questionsMath = [
            [
                'title' => 'Escribe el resultado de 5 + 3',
                'is_required' => true,
                'type' => 'input'
            ],
            [
                'title' => 'Explica cómo resolviste 12 - 7',
                'is_required' => false,
                'type' => 'textarea'
            ],
            [
                'title' => '¿Cuánto es 6 x 2?',
                'is_required' => true,
                'type' => 'radio',
                'options' => [
                    ['text' => '10', 'score' => 0],
                    ['text' => '12', 'score' => 5],
                    ['text' => '14', 'score' => 0]
                ]
            ],
            [
                'title' => 'Selecciona todos los números que son múltiplos de 3',
                'is_required' => true,
                'type' => 'checkbox',
                'options' => [
                    ['text' => '3', 'score' => 2],
                    ['text' => '6', 'score' => 2],
                    ['text' => '8', 'score' => 0],
                    ['text' => '9', 'score' => 2]
                ]
            ],
            [
                'title' => 'Selecciona el símbolo correcto para la operación 8 ___ 4 = 32',
                'is_required' => true,
                'type' => 'select',
                'options' => [
                    ['text' => '+', 'score' => 0],
                    ['text' => '-', 'score' => 0],
                    ['text' => 'x', 'score' => 5],
                    ['text' => '÷', 'score' => 0]
                ]
            ]
        ];

        foreach ($questionsMath as $q) {
            $question = Question::create([
                'title' => $q['title'],
                'description' => $q['description'] ?? null,
                'is_required' => $q['is_required'],
                'type' => $q['type'],
                'questionnaire_id' => $mathQuestionnaire->id
            ]);

            if (isset($q['options'])) {
                foreach ($q['options'] as $option) {
                    QuestionOption::create([
                        'text' => $option['text'],
                        'score' => $option['score'] ?? null,
                        'question_id' => $question->id
                    ]);
                }
            }
        }
    }
}
