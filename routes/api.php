<?php

use App\Http\Controllers\Usuarios\UsuarioController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::group(['prefix' => 'Users', 'controller' => UsuarioController::class], function () {
    Route::post('/CreateUser', 'createUser');
    Route::get('/WinnerUser', 'winnerUser');
});