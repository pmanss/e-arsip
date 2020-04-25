<?php

namespace App\Policies;

use App\Arsip;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ArsipPolicy
{
    use HandlesAuthorization;

    public function create(User $user)
    {
        if ($user->hak_akses !== 'user') {
            return true;
        }else {
            return false;
        }

    }

    public function update(User $user)
    {
        if ($user->hak_akses !== 'user') {
            return true;
        }else {
            return false;
        }
    }

    public function delete(User $user)
    {
        if ($user->hak_akses !== 'user') {
            return true;
        }else {
            return false;
        }

    }

    public function trash(User $user)
    {
        if ($user->hak_akses !== 'user') {
            return true;
        }else {
            return false;
        }

    }

    public function restore(User $user)
    {
        if ($user->hak_akses !== 'user') {
            return true;
        }else {
            return false;
        }
    }

    public function forceDelete(User $user)
    {
        if ($user->hak_akses !== 'user') {
            return true;
        }else {
            return false;
        }

    }

    public function emptyTrash(User $user)
    {
        if ($user->hak_akses !== 'user') {
            return true;
        }else {
            return false;
        }

    }
}
