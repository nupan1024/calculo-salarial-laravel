<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SalarioController;
use App\Http\Controllers\ClienteWebController;

Route::get('/', function () {
    return redirect()->route('salario');
});

Route::get('/salario', function () {
    return view('salario');
})->name('salario');

Route::post('/salario/calcular', [SalarioController::class, 'calcular']);

Route::prefix('admin')->group(function () {
    Route::resource('clientes', ClienteWebController::class);
});
