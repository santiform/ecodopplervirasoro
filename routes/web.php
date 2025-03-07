<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\VirasoroController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('index');
    }

    return redirect()->route('login');
});

Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

Route::post('login', [AuthenticatedSessionController::class, 'store']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/index', [VirasoroController::class, 'index'])->name('index');

    Route::get('/pacientes', [VirasoroController::class, 'pacientes'])->name('pacientes');

    Route::get('/pacientes/nuevo', [VirasoroController::class, 'pacientesNuevo'])->name('pacientesNuevo');

    Route::post('/pacientes/nuevo/guardar', [VirasoroController::class, 'pacientesNuevoGuardar'])->name('pacientesNuevoGuardar');

    Route::get('/paciente/{id}', [VirasoroController::class, 'pacienteLegajo'])->name('pacienteLegajo');





});

require __DIR__.'/auth.php';

