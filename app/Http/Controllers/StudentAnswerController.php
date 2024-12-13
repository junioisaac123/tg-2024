<?php

namespace App\Http\Controllers;

use App\Models\Forms\FormStudent;
use App\Models\Forms\Questionnaire;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use stdClass;

class StudentAnswerController extends Controller
{
    public function indexForms()
    {
        $allowedForms = Questionnaire::where('is_default', 0)
            ->with('category')
            ->get();
        return view('forms.index-forms', compact('allowedForms'));
    }

    public function showForm(Request $request, $id)
    {
        $form = Questionnaire::where('id', $id)->with('questions.options')->with('category')->first();
        if (!$form) {
            return response()->route('answers.index.forms')->with([
                'status' => 'error',
                'message' => __('Questionnaire not found'),
            ]);
        }

        $returnUrl = route('answers.index.forms');

        return view('forms.render', compact('form', 'returnUrl'));
    }

    public function showEmotionalForm(Request $request)
    {

        $form = Questionnaire::where('is_default', 1)
            ->whereHas('category', function ($query) {
                $query->where('text', 'Estado Emocional');
            })
            ->with('questions.options')
            ->with('category')
            ->first();

        $returnUrl = route('chess.game.new');
        return view('forms.render', compact('form', 'returnUrl'));
    }

    public function store(Request $request)
    {
        $userId = auth()->user()->id;
        $questionnary = Questionnaire::where('id', $request->form_id)->with('questions.options')->first();

        // load previus attempts
        $formStudent = FormStudent::where('user_id', $userId)
            ->where('questionnaire_id', $request->form_id)
            ->orderBy('id', 'desc')
            ->first();
        $attemp = 0;
        if ($formStudent) {
            $attemp = $formStudent->attempt + 1;
        }

        $rating = null;
        if ($questionnary->rating_mode != 'off') {
            $rating = 0;
            $studentAnswers = $request->questions;
            foreach ($questionnary->questions as $key => $question) {
                if ($question->type != 'input' && $question->type != 'textarea') {
                    $answerForQuestion = $studentAnswers[$question->id];
                    try {
                        $index = getNumberFromLetter($answerForQuestion);
                        $selectedOption = $question->options[$index];
                        $score = $selectedOption->score ?? 0;
                        $rating += $score;
                    } catch (\Throwable $th) {
                    }
                }
            }
        }

        FormStudent::create([
            'user_id' => $userId,
            'questionnaire_id' => $request->form_id,
            'rating' => $rating,
            'answers' => json_encode($request->questions),
            'attempt' => $attemp,
        ]);

        if ($rating < 0 || $rating > 100) {
            return response()->json(['error' => 'El puntaje del cuestionario es inválido.'], 400);
        }

        $user = User::find($userId);

        if (!$user) {
            return response()->json(['error' => 'Usuario no encontrado.'], 404);
        }

        $ratingAdjustment = 0;
        if ($rating >= 80) {
            $ratingAdjustment = 50 + (($rating - 80) / 20) * 50; 
        } elseif ($rating < 50) {
            $ratingAdjustment = -50 - ((50 - $rating) / 50) * 50;
        }
        $newElo = $user->elo + $ratingAdjustment;
        if ($newElo < 0) {
            return response()->json(['error' => 'El ajuste del ELO resultaría en un valor negativo.'], 400);
        }

        $user->increment('elo', $ratingAdjustment);
        // return to the needed url
        return redirect($request->return_url ?? 'dashboard')->with([
            'status' => 'success',
            'message' => __('Form submitted successfully'),
        ]);
    }


    public function indexScores()
    {
        $data = DB::table('form_students')
            ->join('users', 'users.id', '=', 'form_students.user_id')
            ->join('questionnaires', 'questionnaires.id', '=', 'form_students.questionnaire_id')
            ->join('questionnaire_categories', 'questionnaire_categories.id', '=', 'questionnaires.questionnaire_category_id')
            ->select(
                'form_students.*',
                'users.first_name',
                'users.last_name',
                'questionnaires.title as form_title',
                'questionnaire_categories.text as category'
            )
            ->get();

        return view('scores.index', compact('data'));
    }
}
