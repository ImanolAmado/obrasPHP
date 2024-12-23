<?php

namespace App\Http\Controllers;

use App\Models\Obra;
use Illuminate\Http\Request;

class ObraController extends Controller
{   


    public function index()
    {
        //return response()->json(Obra::all());

        // filtramos las obras para mostrar solo las "aprobadas"
        $obras = Obra::all();
        $obrasFiltradas = $obras->filter(fn($item) => $item->estado == 'aprobada');
        
        return response()->json($obrasFiltradas);

    }

    

 
    public function store(Request $request)
    {
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required',
            'imagen' => 'required|string|max:300',
            'categoria' => 'required|string|max:60',
            'estado' => 'required|string|max:10',
            'user_id' => 'required'
        ]);
    
        $obra = Obra::create($validated);
        return response()->json($obra, 201);    
    }

   


    public function show($id)
    {    
        return response()->json(Obra::find($id));
    }

   
    


    public function update(Request $request, $id)
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
        $obra = Obra::find($id);

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
