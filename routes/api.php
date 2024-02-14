<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Http\Request;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::name('auth.')->prefix('auth')->group(function () {
    Route::post('register', [UsuarioController::class, 'register'])->name('register');
    Route::post('login', [AuthController::class, 'login'])->name('login');
});



Route::middleware(['jwt.verify'])->group(function () {
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('obtener-session', [AuthController::class, 'obtenerSession'])->name('obtener-session');
    Route::name('usuario.')->prefix('usuario')->group(function () {
        Route::post('register', [UsuarioController::class, 'register'])->name('register');
        Route::get('buscar/{id}', [UsuarioController::class, 'buscar'])->name('buscar');
        Route::get('lista', [UsuarioController::class, 'lista'])->name('lista');
    });
});
