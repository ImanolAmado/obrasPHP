<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Obra;
use Illuminate\Auth\Access\HandlesAuthorization;

class ObrasPolicy
{
    use HandlesAuthorization;


    public function deleteObra(User $user, Obra $obra){

        // Devuelve true / false
        // Si el id del usuario autenticado coincide 
        // con el propietario de la obra 
            return $user->id === $obra->user_id;
    }


    public function encontrarObra(User $user){

        // Devuelve true / false si usuario tiene ya una obra
        return !Obra::where('user_id', $user->id)->exists(); 

    }

  
    public function __construct()
    {
        //
    }
}
