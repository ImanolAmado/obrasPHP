<?php

namespace App\Http\Controllers;

use App\Models\Obra;
use Illuminate\Support\Facades\DB;
use App\Models\ObraUser;
use Illuminate\Http\Request;
use \Auth;
use \Gate;

class ObraController extends Controller
{   


    public function categoria($categoria)
    {       
        // Filtramos las obras para mostrar solo los que tengan estado='aprobado'.
        $obras = Obra::all();
        $obrasAprobadas = $obras->filter(fn($item) => $item->estado == 'aprobada');

        // Aplicamos filtro de categoría
        if($categoria=='todos'){
            return response()->json($obrasAprobadas->values());
        } else {
        $obrasFiltradas = $obrasAprobadas->filter(fn($item) => $item->categoria == $categoria);                
        return response()->json($obrasFiltradas->values());
        }
    }

 
    public function store(Request $request)
    {            
        
         // lanza error 403 si el usuario tiene ya una obra en la BBDD
         if (Gate::denies('encontrarObra', Obra::class)) {
           abort(403, "¡Error! Ya has subido una obra");
        } 
               
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required',
            'imagen' => 'required|string|max:300',
            'categoria' => 'required|string|max:60',
            'estado' => 'required|string|max:10',           
        ]);            

        $obra = new Obra();
        $obra->titulo = $request->titulo;
        $obra->descripcion = $request->descripcion;
        $obra->categoria = $request->categoria;
        $obra->estado = $request->estado;
        $obra->imagen = $request->imagen;
        $obra->user_id = Auth::user()->id;
        $obra->save();

        return response()->json($obra->user_id, 201);          
       
    }

   


    public function show($id)
    {    
        return response()->json(Obra::find($id));
    }

    
    public function update(Request $request)
    {
        
        // Validar datos del request
        $validatedData = $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required',
            'imagen' => 'required|string|max:300',
            'categoria' => 'required|string|max:60',
            'estado' => 'required|string|max:10',
            'user_id' => 'required'
        ]);

        // Encontrar el registro por el id
        $obra = Obra::find($request->id);

        // Utilizamos la misma "policy" que en delete. Si el id del user
        // no concuerda con el user_id de la obra (el dueño de la obra),
        // lanza error 403 
        if (Gate::denies('deleteObra', $obra)) {
            abort(403, "No estás autorizado para modificar la obra");
         } 

        // Actualizar usando asignación masiva
        $obra->update($validatedData);

        return response()->json(['Obra actualizada exitosamente']);   
    }

   

    public function destroy($id)
    {   

         // Encontrar el registro por el id
         $obra = Obra::find($id);

        
        // Se llama a nuestra "policy". Si el id del usuario autenticado
        // no concuerda con el user_id de la obra (el dueño de la obra),
        // lanza error 403 
        if (Gate::denies('deleteObra', $obra)) {
           abort(403, "No estás autorizado para eliminar la obra");
        }       
        
        // Borrar obra
        $obra->delete();

        return response()->json(['La Obra ha sido eliminada correctamente']);        
    }


    public function masVotadas()
    {       
    
    // Consulta sin join    
    // $obras = ObraUser::select('obra_id', ObraUser::raw('SUM(voto) as total_votos'))->groupBy('obra_id')->orderBy('total_votos', 'des')->take(3)->get();
   
    // Consulta con join
    // https://www.educative.io/answers/how-to-perform-inner-join-of-two-tables-in-laravel-query

    $masVotadas = DB::table('obras')
    ->join('obra_users', 'obras.id', '=', 'obra_users.obra_id')
    ->select('id', 'obras.titulo', 'obras.categoria', 'obras.imagen', DB::raw('SUM(obra_users.voto) as total_votos'))
    ->groupBy('obra_users.obra_id')
    ->orderBy('total_votos', 'desc')
    ->take(3)
    ->get();

    return response()->json($masVotadas);        
    }
}
