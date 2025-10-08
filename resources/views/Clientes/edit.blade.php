@extends('layout.app')
@section('content')
<div>
  <form action="{{ route('Clientes.update', $cliente->id_cliente) }}" method="POST">
    @csrf
    @method('PUT')
    <div>
      <label for="cedula">Cédula</label>
      <input type="text" id="cedula" name="cedula" value="{{ $cliente->cedula }}" required>
    </div>
    <div>
      <label for="nombre">Nombre</label>
      <input type="text" id="nombre" name="nombre" value="{{ $cliente->nombre }}" required>
    </div>
    <div>
      <label for="apellido">Apellido</label>
      <input type="text" id="apellido" name="apellido" value="{{ $cliente->apellido }}" required>
    </div>
    <div>
      <button type="submit">Editar Cliente</button>
    </div>
    <a href="{{ route('Clientes.index') }}">Volver a la lista de clientes</a>
  </form>
</div>
@endsection