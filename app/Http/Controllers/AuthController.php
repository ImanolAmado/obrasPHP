<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Auth;
use App\Models\User;

class AuthController extends Controller
{
    
public function login(Request $request){

    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    if(Auth::attempt($credentials)){
        $user = Auth::user();
        $token = $user->createToken('ObrasApp')->plainTextToken;
        return response()->json(['token' => $token]);
    }
    return response()->json(['messaje' => 'No autorizado'], 401);
}


public function logout(Request $request){

    // revoca el token del usuario
    $request->user()->tokens->each(function ($token){
        $token->delete();
    });

    return response()->json(['messaje' => 'logout exitoso']);
}



public function perfil(Request $request)
    {
      // Devolvemos datos seleccionados del usuario
        $perfil = new User();
        $perfil->id = Auth::user()->id;
        $perfil->name =  Auth::user()->name;
        $perfil->email =  Auth::user()->email;  
        $perfil->created_at = Auth::user()->created_at;

        return response()->json($perfil, 201);
    }

}
