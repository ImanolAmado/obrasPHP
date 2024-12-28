<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Obra;
use \Auth;

class UserController extends Controller
{

    public function register(Request $request)
    {
        $request->validate([        
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',            
        ]);
              
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);        
        
        $user->save();       
        return response()->json($user, 201);   
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


    // Devuelve la obra de un usuario
public function userObra(Request $request){

    $usuario = Auth::user();    
    
    $obraUser = Obra::where('user_id', $usuario->id)->get();    

    return response()->json($obraUser, 201);
}


}
