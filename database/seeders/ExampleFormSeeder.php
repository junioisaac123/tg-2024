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
            'questionnaire_category_id' => $emotionalCategory->id,
        ]);

        // Preguntas del Cuestionario de Estado Emocional
        $emotionalQuestions = [
            [
                'title' => '¿Te sientes feliz en la escuela?',
                'type' => 'radio',
                'options' => ['Sí', 'No', 'A veces'],
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
                'options' => ['Hablar con amigos', 'Hablar con la familia', 'Estar solo', 'Otra'],
                'is_required' => true
            ],
            [
                'title' => '¿Con qué frecuencia te sientes nervioso o ansioso?',
                'type' => 'select',
                'options' => ['Nunca', 'Rara vez', 'A menudo', 'Siempre'],
                'is_required' => true
            ],
            [
                'title' => 'Marca las emociones que sientes durante el día.',
                'type' => 'checkbox',
                'options' => ['Feliz', 'Triste', 'Enojado', 'Asustado', 'Emocionado'],
                'is_required' => true
            ],
            [
                'title' => '¿Cómo te sientes al hablar en público?',
                'type' => 'radio',
                'options' => ['Seguro', 'Nervioso', 'Indiferente'],
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
                'options' => ['Sí', 'No', 'A veces'],
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
                foreach ($questionData['options'] as $optionText) {
                    QuestionOption::create([
                        'text' => $optionText,
                        'question_id' => $question->id,
                    ]);
                }
            }
        }

        // Crear Cuestionario 2: Habilidades Matemáticas Básicas
        $mathQuestionnaire = Questionnaire::create([
            'title' => 'Evaluación de Habilidades Matemáticas Básicas',
            'description' => 'Cuestionario para evaluar las habilidades matemáticas de niños en 3ro de primaria',
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
                'options' => ['10 + 5', '8 + 6', '7 + 8'],
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
                'options' => ['2', '3', '4'],
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
                'options' => ['1', '2', '3', '4', '5', '6'],
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
                'options' => ['3', '4', '5'],
                'is_required' => true
            ],
            [
                'title' => '¿Cuál de las siguientes operaciones resulta en un número impar?',
                'type' => 'select',
                'options' => ['6 + 2', '5 + 4', '3 + 5'],
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
                foreach ($questionData['options'] as $optionText) {
                    QuestionOption::create([
                        'text' => $optionText,
                        'question_id' => $question->id,
                    ]);
                }
            }
        }
    }
}
