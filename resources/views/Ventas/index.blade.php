@extends('layout.app')
@section('content')
<div>
  <a href="{{ route('Clientes.index')}}">
    Gestión de Clientes
  </a>
    <a href="{{ route('Productos.index')}}">
    Gestión de Productos
  </a>
  <h1>Registro de Ventas</h1>
  {{-- Formulario de Búsqueda --}}
  <div>
    <form action="{{ route('Ventas.index') }}" method="GET">
      <input
        type="text"
        name="busqueda"
        value="{{ $busqueda ?? '' }}" {{-- ¡Agrega esto! Si $busqueda es null, usa string vacío --}}
        placeholder="Cédula, Cliente o Producto">
      <button type="submit">Buscar</button>

      @if ($busqueda)
      <a href="{{ route('Ventas.index') }}">Limpiar Filtro</a>
      @endif
    </form>
  </div>
  <a href="{{ route('Ventas.create') }}">Nueva Venta</a>
  <div>
    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>Producto</th>
          <th>Cliente</th>
          <th>Cantidad</th>
        </tr>
      </thead>
      <tbody>
        @forelse($ventas as $venta)
        <tr>
          <td> {{ $venta->id }} </td>
          <td> {{ $venta->producto->nombre ?? 'Producto Eliminado' }} </td>
          <td> {{ $venta->cliente->nombre ?? 'Cliente Eliminado' }} </td>
          <td> {{ $venta->cantidad }} </td>
        </tr>

        @empty
        <tr>
          <td>No hay ventas</td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection