@extends('layout.app')

@section('content')
<div>
  <h1>CRUD de Clientes</h1>
    <a href="{{ route('Ventas.index')}}">
    Registro de Ventas
  </a>
    <a href="{{ route('Productos.index')}}">
    Gestión de Productos
  </a>
  {{-- Formulario de Búsqueda --}}
  <div>
    <form action="{{ route('Clientes.index') }}" method="GET">
      <input
        type="text"
        name="busqueda"
      >
      <button type="submit" class="btn btn-primary">Buscar</button>

      @if ($busqueda)
      <a href="{{ route('Clientes.index') }}">Limpiar Filtro</a>
      @endif
    </form>
  </div>
  <a href="{{ route('Clientes.create') }}">Crear Cliente</a>
  @if(session('success'))
  <div class="alert alert-success"> {{ session('success') }} </div>
  @endif
  <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>CEDULA</th>
        <th>NOMBRE</th>
        <th>APELLIDO</th>
      </tr>
    </thead>
    <tbody>
      @forelse($clientes as $cliente)
      <tr>
        <td>{{$cliente->id_cliente}}</td>
        <td>{{$cliente->cedula}}</td>
        <td>{{$cliente->nombre}}</td>
        <td>{{$cliente->apellido}}</td>
        <td>
          <form action="{{ route('Clientes.destroy', $cliente->id_cliente) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit">Eliminar</button>
          </form>
          <a href="{{ route('Clientes.edit', $cliente->id_cliente) }}">Editar</a>
        </td>
      </tr>
      @empty
      <tr>
        <td> No hay estudiantes</td>
      </tr>
      @endforelse
    </tbody>
  </table>
</div>
@endsection