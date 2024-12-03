<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Adopcion;

class AdopcionController extends Controller
{
    
   public function index()
    {
        $adopciones = Adopcion::all();
        foreach ($adopciones as $adopcion) {
            if ($adopcion->imagen) {
                $adopcion->imagen_url = asset('storage/' . $adopcion->imagen);
            }
        }
        return view('adopciones', compact('adopciones'));
    }

    public function create()
    {
        return view('adopciones.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'especie' => 'required|string|max:100',
            'raza' => 'nullable|string|max:100',
            'edad' => 'nullable|integer',
            'peso' => 'nullable|numeric',
            'estado' => 'nullable|string|max:50',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:51200',
        ]);

        $imagenRuta = null;

        if ($request->hasFile('imagen')) {
            $imagenRuta = $request->file('imagen')->store('imagenes/adopciones', 'public');
        }

        Adopcion::create([
            'nombre' => $request->nombre,
            'especie' => $request->especie,
            'raza' => $request->raza,
            'edad' => $request->edad,
            'peso' => $request->peso,
            'estado' => $request->estado,
            'imagen' => $imagenRuta,
        ]);

        return redirect()->route('adopciones.index')->with('success', 'Adopción registrada con éxito.');
    }

    public function edit($id)
    {
        $adopcion = Adopcion::findOrFail($id);
        return response()->json($adopcion);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'especie' => 'required|string|max:100',
            'raza' => 'nullable|string|max:100',
            'edad' => 'nullable|integer',
            'peso' => 'nullable|numeric',
            'estado' => 'nullable|string|max:50',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:51200',
        ]);

        $adopcion = Adopcion::findOrFail($id);

        if ($request->hasFile('imagen')) {
            if ($adopcion->imagen && \Storage::disk('public')->exists($adopcion->imagen)) {
                \Storage::disk('public')->delete($adopcion->imagen);
            }
            $imagenRuta = $request->file('imagen')->store('imagenes/adopciones', 'public');
        } else {
            $imagenRuta = $adopcion->imagen;
        }

        $adopcion->update([
            'nombre' => $request->nombre,
            'especie' => $request->especie,
            'raza' => $request->raza,
            'edad' => $request->edad,
            'peso' => $request->peso,
            'estado' => $request->estado,
            'imagen' => $imagenRuta,
        ]);

        return redirect()->route('adopciones.index')->with('success', 'Adopción actualizada con éxito.');
    }

    public function destroy($id)
    {
        $adopcion = Adopcion::findOrFail($id);
        if ($adopcion->imagen && \Storage::disk('public')->exists($adopcion->imagen)) {
            \Storage::disk('public')->delete($adopcion->imagen);
        }
        $adopcion->delete();
        return redirect()->route('adopciones.index')->with('success', 'Adopción eliminada con éxito.');
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        if (empty($query)) {
            $adopciones = Adopcion::all();
        } else {
            $adopciones = Adopcion::where('nombre', 'like', '%' . $query . '%')
                ->orWhere('especie', 'like', '%' . $query . '%')
                ->get();
        }
        return response()->json(['adopciones' => $adopciones]);
    }
}



