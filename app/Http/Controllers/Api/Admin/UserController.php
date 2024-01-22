<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function tambahUser()
    {
        $this->authorize('tambah-user'); // Check permission using Laravel Gates/Policies
        // Logic for adding a user
    }

    public function editUser(User $user)
    {
        $this->authorize('edit-user', $user);
        // Logic for editing a user
    }

    public function hapusUser(User $user)
    {
        $this->authorize('hapus-user', $user);
        // Logic for deleting a user
    }

    public function lihatUser(User $user)
    {
        $this->authorize('lihat-user', $user);
        // Logic for viewing a user
    }

    // Add similar methods for other user-related permissions

    // Example method for checking if the current user has a specific permission
    public function checkPermission()
    {
        if (Auth::user()->hasPermissionTo('tambah-user')) {
            return "User has permission to add a user";
        } else {
            return "User does not have permission to add a user";
        }
    }
}
