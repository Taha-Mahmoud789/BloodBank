<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function index()
    {
//        $roles = Role::all();
        $roles = Role::with('permissions')->get();
        return view('roles.index', compact('roles'));
    }

    public function create()
    {
        $permissions = Permission::all();
        return view('roles.create', compact('permissions'));
    }

    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'name' => 'required|unique:roles,name',
            'permissions' => 'array|exists:permissions,name', // Ensure permissions are an array and exist in the permissions table
        ]);
//        $permissions = Permission::all();
//        dd($permissions);

        // Create a new role with the provided name
        $role = Role::create(['name' => $request->name]);

        // Get the permissions from the request, or default to an empty array
        $permissions = $request->permissions ?? [];

        // Sync the permissions to the newly created role
        $role->syncPermissions($permissions);

        // Redirect back to the roles index with a success message
        return redirect()->route('roles.index')->with('success', 'Role created successfully!');
    }

    public function edit(Role $role)
    {
        $permissions = Permission::all();
        return view('roles.edit', compact('role', 'permissions'));
    }

    public function update(Request $request, Role $role)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|unique:roles,name,' . $role->id, // Ensure the role name is unique except for the current role
            'permissions' => 'array|exists:permissions,name', // Validate that permissions exist
        ]);

        // Update the role's name
        $role->update(['name' => $request->name]);

        // Get the permissions from the request, or default to an empty array
        $permissions = $request->permissions ?? [];

        // Sync the role's permissions only if permissions array is not empty
        if (!empty($permissions)) {
            $role->syncPermissions($permissions);
        }

        // Redirect with success message
        return redirect()->route('roles.index')->with('success', 'Role updated successfully!');
    }


    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->route('roles.index')->with('success', 'Role deleted successfully!');
    }
    public function show(string $id)
    {
        //
    }
}
