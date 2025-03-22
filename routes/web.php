<?php

use App\Http\Controllers\AtletaController;
use App\Http\Controllers\CompetenciaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RankingController;
use App\Http\Controllers\ResultadoAtletaCompetenciaController;
use Illuminate\Support\Facades\Route;

Route::get('/', [RankingController::class, 'index']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// Rutas personalizadas para ResultadoAtletaCompetenciaController
Route::get('/resultado_atleta_competencia/{atleta}', [ResultadoAtletaCompetenciaController::class, 'create_parametrizada'])->name('resultado_atleta_competencia.create_parametrizada');

Route::post('/resultado_atleta_competencia/{atleta}', [ResultadoAtletaCompetenciaController::class, 'store_parametrizada'])->name('resultado_atleta_competencia.store_parametrizada');

Route::delete('/resultado_atleta_competencia/{resultadoAtletaCompetencia}/{atleta}', [ResultadoAtletaCompetenciaController::class, 'destroy_parametrizada'])->name('resultado_atleta_competencia.destroy_parametrizada');

Route::resource('/atleta', AtletaController::class);
Route::resource('/competencia', CompetenciaController::class);
Route::resource('/ranking', RankingController::class);
Route::resource('/resultado_atleta_competencia', ResultadoAtletaCompetenciaController::class);



require __DIR__.'/auth.php';
