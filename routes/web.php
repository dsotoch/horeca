<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DirectorioController;
use App\Http\Controllers\EmpresaOportunidadController;
use App\Http\Controllers\OportunidadController;
use App\Http\Controllers\PostulacionController;
use App\Http\Controllers\ProfesionalController;
use App\Http\Controllers\ProfesionalOportunidadController;
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

Route::middleware("auth")->controller(VacanteController::class)->prefix("oportunidades_profesional")->group(function () {

    Route::get('/', 'index')
        ->name('oportunidades_profesional.index');

    Route::get('/{vacante}', 'show')
        ->name('oportunidades_profesional.show');
});

Route::controller(PostulacionController::class)->prefix('mis-postulaciones')->group(function () {

    Route::get('/', 'index')
        ->name('postulaciones.index');

    Route::get('/{postulacion}', 'show')
        ->name('postulaciones.show');
});
Route::middleware(['auth'])->group(function () {

    Route::resource('oportunidades', OportunidadController::class)
        ->parameters([
            'oportunidades' => 'oportunidad',
        ]);
    Route::get(
        '/profesionales',
        [ProfesionalController::class, 'index']
    )->name('profesionales.index');

    Route::get(
        '/profesionales/{profesional}',
        [ProfesionalController::class, 'show']
    )->name('profesionales.show');

    Route::get(
        '/profesional/oportunidades',
        [ProfesionalOportunidadController::class, 'index']
    )->name('profesional.oportunidades.index');


    Route::get(
        '/profesional/oportunidades/{oportunidad}',
        [ProfesionalOportunidadController::class, 'show']
    )->name('profesional.oportunidades.show');
    Route::post(
        '/profesional/oportunidades/{oportunidad}/postular',
        [ProfesionalOportunidadController::class, 'postular']
    )->name('profesional.oportunidades.postular');
    Route::get(
        '/profesional/postulaciones',
        [ProfesionalOportunidadController::class, 'postulaciones']
    )->name('profesional.postulaciones.index');

    Route::get(
        '/empresa/oportunidades/{oportunidad}/postulaciones',
        [EmpresaOportunidadController::class, 'postulaciones']
    )->name('empresa.oportunidades.postulaciones');

    Route::patch(
        '/empresa/postulaciones/{postulacion}/estado',
        [EmpresaOportunidadController::class, 'actualizarEstadoPostulacion']
    )->name('empresa.postulaciones.estado');
    Route::get(
        '/empresa/postulaciones',
        [EmpresaOportunidadController::class, 'todasPostulaciones']
    )->name('empresa.postulaciones.index');
    Route::get(
        '/empresa/postulaciones/{postulacion}/profesional',
        [EmpresaOportunidadController::class, 'verPerfilProfesional']
    )->name('empresa.postulaciones.profesional');

        Route::get(
        '/directorio/empresas',
        [DirectorioController::class, 'empresas']
    )->name('directorio.empresas.index');

    Route::get(
        '/directorio/empresas/{empresa}',
        [DirectorioController::class, 'empresa']
    )->name('directorio.empresas.show');

});

Route::get('/vision-mision', function () {
    return view('vision-mision');
})->name('vision-mision');
