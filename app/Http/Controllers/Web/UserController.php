<?php

namespace App\Http\Controllers\Web;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index()
{
    $users = User::all();  // Fetch all users
    return view('admin.users.index', compact('users'));
}

    public function create()
    {
        $users = User::all();
        return view('admin.users.create', compact('users'));
    }

    public function store(Request $request)
    {
        // Validate and store a new user
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
        ]);

        User::create($request->all());

        return redirect()->route('admin.users.index')->with('success', 'User created successfully');
    }

    public function edit(User $user)
{
    $roles = Role::all();  // Assuming you have a Role model
    return view('admin.users.edit', compact('user', 'roles'));
}


    public function update(Request $request, User $user)
    {
        // Validate and update the user
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
        ]);

        $user->update($request->all());

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully');
    }

    public function destroy(User $user)
    {
        // Delete the user
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully');
    }
}

