<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;
use App\Http\Controllers\prefectoController;
use Illuminate\Support\Facades\Auth;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    //return view('welcome');
    return view('bienvenida');
});

Auth::routes();

//Route::get('/', [App\Http\Controllers\Auth\LoginController::class])->name('login');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/test', [App\Http\Controllers\HomeController::class, 'test'])->name('test');

//Route::get('/prefectura/edit', [App\Http\Controllers\prefectoController::class, 'crudPrefecto'])->name('crudPrefecto');
//Route::get('/prefectura/asistencia', [App\Http\Controllers\prefectoController::class, 'asistenciaDocente'])->name('asistenciaDocente');
//Route::get('/prefectura/reportes', [App\Http\Controllers\prefectoController::class, 'reportesDocente'])->name('reportesDocente');

Route::group(['middleware' => ['role:jefe']], function () {
    Route::get('/prefectura/edit', [prefectoController::class, 'crudPrefecto'])->name('crudPrefecto');
    Route::get('/prefectura/reportes', [prefectoController::class, 'reportesDocente'])->name('reportesDocente');
});


Route::group(['middleware' => ['role:prefecto']], function () {
    Route::get('/prefectura/asistencia', [prefectoController::class, 'asistenciaDocente'])->name('asistenciaDocente');
});

