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

    Route::get('/paciente/{id}/editar', [VirasoroController::class, 'pacienteEditar'])->name('pacienteEditar');

    Route::put('/paciente/{id}/editar/guardar', [VirasoroController::class, 'pacienteEditarGuardar'])->name('pacienteEditarGuardar');

    Route::delete('/paciente/{id}/eliminar', [VirasoroController::class, 'pacienteEliminar'])->name('pacienteEliminar');

    Route::get('/paciente/{id}/nuevo-estudio', [VirasoroController::class, 'pacienteNuevoEstudio'])->name('pacienteNuevoEstudio');

    Route::get('/paciente/{id}/nuevo-estudio/{estudio_id}', [VirasoroController::class, 'pacienteNuevoEstudio2'])->name('pacienteNuevoEstudio2');

    Route::get('/paciente/estudio/editar/{id}', [VirasoroController::class, 'pacienteEditarEstudio'])->name('pacienteEditarEstudio');

    Route::put('/paciente/estudio/editar/{id}/guardar', [VirasoroController::class, 'pacienteEditarEstudio2'])->name('pacienteEditarEstudio2');

    Route::post('/paciente/nuevo-estudio/guardar', [VirasoroController::class, 'pacienteNuevoEstudio3'])->name('pacienteNuevoEstudio3');

    Route::get('/estudio/{id}', [VirasoroController::class, 'estudioVer'])->name('estudioVer');

    Route::get('/estudio/{id}/descargar', [VirasoroController::class, 'estudioDescargar'])->name('estudioDescargar');

    Route::get('/estudio/{id}/imprimir', [VirasoroController::class, 'estudioImprimir'])->name('estudioImprimir');

    Route::delete('/estudio/{id}/eliminar', [VirasoroController::class, 'estudioEliminar'])->name('estudioEliminar');

    Route::delete('/estudio/{id}/estudioEliminarB', [VirasoroController::class, 'estudioEliminarB'])->name('estudioEliminarB');




});

require __DIR__.'/auth.php';

