<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return UserResource::collection($users);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'      => 'required',
            'email'     => 'required|unique:users',
            'password'  => 'required|confirmed',
            'role'      => 'required|string|in:guru,murid,gurupiket,tatausaha,kepsek,kurikulum',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Create user
        $user = User::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => bcrypt($request->password),
            'role'      => $request->role
        ]);

        // Assign role to user
        $user->assignRole($request->role);

        if ($user) {
            // Return success response
            return new UserResource($user);
        }

        // Return failed response
        return response()->json(['message' => 'Data User Gagal Disimpan!'], 500);
    }


    public function show($id)
    {
        $user = User::findOrFail($id);
        return new UserResource($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function update(Request $request, $id)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8', // optional, at least 8 characters
            'role' => 'required|string|in:guru,murid,gurupiket,tatausaha,kepsek,kurikulum',
            // Add validation rules for other fields as needed
        ]);

        // Find the user by ID
        $user = User::findOrFail($id);

        // Update the user's name, email, and role
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->role = $validatedData['role'];

        // Update the password if provided
        if (isset($validatedData['password'])) {
            $user->password = Hash::make($validatedData['password']);
        }

        // Save the user
        $user->save();

        // Return a response indicating success
        return response()->json(['message' => 'User updated successfully'], 200);
    }


    public function destroy(User $user, $id)
    {
        // Auth::authorize('suratterlambat.delete');
        $user = User::findOrFail($id);

        if ($user) {
            $user->forceDelete();
            return response()->json([
                'message' => 'Data User berhasil dihapus'
            ], 200);
        } else {
            return response()->json([
                'message' => 'Data User tidak ditemukan'
            ], 404);
        }
    }
}
