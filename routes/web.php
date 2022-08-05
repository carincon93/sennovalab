<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\AppController;
use App\Http\Controllers\UserInternoController;
use App\Http\Controllers\UserExternoController;
use App\Http\Controllers\LineaDesarrolloController;
use App\Http\Controllers\TipoServicioController;

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
    return Inertia::render('Welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    Route::resource('/servicios', ServicioController::class)->parameters(['servicios' => 'servicio']);

    Route::get('/users', [AppController::class, 'usersIndex'])->name('users.index');
    Route::delete('/users/{user}', [AppController::class, 'destroyUser'])->name('users.destroy');
    Route::resource('/users-externos', UserExternoController::class)->except(['index', 'destroy'])->parameters(['users-externos' => 'user-externo']);
    Route::resource('/users-internos', UserInternoController::class)->except(['index', 'destroy'])->parameters(['users-internos' => 'user-interno']);

    Route::resource('/lineas-desarrollo', LineaDesarrolloController::class)->parameters(['lineas-desarrollo' => 'linea-desarrollo']);

    Route::resource('/tipos-servicios', TipoServicioController::class)->parameters(['tipos-servicios' => 'tipo-servicio']);
});

require __DIR__ . '/auth.php';
