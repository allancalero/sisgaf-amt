<?php

use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Livewire\Volt\Volt;
use App\Livewire\Proyectos;

Route::get('/', function () {
    return redirect()->route('login');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('profile.edit');
    Volt::route('settings/password', 'settings.password')->name('password.edit');
    Volt::route('settings/appearance', 'settings.appearance')->name('appearance.edit');

    Volt::route('settings/two-factor', 'settings.two-factor')
        ->middleware(
            when(
                Features::canManageTwoFactorAuthentication()
                    && Features::optionEnabled(Features::twoFactorAuthentication(), 'confirmPassword'),
                ['password.confirm'],
                [],
            ),
        )
        ->name('two-factor.show');
});


Route::get('/proyectos', Proyectos::class)
            ->name('proyectos')
            ->middleware(['auth']);

// Reports
Route::get('/report/proyectos', [\App\Http\Controllers\ReportController::class, 'exportProyectos'])
    ->name('report.proyectos')
    ->middleware(['auth']);

// Responsables placeholder route (prevents RouteNotFoundException from sidebar)
Route::view('/responsables', 'responsables.index')
    ->middleware(['auth'])
    ->name('responsables');

require __DIR__.'/auth.php';
