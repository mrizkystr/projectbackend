<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Permission;
use Database\Seeders\RoleTableSeeder;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Contracts\Role as ContractsRole;
use Spatie\Permission\Models\Role as ModelsRole;

class UserController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth:api')->except(['index', 'show']);
    // }

    public function index()
    {
        $users = User::all();

        return response()->json($users);
    }

    public function show(User $user)
    {
        return new UserResource($user);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|string|in:admin,guru,murid,gurupiket,tatausaha,kepsek,kurikulum',
        ]);

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
            'role' => $validatedData['role'],
        ]);

        $role = Role::where('name', $validatedData['role'])->first();

        $user->assignRole($role);

        return response()->json($user, 201);
    }

    public function update(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'sometimes|required|string|min:8|confirmed',
            'role' => 'sometimes|required|string|in:admin,guru,murid,gurupiket,tatausaha,kepsek,kurikulum',
        ]);

        if ($validatedData['email']) {
            $user->email = $validatedData['email'];
        }

        if ($validatedData['password']) {
            $user->password = bcrypt($validatedData['password']);
        }

        if ($validatedData['role']) {
            $user->role = $validatedData['role'];
            $role = Role::where('name', $validatedData['role'])->first();
            $user->syncRoles([$role->id]);
        }

        $user->save();

        return response()->json($user);
    }

    public function destroy(User $user)
    {
        $user->delete();

        return response()->json(null, 204);
    }

    // // public function assignRole(User $user, Request $request)
    // // {
    // //     $validatedData = $request->validate([
    // //         'role' => 'required|string|in:admin,guru,murid,gurupiket,tatausaha,kepsek,kurikulum',
    // //     ]);

    // //     $role = Role::where('name', $validatedData['role'])->first();

    // //     $user->assignRole($role);

    // //     return response()->json($user);
    // // }

    // // public function revokeRole(User $user, Request $request)
    // // {
    // //     $validatedData = $request->validate([
    // //         'role' => 'required|string|in:admin,guru,murid,gurupiket,tatausaha,kepsek,kurikulum',
    // //     ]);

    // //     $role = Role::where('name', $validatedData['role'])->first();

    // //     $user->removeRole($role);

    // //     return response()->json($user);
    // }
}