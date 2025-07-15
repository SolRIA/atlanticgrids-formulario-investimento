<?php

use App\Http\Controllers\FormularioController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('/beneficiarios', [FormularioController::class, 'beneficiarios']);
Route::get('/tipologias', [FormularioController::class, 'tipologias']);
Route::get('/distritos', [FormularioController::class, 'distritos']);
Route::get('/concelhos', [FormularioController::class, 'concelhos']);
Route::get('/freguesias', [FormularioController::class, 'freguesias']);

Route::post('/formulario', [FormularioController::class, 'registo']);

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__ . '/settings.php';
require __DIR__ . '/auth.php';
