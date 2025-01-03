<?php

namespace App\Policies;

use App\Models\User;
use App\Models\ObraUser;
use Illuminate\Auth\Access\HandlesAuthorization;

class ObraUserPolicy
{
    use HandlesAuthorization;

    public function votarObra(User $user, $voto){

        // Devuelve true / false     
            return $voto >= 1 && $voto <=5;
    }



    public function __construct()
    {
        //
    }
}
