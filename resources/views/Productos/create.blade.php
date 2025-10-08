@extends('layout.app')
@section('content')
<div>
  <form action="{{ route('Productos.store') }}" method="POST">
    @csrf
    <div>
      <label for="nombre">Nombre</label>
      <input type="text" id="nombre" name="nombre" required>
    </div>
    <div>
      <label for="precio">Precio</label>
      <input type="number" step="0.01" id="precio" name="precio" required>
    </div>
    <div>
      <label for="stock">Stock</label>
      <input type="number" id="stock" name="stock" required>
    </div>
    <div>
      <button type="submit">Crear Producto</button>
    </div>
    <a href="{{ route('Productos.index') }}">Volver a la lista de productos</a>
</div>
@endsection