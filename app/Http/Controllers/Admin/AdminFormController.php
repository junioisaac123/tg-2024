<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Forms\Questionnaire;
use App\Models\Forms\QuestionnaireCategory;
use Illuminate\Http\Request;

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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
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
