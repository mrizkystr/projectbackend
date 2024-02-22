<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return UserResource::collection($users);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|string|in:guru,murid,gurupiket,tatausaha,kepsek,kurikulum',
        ]);

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);

        $role = Role::findByName($validatedData['role']);

        if (!$role) {
            $role = Role::create([
                'name' => $validatedData['role'],
                'guard_name' => 'api',
            ]);
        }

        $user->assignRole($request->role);

        return new UserResource($user);
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
    public function update(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id),
            ],
            'password' => 'sometimes|required|string|min:8|confirmed',
            'role' => 'required|string|in:admin,guru,murid,gurupiket,tatausaha,kepsek,kurikulum',
        ]);

        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];

        if (isset($validatedData['password'])) {
            $user->password = Hash::make($validatedData['password']);
        }

        $role = Role::findByName($validatedData['role']);

        if (!$role) {
            $role = Role::create([
                'name' => $validatedData['role'],
                'guard_name' => 'api',
            ]);
        }

        $user->syncRoles([$role]);
        $user->save();

        return new UserResource($user);
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