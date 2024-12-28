<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Models\User;
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

}
