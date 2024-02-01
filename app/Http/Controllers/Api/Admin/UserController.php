<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Policies\UserPolicy;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(User::class, 'user', UserPolicy::class);
    }

    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        // Validate the request
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'sometimes|required|string|in:admin,guru,murid,gurupiket,tatausaha,kepsek,kurikulum',
        ]);

        // Create a new user
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
            'role' => 'sometimes|required|string|in:admin,guru,murid,gurupiket,tatausaha,kepsek,kurikulum',
        ]);

        // Assign roles and permissions
        // ...

        return redirect()->route('users.index');
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        // Validate the request
        $validatedData = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'sometimes|required|string|min:8|confirmed',
            'role' => 'sometimes|required|string|in:admin,guru,murid,gurupiket,tatausaha,kepsek,kurikulum',
        ]);

        // Update the user
        $user->update([
            'name' => $validatedData['name'] ?? $user->name,
            'email' => $validatedData['email'] ?? $user->email,
            'password' => $validatedData['password'] ? bcrypt($validatedData['password']) : $user->password,
            'role' => 'sometimes|required|string|in:admin,guru,murid,gurupiket,tatausaha,kepsek,kurikulum',
        ]);

        // Update roles and permissions
        // ...

        return redirect()->route('users.index');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index');
    }

    // Add similar methods for other user-related permissions

    // Example method for checking if the current user has a specific permission
    public function checkPermission()
    {
        if (Auth::user()->can('tambah-user')) {
            return "User has permission to add a user";
        } else {
            return "User does not have permission to add a user";
        }
    }
}