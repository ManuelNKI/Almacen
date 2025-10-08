<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Obtener el término de búsqueda de la URL (?busqueda=...)
        $busqueda = $request->query('busqueda');

        // Iniciar la consulta al modelo Producto
        $productosQuery = Producto::query();

        // Aplicar el filtro si se proporciona un término de búsqueda
        if ($busqueda) {
            $productosQuery->where(function ($query) use ($busqueda) {
                // Usamos el operador LIKE para buscar coincidencias parciales
                // % permite buscar el texto en cualquier parte del campo
                $query->where('nombre', 'LIKE', '%' . $busqueda . '%')
                    ->orWhere('stock', '<', $busqueda); 
            });
        }

        $productos = $productosQuery->get();

        // También enviamos el término de búsqueda a la vista para que el input no se borre
        return view('Productos.index', compact('productos', 'busqueda'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Productos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'stock' => 'required',
            'precio' => 'required'
        ]);
        Producto::create($request->all());
        return redirect()->route('Productos.index')
            ->with('success', 'Producto creado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Producto $producto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $producto = Producto::findOrFail($id);
        return view('Productos.edit', compact('producto'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $producto = Producto::findOrFail($id);
        $request->validate([
            'nombre' => 'required',
            'stock' => 'required',
            'precio' => 'required'
        ]);
        $producto->update($request->all());
        return redirect()->route('Productos.index')
            ->with('success', 'Producto actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $producto = Producto::findOrFail($id);
        $producto->delete();
        return redirect()->route('Productos.index')
            ->with('success', 'Producto eliminado correctamente');
    }
}
