<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Forms\Questionnaire;
use App\Models\Forms\QuestionnaireCategory;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

class AdminFormController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $questionnaires = Questionnaire::withQuestionCount()->with('category')->get();
        return view('admin.forms.index', compact('questionnaires'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $categories = QuestionnaireCategory::all();
        return view('admin.forms.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $newQuestionnaire = new Questionnaire();
        $newQuestionnaire->title = $request->title;
        $newQuestionnaire->description = $request->description;
        $newQuestionnaire->questionnaire_category_id = $request->category_id;
        $newQuestionnaire->rating_mode = $request->rating_mode;
        $newQuestionnaire->save();

        $questionsToSave = [];

        foreach ($request->questions as $question) {
            $newQuestionArr = [
                'title' => $question['title'],
                'description' => $question['description'],
                'is_required' => $question['is_required'] == 'on' ? true : false,
                'type' => $question['type'],
            ];
            // save the image
            if (isset($question['image']) && $question['image'] instanceof UploadedFile && $question['image']->isValid()) {
                $tmstamp = intval(microtime(true) * 1000);
                $randTun = rand(1000, 9999);
                $ext = $question['image']->extension();
                $fileName = $tmstamp . $randTun . '.' . $ext;
                $path = $question['image']->storeAs('images/forms/questions', $fileName, 'public');
                $newQuestionArr['image'] = $path;
            }
            $questionsToSave[] = $newQuestionArr;
        }
        $newQuestionnaire->questions()->createMany($questionsToSave);
        return response()->json([
            'success' => true,
            'message' => __('Form created successfully'),
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        // return view('admin.forms.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $categories = QuestionnaireCategory::all();
        $questionnaire = Questionnaire::where('id', $id)
            ->with('questions.options')
            ->first();
        return view('admin.forms.edit', compact('categories', 'questionnaire'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $form = Questionnaire::find($id);
        if ($form) {
            $form->delete();
        } else {
            return response()->json([
                'success' => false,
                'message' => __('Form not found'),
            ], 404);
        }
        return response()->json([
            'success' => true,
            'message' => __('Form deleted successfully'),
        ], 200);
    }

    public function masiveDestroy(Request $request)
    {
        $ids = $request->ids ?? [];
        foreach ($ids as $formId) {
            $form = Questionnaire::find($formId);
            if ($form) {
                $form->delete();
            }
        }
        return response()->json([
            'success' => true,
            'message' => __('Forms deleted successfully'),
        ], 200);
    }
}
