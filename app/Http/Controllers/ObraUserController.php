<?php

namespace App\Http\Controllers;

use App\Models\ObraUser;
use \Auth;
use \Gate;
use Illuminate\Http\Request;

class ObraUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    
    // Guarda el voto de un usuario a una obra
    public function store(Request $request)
    {
        $validated = $request->validate([
            'voto' => 'required',
            'id' => 'required',                 
        ]);    

        // Desde postman se puede emitir votos superiores a 5 por
        // lo que creamos una política para evitarlo. Un usuario
        // no puede votar 2 veces a una obra porque lanzaría un
        // SQL Exception

        if (Gate::denies('votarObra',  [ObraUser::class, $request->voto])) {
            abort(403, "El voto debe ser entre 1-5");
         }       
                
        $obraUser = new ObraUser();
        $obraUser->obra_id = $request->id;
        $obraUser->user_id = Auth::user()->id;
        $obraUser->voto = $request->voto;       




        
        $obraUser->save();

        return response()->json(['Voto registrado correctamente']); 
    
    }

   
    // Si un usuario ha votado una obra concreta, devolvemos true,
    // si no, devolvemos false
    public function show($id)
    {    
    $id_user = Auth::user()->id;
    $id_obra = $id;
    $encontrado = ObraUser::where('user_id', $id_user)->where('obra_id',$id_obra)->get();      
    if(count($encontrado)==0){
    return response()->json(false);
    } else {
    return response()->json(true);
    }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ObraUser  $obraUser
     * @return \Illuminate\Http\Response
     */
    public function edit(ObraUser $obraUser)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ObraUser  $obraUser
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ObraUser $obraUser)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ObraUser  $obraUser
     * @return \Illuminate\Http\Response
     */
    public function destroy(ObraUser $obraUser)
    {
        //
    }
}
