<?php

namespace App\Policies;

use App\Instansi;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class InstansiPolicy
{
    use HandlesAuthorization;

    public function update(User $user)
    {
        return $user->hak_akses === 'root';
    }

}
