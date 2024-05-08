<?php

use App\Http\Controllers\ArmoniaController;
use Illuminate\Support\Facades\Route;

//Agregamos los controladores 
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ProductosController;
use App\Http\Controllers\ObrasController;
use App\Http\Controllers\ObrasInfoController;
use App\Http\Controllers\CategoriasController;
use App\Http\Controllers\DocumentosLController;
use App\Http\Controllers\SalidasController;
use App\Http\Controllers\EntradasController;
use App\Http\Controllers\OperacionController;
use App\Http\Controllers\PlanosController;
use App\Http\Controllers\SouichiController;

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
Route::middleware('auth')->get('/select', function () {
    return view('select');
})->name('select');


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/mostrar-pdf/{contenidoPDF}', 'PlanoController@mostrarPDF')->name('mostrar-pdf');

Route::get('/mostrar-pdf/{contenidoPDF}', 'DocumentosController@mostrarPDF')->name('mostrar-pdf');

Route::group(['middleware' => ['auth']], function () {
    Route::resource('roles', RolController::class);
    Route::resource('usuarios', UsuarioController::class);
    Route::resource('productos', ProductosController::class);
    Route::resource('obras', ObrasController::class);
    Route::resource('obras-info', ObrasInfoController::class);
    Route::resource('salidas', SalidasController::class);
    Route::resource('categorias', CategoriasController::class);
    Route::resource('entradas', EntradasController::class);
    Route::resource('planos', PlanosController::class);
    Route::resource('documentos', DocumentosLController::class);
    Route::resource('operacion', OperacionController::class);
    Route::resource('armonia', ArmoniaController::class);
    Route::resource('souichi', SouichiController::class);
});
