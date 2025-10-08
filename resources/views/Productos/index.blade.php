@extends('layout.app')
@section('content')
<div>
  <a href="{{ route('Clientes.index')}}">
    Gestión de Clientes
  </a>
  <a href="{{ route('Ventas.index')}}">
    Registro de Ventas
  </a>
  @if(session('success'))
  <div class="alert alert-success"> {{ session('success') }} </div>
  @endif
  {{-- Formulario de Búsqueda --}}
  <div>
    <form action="{{ route('Productos.index') }}" method="GET">
      <input
        type="text"
        name="busqueda">
      <button type="submit" class="btn btn-primary">Buscar</button>

      @if ($busqueda)
      <a href="{{ route('Productos.index') }}">Limpiar Filtro</a>
      @endif
    </form>
  </div>
  <a href="{{ route('Productos.create') }}">Crear nuevo producto</a>
  <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>NOMBRE</th>
        <th>STOCK</th>
        <th>PRECIO</th>
      </tr>
    </thead>
    <tbody>
      @forelse($productos as $producto)
      <tr>
        <td>{{ $producto->id_producto }}</td>
        <td>{{ $producto->nombre }}</td>
        <td>{{ $producto->stock }}</td>
        <td>{{ $producto->precio }}</td>
        <td>
          <form action="{{ route('Productos.destroy', $producto->id_producto) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit">Eliminar</button>
          </form>
          <a href="{{ route('Productos.edit', $producto->id_producto) }}">Editar</a>
        </td>
      </tr>
      @empty
      <tr>
        <td>No hay productos disponibles.</td>
      </tr>
      @endforelse
    </tbody>
  </table>
</div>
@endsection