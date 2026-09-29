<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PostulacionController;
use App\Http\Controllers\RegistroController;
use App\Http\Controllers\VacanteController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
})->name('login');


Route::controller(AuthController::class)
    ->prefix('usuario')
    ->group(function () {

        Route::post('/login', 'loginStore')
            ->name('auth.login');
        Route::post('/logout', 'logout')
            ->name('logout');
    });





Route::get('/registro', function () {
    return view('auth.register');
})->name('register');





Route::controller(RegistroController::class)
    ->prefix('registro')
    ->group(function () {

        Route::get('/profesional', 'profesional')
            ->name('register.profesional');

        Route::post('/profesional', 'profesionalStore')
            ->name('register.profesional.store');

        Route::get('/empresa', 'empresa')
            ->name('register.empresa');

        Route::post('/empresa', 'empresaStore')
            ->name('register.empresa.store');
    });


Route::middleware("auth")->controller(DashboardController::class)->prefix("portal")
    ->group(function () {
        Route::get('/', 'index')
            ->name('dashboard');
        Route::get('/perfil', 'perfil')
            ->name('perfil.profesional');

        Route::put('/perfil', [DashboardController::class, 'actualizarPerfil'])
            ->name('perfil.profesional.actualizar');
    });

Route::middleware("auth")->controller(VacanteController::class)->prefix("oportunidades")->group(function () {

    Route::get('/', 'index')
        ->name('oportunidades.index');

    Route::get('/{vacante}', 'show')
        ->name('vacantes.show');
});

Route::controller(PostulacionController::class)->prefix('mis-postulaciones')->group(function () {

    Route::get('/', 'index')
        ->name('postulaciones.index');

    Route::get('/{postulacion}', 'show')
        ->name('postulaciones.show');
});


Route::get('/vision-mision', function () {
    return view('vision-mision');
})->name('vision-mision');
