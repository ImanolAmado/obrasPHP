<?php

namespace App\Http\Controllers;

use App\Models\Obra;
use Illuminate\Http\Request;
use \Auth;

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

        // Actualizar usando asignación masiva
        $obra->update($validatedData);

        return response()->json(['Obra actualizada exitosamente']);   
    }

   

    public function destroy($id)
    {    
        // Encontrar el registro por el id
        $obra = Obra::find($id);
        
        // Borrar obra
        $obra->delete();

        return response()->json(['La Obra ha sido eliminada correctamente']);        
    }
}
