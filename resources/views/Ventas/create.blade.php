@extends('layout.app')
@section('content')

<div>
  <h1>Registrar Ventas</h1>
  <form action="{{ route('Ventas.store') }}" method="POST">
    @csrf {{-- ¡Importante! No olvides el token CSRF para formularios POST --}}

    <div>
      <label for="cantidad">Cantidad</label>
      <input type="text" name="cantidad" id="cantidad">
    </div>

    <div>
      <label for="cliente_ced">Cliente</label>
      <select name="cliente_ced" id="cliente_ced"> 
        <option value="" selected disabled>Seleccione un cliente</option>

        @forelse($clientes as $cliente)
        <option value="{{ $cliente->cedula}}">
          {{ $cliente->nombre }} {{ $cliente->apellido }}
        </option>
        @empty
        <option value="" disabled>No hay clientes registrados</option>
        @endforelse
      </select>
    </div>

    <div>
      <label for="id_producto">Producto</label>
      <select name="id_producto" id="id_producto" class="form-select">
        <option value="" selected disabled>Seleccione un producto</option>
        @forelse($productos as $producto)
        <option value="{{ $producto->id_producto }}">
          {{ $producto->nombre}} (Stock: {{ $producto->stock }})
        </option>
        @empty
        <option value="" disabled>No hay productos registrados</option>
        @endforelse
      </select>
    </div>

    <button type="submit">Registrar Venta</button>
  </form>
</div>
@endsection