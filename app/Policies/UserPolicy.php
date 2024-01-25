<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('lihat-user');
    }

    public function view(User $user, User $model)
    {
        return $user->hasPermissionTo('lihat-user');
    }

    public function create(User $user)
    {
        return $user->hasPermissionTo('tambah-user');
    }

    public function update(User $user, User $model)
    {
        return $user->hasPermissionTo('edit-user') && $user->id === $model->id;
    }

    public function delete(User $user, User $model)
    {
        return $user->hasPermissionTo('hapus-user') && $user->id === $model->id;
    }

    // Add similar methods for other user-related permissions
}