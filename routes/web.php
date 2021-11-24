<?php

use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\EspecialidadController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Auth;
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
    // return view('welcome');
    return redirect()->route("home");
});

Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


/* mis rutas */

//USUARIO
Route::get('usuario-index',[UsuarioController::class,'index'])->name('usuario.index')->middleware('verified');
Route::get('usuario-create',[UsuarioController::class,'create'])->name('usuario.create')->middleware('verified');
Route::post('usuario-store',[UsuarioController::class,'store'])->name('usuario.store')->middleware('verified');
Route::get('usuario-edit-{id}',[UsuarioController::class,'edit'])->name('usuario.edit')->middleware('verified');
Route::post('usuario-update',[UsuarioController::class,'update'])->name('usuario.update')->middleware('verified');
Route::get('usuario-destroy-{id}',[UsuarioController::class,'destroy'])->name('usuario.destroy')->middleware('verified');


//empresa
Route::get('empresa-index',[EmpresaController::class,'index'])->name('empresa.index')->middleware('verified');
Route::post('empresa-update-{id}',[EmpresaController::class,'update'])->name('empresa.update')->middleware('verified');

//ESPECIALIDAD
Route::get('especialidad-index',[EspecialidadController::class,'index'])->name('especialidad.index')->middleware('verified');
Route::get('especialidad-create',[EspecialidadController::class,'create'])->name('especialidad.create')->middleware('verified');
Route::post('especialidad-store',[EspecialidadController::class,'store'])->name('especialidad.store')->middleware('verified');
Route::get('especialidad-edit-{id}',[EspecialidadController::class,'edit'])->name('especialidad.edit')->middleware('verified');
Route::post('especialidad-update',[EspecialidadController::class,'update'])->name('especialidad.update')->middleware('verified');
Route::get('especialidad-destroy-{id}',[EspecialidadController::class,'destroy'])->name('especialidad.destroy')->middleware('verified');
