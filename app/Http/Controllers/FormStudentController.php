<?php

namespace App\Http\Controllers;

use App\Models\Forms\FormStudent;
use Illuminate\Http\Request;

class FormStudentController extends Controller
{
    public function index()
    {
        $formStudents = FormStudent::with('user', 'questionnaire')->get();
        return view('admin.form-students.index', compact('formStudents'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'questionnaire_id' => 'required',
            'rating' => 'required',
            'attempt' => 'required'
        ]);

        $formStudent = FormStudent::create($request->all());
        return redirect()->back()->with('success', 'Form Student created successfully');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'required',
            'questionnaire_id' => 'required',
            'rating' => 'required',
            'attempt' => 'required'
        ]);
        $formStudent = FormStudent::findOrFail($id);
        $formStudent->update($request->all());
        return redirect()->back()->with('success', 'Form Student updated successfully');
    }

    public function destroy($id)
    {
        $formStudent = FormStudent::findOrFail($id);
        $formStudent->delete();
        return redirect()->back()->with('success', 'Form Student deleted successfully');
    }
}
