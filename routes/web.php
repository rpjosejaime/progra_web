<?php

use Illuminate\Support\Facades\Route;
//use App\Http\Controllers;
use App\Http\Controllers\prefectoController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReporteController;
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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/cambiar-contrasena', [App\Http\Controllers\Auth\ChangePasswordController::class, 'showChangePasswordForm'])->name('cambiar-contrasena')->middleware('auth');;
Route::post('/cambiar-contrasena', [App\Http\Controllers\Auth\ChangePasswordController::class, 'changePassword'])->name('cambiar-contrasena.post')->middleware('auth');;


//Route::get('/test', [App\Http\Controllers\HomeController::class, 'test'])->name('test');

//Route::get('/prefectura/edit', [App\Http\Controllers\prefectoController::class, 'crudPrefecto'])->name('crudPrefecto');
//Route::get('/prefectura/asistencia', [App\Http\Controllers\prefectoController::class, 'asistenciaDocente'])->name('asistenciaDocente');
//Route::get('/prefectura/reportes', [App\Http\Controllers\prefectoController::class, 'reportesDocente'])->name('reportesDocente');

Route::group(['middleware' => ['role:jefe|admin']], function () {
    Route::get('/prefectura/edit', [prefectoController::class, 'crudPrefecto'])->name('crudPrefecto');
    Route::get('/prefectura/reportes', [prefectoController::class, 'reportesDocente'])->name('reportesDocente2');
    Route::get('/prefectura/listado', [ReporteController::class, 'index'])->name('reportesDocente');
    Route::get('/prefectura/listado_docentes', [ReporteController::class, 'listadoDocente'])->name('listadoDocente');


    //Ruta para añadir un nuevo prefecto
    Route::get("/anadir-prefecto", [App\Http\Controllers\Auth\RegisterController::class, "createUser"])->name("createUser");
    //Ruta para eliminar un prefecto
    Route::get("/eliminar-prefecto-{RFC}", [App\Http\Controllers\Auth\RegisterController::class, "delete"])->name("crud.delete");
    //Ruta para modificar un prefecto
    Route::get("/modificar-prefecto-{RFC}", [App\Http\Controllers\Auth\RegisterController::class, "updatePrefecto"])->name("crud.update");
    //Route::get("/modificar-prefecto-{RFC}", [prefectoController::class, 'updatePrefecto'])->name("crud.update");
});

Route::get('/test', [HomeController::class, 'test'])->name('test');


Route::group(['middleware' => ['role:prefecto|admin']], function () {
    Route::get('/prefectura/asistencia', [prefectoController::class, 'asistenciaDocente'])->name('asistenciaDocente');
    Route::get('/prefectura/asistencia_edificio', [prefectoController::class, 'horarioEdificio'])->name('horarioEdificio');
    Route::post('/guardar-asistencia', [prefectoController::class, 'guardarAsistencia'])->name('guardarAsistencia');
    Route::post('/prefectura/agregar-observacion', [prefectoController::class, 'agregarObservacion'])->name('agregarObservacion');
});
