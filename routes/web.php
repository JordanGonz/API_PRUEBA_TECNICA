<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CargoController;
use App\Http\Controllers\DepartamentoController;
use App\Http\Controllers\UserController;


///Rutas del controlador de Cargo
Route::get('api/mostrartodoscargos', [CargoController::class, 'index']);
Route::post('api/crear-cargos', [CargoController::class, 'crear']);
Route::get('api/cargos/{id}', [CargoController::class, 'mostrar']);
Route::put('api/actualizar-cargos/{id}', [CargoController::class, 'actualizar']);
Route::delete('api/eliminar-cargos/{id}', [CargoController::class, 'eliminar']);


///Rutas del controlador de departamentos
Route::get('api/mostrartodosdepartamentos', [DepartamentoController::class, 'index']);
Route::post('api/crear-departamentos', [DepartamentoController::class, 'crear']);
Route::get('api/departamentos/{id}', [DepartamentoController::class, 'mostrar']);
Route::put('api/actualizar-departamentos/{id}', [DepartamentoController::class, 'actualizar']);
Route::delete('api/eliminar-departamentos/{id}', [DepartamentoController::class, 'eliminar']);

///Rutas del controlador de users
Route::get('api/mostrartodosusers', [UserController::class, 'index']);
Route::post('api/crear-users', [UserController::class, 'crear']);
Route::get('api/users/{id}', [UserController::class, 'mostrar']);
Route::put('api/actualizar-users/{id}', [UserController::class, 'actualizar']);
Route::delete('api/eliminar-users/{id}', [UserController::class, 'eliminar']);
