<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;


class UserPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {

        return $user->hak_akses === 'root';
    }

    public function view(User $user)
    {
        return $user->hak_akses === 'root';

    }

    public function create(User $user)
    {
        return $user->hak_akses === 'root';
    }

    public function update(User $user)
    {
        return $user->hak_akses === 'root';
    }

    public function delete(User $user)
    {
        return $user->hak_akses === 'root';

    }

    public function resetPassword(User $user)
    {
        return $user->hak_akses === 'root';
    }
}
