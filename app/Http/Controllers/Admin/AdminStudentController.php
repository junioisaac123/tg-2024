<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Testing\Fakes\Fake;

class AdminStudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $students = User::role('Student')->get();
        return view('admin.students.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.students.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'username' => 'required|unique:users|max:20',
            'password' => 'required',
            'password_confirmation' => 'required|same:password',
        ]);

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'document_type' => $request->document_type ?? 'TI',
            'document' => $request->document ?? '',
            'elo' => 800,
            'email' => $request->username . intval(microtime(true) * 100) . '@gmail.com',
        ]);
        if (!$user) {
            return redirect()->route('admin.students.index')->with([
                'status' => 'error',
                'message' => __('Student not created'),
            ]);
        }
        $user->assignRole('Student');

        return redirect()->route('admin.students.index')->with([
            'status' => 'success',
            'message' => __('Student created successfully'),
        ]);
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
        $student = User::find($id);
        if (!$student) {
            return redirect()->route('admin.students.index')->with([
                'status' => 'error',
                'message' => __('Student not found'),
            ]);
        }
        $actionRoute = route('admin.students.update', $student->id);
        $actionMethod = 'PUT';
        return view('admin.students.edit', compact('student', 'actionRoute', 'actionMethod'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'phone' => 'required',
            'username' => 'required',
            'document' => 'required',
        ]);

        $student = User::find($id);

        if (!$student) {
            return back()->with('error', __('Student not found'));
        }

        $student->first_name = $request->first_name;
        $student->last_name = $request->last_name;
        $student->phone = $request->phone;
        $student->username = $request->username;
        $student->document_number = $request->document;
        $student->save();

        return redirect()->route('admin.students.index')->with([
            'status' => 'success',
            'message' => __('Student updated successfully'),
        ]);
    }

    public function updatePassword(Request $request, string $id)
    {
        // dd($request->all());

        $request->validate([
            'current_password' => 'required',
            'password' => 'required',
            'password_confirmation' => 'required|same:password',
        ]);

        $student = User::find($id);
        if (!$student) {
            return back()->with('error', __('Student not found'));
        }
        // check password
        if (!Hash::check($request->current_password, $student->password)) {
            return back()->with('error', __('Current password is incorrect'));
        }
        $student->password = bcrypt($request->password);
        $student->save();
        return back()->with('success', __('Password updated successfully'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $student = User::find($id);
        if (!$student) {
            return response()->json(['success' => false, 'message' => __('Student not found')], 404);
        }
        $student->delete();
        return response()->json(['success' => true, 'message' => __('deleted')], 200);
    }
}
