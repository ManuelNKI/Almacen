<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\VentaController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('Clientes', ClienteController::class);
Route::resource('Productos', ProductoController::class);
Route::resource('Ventas', VentaController::class);
