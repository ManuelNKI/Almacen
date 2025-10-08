<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use App\Models\Cliente;
use App\Models\Producto;
use Illuminate\Http\Request;

class VentaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // 1. Obtener y limpiar el término de búsqueda
        $busqueda = $request->query('busqueda');

        // 2. Iniciar la consulta con las relaciones
        $ventasQuery = Venta::with(['cliente', 'producto']);

        // 3. Aplicar filtro si hay búsqueda
        if (trim($busqueda)) {
            $ventasQuery->where(function ($query) use ($busqueda) {
                $searchTerm = '%' . $busqueda . '%';
                $query->where('cliente_ced', 'LIKE', $searchTerm)
                    ->orWhereHas('cliente', function ($q) use ($searchTerm) {
                        $q->where('nombre', 'LIKE', $searchTerm)
                            ->orWhere('apellido', 'LIKE', $searchTerm);
                    })
                    ->orWhereHas('producto', function ($q) use ($searchTerm) {
                        $q->where('nombre', 'LIKE', $searchTerm);
                    });
            });
        }

        // 4. Obtener los resultados finales
        $ventas = $ventasQuery->get();

        // 🔹 5. Retornar vista con los datos
        return view('Ventas.index', compact('ventas', 'busqueda'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clientes = Cliente::all();
        $productos = Producto::all();
        return view('Ventas.create', compact('clientes', 'productos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'cliente_ced' => 'required',
            'id_producto' => 'required',
            'cantidad' => 'required'
        ]);
        $producto = Producto::findOrFail($request->id_producto);
        $cantidadVendida = $request->cantidad;
        if ($cantidadVendida > $producto->stock) {
            return redirect()->route('Ventas.create')
                ->with('error', 'Stock insuficiente para el producto seleccionado.');
        }
        Venta::create($request->all());
        $producto->stock = $producto->stock - $cantidadVendida;
        $producto->save();
        return redirect()->route('Ventas.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Venta $venta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Venta $venta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Venta $venta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Venta $venta)
    {
        //
    }
}
