<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
                // Obtener el término de búsqueda de la URL (?busqueda=...)
        $busqueda = $request->query('busqueda'); 

        // Iniciar la consulta al modelo Cliente
        $clientesQuery = Cliente::query();

        // Aplicar el filtro si se proporciona un término de búsqueda
        if ($busqueda) {
            $clientesQuery->where(function ($query) use ($busqueda) {
                // Usamos el operador LIKE para buscar coincidencias parciales
                // % permite buscar el texto en cualquier parte del campo
                $query->where('nombre', 'LIKE', '%' . $busqueda . '%')
                        ->orWhere('apellido', 'LIKE', '%' . $busqueda . '%')
                        ->orWhere('cedula', 'LIKE', '%' . $busqueda . '%'); // Opcional: filtro por cédula
            });
            
            // Opcional: si quieres que la búsqueda no sea sensible a mayúsculas y minúsculas
            // es mejor asegurarse de que las columnas tengan collation 'utf8mb4_unicode_ci' o usar LOWER() si la DB lo soporta.
        }

        // Obtener los resultados finales
        $clientes = $clientesQuery->get();
        
        // También enviamos el término de búsqueda a la vista para que el input no se borre
        return view('Clientes.index', compact('clientes', 'busqueda')); 
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Clientes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'cedula' => 'required | unique:clientes,cedula',
            'nombre' => 'required',
            'apellido' => 'required'
        ]);
        Cliente::create($request->all());
        return redirect()->route('Clientes.index')
            ->with('success', 'cliente creado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Cliente $cliente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $cliente = Cliente::findOrFail($id);
        return view('Clientes.edit', compact('cliente'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $cliente = Cliente::findOrFail($id);
        $request->validate([
            'cedula' => 'required',
            'nombre' => 'required',
            'apellido' => 'required'
        ]);
        $cliente->update($request->all());
        return redirect()->route('Clientes.index')
            ->with('success', 'Cliente actualizado éxitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $cliente = Cliente::findOrFail($id);
        $cliente->delete();
        return redirect()->route('Clientes.index')
            ->with('success', 'Cliente eliminado éxitosamente');
    }
}
