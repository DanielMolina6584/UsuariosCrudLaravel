<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});
Route::get('inicio', [LoginController::class, 'index']);
Route::get('viewRegister', [LoginController::class, 'viewRegister']);
Route::post('register', [LoginController::class,'registrar']);
Route::post('iniciar', [LoginController::class,'IniciarSesion']);
Route::get('logout', [LoginController::class, 'logout']);

Route::middleware(['middleware' => 'Auth'])->group(function () {
    Route::get('crud', [UserController::class,'index']);
    Route::get('formCrear', [UserController::class,'viewCrear']);
    Route::post('crear', [UserController::class,'crearUsuario'])->middleware('Token');
    Route::post('actualizar', [UserController::class,'actualizarUsuario'])->middleware('Token');
    Route::get('obtenerId', [UserController::class,'ObtenerID']);
    Route::get('eliminar', [UserController::class,'eliminarUsuario'])->middleware('Token');
    
});