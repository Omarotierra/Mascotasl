<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Producto;

class ProductoController extends Controller
{
    public function index()
    {
        $productos = Producto::all();
        return view('productos', compact('productos'));
    }

    public function create()
    {

        return view('productos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'categoria' => 'required|string|max:100',
            'cantidad' => 'required|integer|min:1',
            'precio' => 'required|numeric|min:0',
        ]);

        Producto::create([
            'nombre' => $request->nombre,
            'categoria' => $request->categoria,
            'cantidad' => $request->cantidad,
            'precio' => $request->precio,
        ]);

        return redirect()->route('productos.index')->with('success', 'Producto creado con éxito.');
    }

    public function edit($id)
    {
        $producto = Producto::findOrFail($id);
        return view('productos.edit', compact('producto'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'categoria' => 'required|string|max:100',
            'cantidad' => 'required|integer|min:1',
            'precio' => 'required|numeric|min:0',
        ]);
        $producto = Producto::findOrFail($id);
        $producto->update([
            'nombre' => $request->nombre,
            'categoria' => $request->categoria,
            'cantidad' => $request->cantidad,
            'precio' => $request->precio,
        ]);

        return redirect()->route('productos.index')->with('success', 'Producto actualizado con éxito.');
    }

    public function destroy($id)
    {
        $producto = Producto::findOrFail($id);
        $producto->delete();

        return redirect()->route('productos.index')->with('success', 'Producto eliminado con éxito.');
    }

    public function search(Request $request)
    {      
        $query = $request->input('query');
        if (empty($query)) {
            $productos = Producto::all();
        } else {
            $productos = Producto::where('nombre', 'like', '%' . $query . '%')
                ->orWhere('categoria', 'like', '%' . $query . '%')
                ->get();
        }

        return response()->json(['productos' => $productos]);
    }
}


    
