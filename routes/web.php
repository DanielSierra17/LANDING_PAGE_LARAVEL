<?php

use App\Http\Controllers\Usuarios\UsuarioController;
use Illuminate\Support\Facades\Route;

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
    return view('landing');
});

Route::post('/guardar-datos', [UsuarioController::class, 'createUser'])->name('guardar-datos');
Route::get('/ganador', [UsuarioController::class, 'winnerUser'])->name('ganador');
Route::get('/descargar-excel', [UsuarioController::class, 'exportar'])->name('descargar.excel');