<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PrincipalController;
use App\Http\Controllers\ServicioController;
use App\Http\Controllers\MascotaController;
use App\Http\Controllers\CitaController;
use App\Http\Controllers\AdopcionController;
use App\Http\Controllers\ProductoController;

Route::get('/', [PrincipalController::class, 'index']);
Route::get('/nosotros', [PrincipalController::class, 'nosotros']);
Route::get('/citasf', [PrincipalController::class, 'citas']);
Route::get('/serviciosf', [PrincipalController::class, 'servicios']);
Route::get('/mascotasf', [PrincipalController::class, 'mascotas']);
Route::get('/adopcionesf', [PrincipalController::class, 'adopcion']);

// Rutas de Servicios
Route::get('/servicios', [ServicioController::class, 'index'])->name('servicios.index');
Route::post('/servicios', [ServicioController::class, 'store'])->name('servicios.store');
Route::get('/servicios/{id}/edit', [ServicioController::class, 'edit'])->name('servicios.edit');
Route::put('/servicios/{id}', [ServicioController::class, 'update'])->name('servicios.update');
Route::delete('/servicios/{id}', [ServicioController::class, 'destroy'])->name('servicios.destroy');
Route::get('/servicios/search', [ServicioController::class, 'search'])->name('servicios.search');

// Rutas de Mascotas
Route::get('/mascotas', [MascotaController::class, 'index'])->name('mascotas.index'); 
Route::get('/mascotas/create', [MascotaController::class, 'create'])->name('mascotas.create'); 
Route::post('/mascotas', [MascotaController::class, 'store'])->name('mascotas.store'); 
Route::get('/mascotas/{id}/edit', [MascotaController::class, 'edit'])->name('mascotas.edit'); 
Route::put('/mascotas/{id}', [MascotaController::class, 'update'])->name('mascotas.update'); 
Route::delete('/mascotas/{id}', [MascotaController::class, 'destroy'])->name('mascotas.destroy'); 
Route::get('/mascotas/search', [MascotaController::class, 'search'])->name('mascotas.search'); 

// Rutas de Citas
Route::get('/citas', [CitaController::class, 'index'])->name('citas.index');     
Route::get('/citas/create', [CitaController::class, 'create'])->name('citas.create');  
Route::post('/citas', [CitaController::class, 'store'])->name('citas.store');   
Route::get('/citas/{id}/edit', [CitaController::class, 'edit'])->name('citas.edit'); 
Route::put('/citas/{id}', [CitaController::class, 'update'])->name('citas.update');  
Route::delete('/citas/{id}', [CitaController::class, 'destroy'])->name('citas.destroy');  
Route::get('/citas/search', [CitaController::class, 'search'])->name('citas.search'); 

// Rutas de Adopciones
Route::get('/adopciones', [AdopcionController::class, 'index'])->name('adopciones.index');     
Route::get('/adopciones/create', [AdopcionController::class, 'create'])->name('adopciones.create');  
Route::post('/adopciones', [AdopcionController::class, 'store'])->name('adopciones.store');   
Route::get('/adopciones/{id}/edit', [AdopcionController::class, 'edit'])->name('adopciones.edit'); 
Route::put('/adopciones/{id}', [AdopcionController::class, 'update'])->name('adopciones.update');  
Route::delete('/adopciones/{id}', [AdopcionController::class, 'destroy'])->name('adopciones.destroy');  
Route::get('/adopciones/search', [AdopcionController::class, 'search'])->name('adopciones.search'); 

//Rustas de Productos
Route::get('/productos', [ProductoController::class, 'index'])->name('productos.index');     
Route::get('/productos/create', [ProductoController::class, 'create'])->name('productos.create');  
Route::post('/productos', [ProductoController::class, 'store'])->name('productos.store');   
Route::get('/productos/{id}/edit', [ProductoController::class, 'edit'])->name('productos.edit'); 
Route::put('/productos/{id}', [ProductoController::class, 'update'])->name('productos.update');  
Route::delete('/productos/{id}', [ProductoController::class, 'destroy'])->name('productos.destroy');  
Route::get('/productos/search', [ProductoController::class, 'search'])->name('productos.search'); 
