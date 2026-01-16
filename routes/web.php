<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Central\TenantRegistrationController;

// Rutas del dominio central (login de administrador, registro de tenants, etc.)
foreach (config('tenancy.central_domains') as $domain) {
    Route::domain($domain)->middleware('web')->group(function () {
        // Página de inicio
        Route::get('/', function () {
            return view('central.welcome');
        })->name('central.home');

        // Registro de nuevos tenants
        Route::get('/register', [TenantRegistrationController::class, 'showRegistrationForm'])
            ->name('central.register');
        Route::post('/register', [TenantRegistrationController::class, 'register'])
            ->name('central.register.store');
        Route::get('/register/success', [TenantRegistrationController::class, 'success'])
            ->name('central.registration.success');
    });
}