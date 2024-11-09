<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::paginate(20);

        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(User $model)
    {
        $roles = Role::pluck('name', 'id')->toArray(); // Fetch the roles from the database
        return view('users.create', compact('model', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate input fields
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email', // Ensure email is required and unique
            'email_verified_at' => now(),
            'password' => 'required|string|min:6|confirmed', // Password should be at least 6 characters
            'roles_list' => 'required|array' // Ensure roles_list is an array
        ]);

        // Hash the password before saving
        $request->merge(['password' => Hash::make($request->password)]);

        // Create the user without the roles_list field
        $userData = $request->except('roles_list', 'password_confirmation');

        $user = User::create($userData);

        // Attach roles to the user
        $user->roles()->attach($request->input('roles_list'));

        // Flash success message and redirect
        flash()->success('User created successfully!');
        return redirect()->route('users.index');
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
        $model = User::findOrFail($id);
        $roles = Role::pluck('name', 'id')->toArray(); // Fetch the roles from the database

        return view('users.edit', compact('model', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'password' => 'confirmed',
            'email' => 'email',//|required|unique:users,email,'.$id
            'roles_list' => 'required'
        ]);

        $user = User::findOrFail($id);

        // Remove roles_list from the request data
        $userData = $request->except('roles_list', 'password_confirmation');

        // Hash the password before saving
        $userData['password'] = Hash::make($request->password);

        // Update the user without the roles_list field
        $user->update($userData);

        // Attach roles to the user
        $user->roles()->sync((array)$request->input('roles_list'));

        flash()->success('User roles have been successfully modified');
        return redirect(route('users.edit', $id));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): \Illuminate\Http\RedirectResponse
    {
        // Find the governorate by ID
        $record = User::findOrFail($id);

        // Delete the governorate
        $record->delete();
        flash()->success("Deleted Successfully");
        // Redirect back with a success message
        return redirect()->route('users.index');


    }

}
