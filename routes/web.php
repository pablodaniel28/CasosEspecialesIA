<?php

use App\Http\Controllers\AsistenteController;
use App\Http\Controllers\CalendarioController;
use App\Http\Controllers\CarreraController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DataFeedController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DirectorController;
use App\Http\Controllers\MensajeController;
use App\Http\Controllers\SolicitudController;
use App\Http\Controllers\VerificacionController;
use App\Models\verificacion;

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

Route::redirect('/', 'login');

Route::get('/registrar', [VerificacionController::class, 'create'])->name('verificacion.create');
Route::post('/verificacion', [VerificacionController::class, 'store'])->name('verificacion.store');

Route::middleware(['auth:sanctum', 'verified'])->group(function () {

    // Route for the getting the data feed
    Route::get('/json-data-feed', [DataFeedController::class, 'getDataFeed'])->name('json_data_feed');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/analytics', [DashboardController::class, 'analytics'])->name('analytics');
    Route::get('/dashboard/fintech', [DashboardController::class, 'fintech'])->name('fintech');

    Route::resource('solicitud', SolicitudController::class);
    Route::resource('mensaje', MensajeController::class);
    Route::resource('director', DirectorController::class);
    Route::resource('carrera', CarreraController::class);
    Route::resource('calendario', CalendarioController::class);
    Route::resource('asistente', AsistenteController::class);

    Route::fallback(function() {
        return view('pages/utility/404');
    });
});
