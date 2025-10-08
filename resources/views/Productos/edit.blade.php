@extends('layout.app')
@section('content')
<div>
  <form action="{{ route('Productos.update', $producto->id_producto) }}" method="POST">
    @csrf
    @method('PUT')
    <div>
      <label for="nombre">Nombre</label>
      <input type="text" id="nombre" name="nombre" value="{{  $producto->nombre }}" required>
    </div>
    <div>
      <label for="precio">Precio</label>
      <input type="number" step="0.01" id="precio" name="precio" value="{{ $producto->precio }}" required>
    </div>
    <div>
      <label for="stock">Stock</label>
      <input type="number" id="stock" name="stock" value="{{  $producto->stock }}" required>
    </div>
    <div>
      <button type="submit">Editar Producto</button>
    </div>
    <a href="{{ route('Productos.index') }}">Volver a la lista de productos</a>
</div>
@endsection