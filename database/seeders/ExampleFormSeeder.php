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
        // Crear categorías
        $emotionalCategory = QuestionnaireCategory::create(['text' => 'Estado Emocional']);
        $mathSkillsCategory = QuestionnaireCategory::create(['text' => 'Habilidades Matemáticas Básicas']);

        // Crear Cuestionario 1: Estado Emocional
        $emotionalQuestionnaire = Questionnaire::create([
            'title' => 'Evaluación del Estado Emocional',
            'description' => 'Cuestionario para evaluar el estado emocional de niños en 3ro de primaria',
            'rating_mode' => 'scores',
            'questionnaire_category_id' => $emotionalCategory->id,
        ]);

        // Preguntas del Cuestionario de Estado Emocional
        $emotionalQuestions = [
            [
                'title' => '¿Te sientes feliz en la escuela?',
                'type' => 'radio',
                'options' => [
                    ['text' => 'Muy feliz', 'score' => 3],
                    ['text' => 'Feliz', 'score' => 2],
                    ['text' => 'Indiferente', 'score' => 1],
                    ['text' => 'Triste', 'score' => 0]
                ],
                'is_required' => true
            ],
            [
                'title' => 'Describe cómo te sientes hoy.',
                'type' => 'textarea',
                'is_required' => false
            ],
            [
                'title' => '¿Qué haces cuando estás triste?',
                'type' => 'select',
                'options' => [
                    ['text' => 'Hablar con amigos', 'score' => 3],
                    ['text' => 'Hablar con la familia', 'score' => 2],
                    ['text' => 'Estar solo', 'score' => 1],
                    ['text' => 'Otra', 'score' => 0]
                ],
                'is_required' => true
            ],
            [
                'title' => '¿Con qué frecuencia te sientes nervioso o ansioso?',
                'type' => 'select',
                'options' => [
                    ['text' => 'Nunca', 'score' => 3],
                    ['text' => 'Rara vez', 'score' => 2],
                    ['text' => 'A menudo', 'score' => 1],
                    ['text' => 'Siempre', 'score' => 0]
                ],
                'is_required' => true
            ],
            [
                'title' => 'Marca las emociones que sientes durante el día.',
                'type' => 'checkbox',
                'options' => [
                    ['text' => 'Feliz', 'score' => 3],
                    ['text' => 'Triste', 'score' => 2],
                    ['text' => 'Enojado', 'score' => 1],
                    ['text' => 'Asustado', 'score' => 0]
                ],
                'is_required' => true
            ],
            [
                'title' => '¿Cómo te sientes al hablar en público?',
                'type' => 'radio',
                'options' => [
                    ['text' => 'Muy seguro', 'score' => 3],
                    ['text' => 'Seguro', 'score' => 2],
                    ['text' => 'Nervioso', 'score' => 1],
                    ['text' => 'Muy nervioso', 'score' => 0]
                ],
                'is_required' => true
            ],
            [
                'title' => '¿Qué haces cuando algo te frustra?',
                'type' => 'input',
                'is_required' => true
            ],
            [
                'title' => '¿Te sientes cómodo al hacer nuevos amigos?',
                'type' => 'radio',
                'options' => [
                    ['text' => 'Muy cómodo', 'score' => 3],
                    ['text' => 'Cómodo', 'score' => 2],
                    ['text' => 'Poco cómodo', 'score' => 1],
                    ['text' => 'Incomodo', 'score' => 0]
                ],
                'is_required' => true
            ]
        ];


        // Guardar preguntas y opciones del Cuestionario de Estado Emocional
        foreach ($emotionalQuestions as $questionData) {
            $question = Question::create([
                'title' => $questionData['title'],
                'description' => $questionData['description'] ?? null,
                'is_required' => $questionData['is_required'],
                'type' => $questionData['type'],
                'questionnaire_id' => $emotionalQuestionnaire->id,
            ]);

            if (isset($questionData['options'])) {
                foreach ($questionData['options'] as $optionArr) {
                    QuestionOption::create([
                        'text' => $optionArr['text'],
                        'question_id' => $question->id,
                        'score' => $optionArr['score'] ?? null,
                    ]);
                }
            }
        }

        // Crear Cuestionario 2: Habilidades Matemáticas Básicas
        $mathQuestionnaire = Questionnaire::create([
            'title' => 'Evaluación de Habilidades Matemáticas Básicas',
            'description' => 'Cuestionario para evaluar las habilidades matemáticas de niños en 3ro de primaria',
            'rating_mode' => 'checks',
            'questionnaire_category_id' => $mathSkillsCategory->id,
        ]);

        // Preguntas del Cuestionario de Habilidades Matemáticas Básicas
        $mathQuestions = [
            [
                'title' => '¿Cuál es el resultado de 3 + 4?',
                'type' => 'input',
                'is_required' => true
            ],
            [
                'title' => 'Elige la operación que da como resultado 15.',
                'type' => 'select',
                'options' => [
                    ['text' => '10 + 5', 'score' => 1],
                    ['text' => '8 + 6', 'score' => 0],
                    ['text' => '7 + 8', 'score' => 0]
                ],
                'is_required' => true
            ],
            [
                'title' => 'Resuelve 9 - 2.',
                'type' => 'input',
                'is_required' => true
            ],
            [
                'title' => '¿Cuántos lados tiene un triángulo?',
                'type' => 'radio',
                'options' => [
                    ['text' => '2', 'score' => 0],
                    ['text' => '3', 'score' => 1],
                    ['text' => '4', 'score' => 0]
                ],
                'is_required' => true
            ],
            [
                'title' => '¿Cuál es el doble de 5?',
                'type' => 'input',
                'is_required' => true
            ],
            [
                'title' => 'Marca los números que son pares.',
                'type' => 'checkbox',
                'options' => [
                    ['text' => '1', 'score' => 0],
                    ['text' => '2', 'score' => 1],
                    ['text' => '3', 'score' => 0],
                    ['text' => '4', 'score' => 1],
                    ['text' => '5', 'score' => 0],
                    ['text' => '6', 'score' => 1]
                ],
                'is_required' => true
            ],
            [
                'title' => 'Escribe un número mayor que 10.',
                'type' => 'input',
                'is_required' => true
            ],
            [
                'title' => '¿Cuántos lados tiene un cuadrado?',
                'type' => 'radio',
                'options' => [
                    ['text' => '3', 'score' => 0],
                    ['text' => '4', 'score' => 1],
                    ['text' => '5', 'score' => 0]
                ],
                'is_required' => true
            ],
            [
                'title' => '¿Cuál de las siguientes operaciones resulta en un número impar?',
                'type' => 'select',
                'options' => [
                    ['text' => '6 + 2', 'score' => 0],
                    ['text' => '5 + 4', 'score' => 1],
                    ['text' => '3 + 5', 'score' => 0]
                ],
                'is_required' => true
            ],
            [
                'title' => '¿Qué número sigue después de 7?',
                'type' => 'input',
                'is_required' => true
            ]
        ];


        // Guardar preguntas y opciones del Cuestionario de Habilidades Matemáticas Básicas
        foreach ($mathQuestions as $questionData) {
            $question = Question::create([
                'title' => $questionData['title'],
                'description' => $questionData['description'] ?? null,
                'is_required' => $questionData['is_required'],
                'type' => $questionData['type'],
                'questionnaire_id' => $mathQuestionnaire->id,
            ]);

            if (isset($questionData['options'])) {
                foreach ($questionData['options'] as $optionArr) {
                    QuestionOption::create([
                        'text' => $optionArr['text'],
                        'score' => $optionArr['score'],
                        'question_id' => $question->id,
                    ]);
                }
            }
        }
    }
}
