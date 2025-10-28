<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SalarioController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\FacturaController;

Route::post('/salario/calcular', [SalarioController::class, 'calcular']);

Route::apiResource('clientes', ClienteController::class);

Route::apiResource('productos', ProductoController::class);

Route::get('/facturas', [FacturaController::class, 'index']);
Route::get('/facturas/{id}', [FacturaController::class, 'show']);
