<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;

class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
        $userToEdit = User::find($id);
        if (!$userToEdit) {
            return  back()->with('error', __('User not found'));
        }
        return view('profile.edit', [
            'user' => $userToEdit,
            'updateRoute' => 'admin.users.update',
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $userToUpdate = User::find($id);
        if (!$userToUpdate) {
            return  back()->with('error', __('User not found'));
        }

        $userToUpdate->fill($request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', Rule::unique(User::class)->ignore($userToUpdate->id)],
            'phone' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($userToUpdate->id)],
        ]));

        if ($userToUpdate->isDirty('email')) {
            $userToUpdate->email_verified_at = null;
        }

        $userToUpdate->save();

        return Redirect::route('admin.users.edit', $id)->with('status', 'profile-updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // return  response()->json([
        //     'message' => 'destroyed',
        // ], 200);
        return  response()->json([
            'error' => 'Method Not Allowed --',
            'message' => 'Not Allowed',
        ], 405);
    }
}
