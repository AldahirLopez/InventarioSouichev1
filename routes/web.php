<?php

use Illuminate\Support\Facades\Route;

//Agregamos los controladores 
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ProductosController;
use App\Http\Controllers\ObrasController;
use App\Http\Controllers\CategoriasController;
use App\Http\Controllers\SalidasController;
use App\Http\Controllers\EntradasController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('productos/listar_inventario', [App\Http\Controllers\ProductosController::class, 'listar'])->name('productos.listar_inventario');

Route::group(['middleware' => ['auth']], function(){
    Route::resource('roles', RolController::class);
    Route::resource('usuarios', UsuarioController::class);
    Route::resource('productos', ProductosController::class);
    Route::resource('obras', ObrasController::class);
    Route::resource('salidas', SalidasController::class);
    Route::resource('categorias', CategoriasController::class);
    Route::resource('entradas', EntradasController::class);
    
});


