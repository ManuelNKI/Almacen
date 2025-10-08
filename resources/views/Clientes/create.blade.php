@extends('layout.app')
@section('content')
<div>
  <form action="{{ route('Clientes.store') }}" method="POST">
    @csrf
    <div>
      <label for="cedula">Cédula</label>
      <input type="text" id="cedula" name="cedula" required>
    </div>
    <div>
      <label for="nombre">Nombre</label>
      <input type="text" id="nombre" name="nombre" required>
    </div>
    <div>
      <label for="apellido">Apellido</label>
      <input type="text" id="apellido" name="apellido" required>
    </div>
    <div>
      <button type="submit">Crear Cliente</button>
    </div>
    <a href="{{ route('Clientes.index') }}">Volver a la lista de clientes</a>
  </form>
</div>
@endsection