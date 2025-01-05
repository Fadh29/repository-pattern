<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\PesertaController;
use App\Http\Controllers\WeatherController;
use App\Http\Controllers\AuthController;

// Routes untuk halaman web
Route::middleware(['guest'])->group(function () {
    Route::get('/login', [PesertaController::class, 'loginForm'])->name('login');
    Route::post('/login', [PesertaController::class, 'login'])->name('login.attempt');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/', function () {
        return view('index');
    })->name('home');
});

// API Routes
Route::prefix('api')->group(function () {
    Route::middleware(['guest'])->group(function () {
        Route::post('/login', [PesertaController::class, 'login'])->name('login');
    });

    Route::middleware(['auth:sanctum'])->group(function () {
        // Jurusan API
        Route::get('/jurusan', [JurusanController::class, 'index'])->name('jurusan.index');
        Route::post('/jurusan', [JurusanController::class, 'store'])->name('jurusan.store');
        Route::put('/jurusan/{id}', [JurusanController::class, 'update'])->name('jurusan.update');
        Route::delete('/jurusan/{id}', [JurusanController::class, 'destroy'])->name('jurusan.destroy');

        // Peserta API
        Route::get('/peserta', [PesertaController::class, 'index'])->name('peserta.index');
        Route::post('/peserta', [PesertaController::class, 'store'])->name('peserta.store');
        Route::get('/peserta/{id}', [PesertaController::class, 'edit'])->name('peserta.edit');
        Route::put('/peserta/{id}', [PesertaController::class, 'update'])->name('peserta.update');
        Route::delete('/peserta/{id}', [PesertaController::class, 'destroy'])->name('peserta.destroy');

        // Weather API
        Route::get('/weather', [WeatherController::class, 'index'])->name('weather.index');
        Route::get('/weather/check', [WeatherController::class, 'checkWeather'])->name('weather.check');

        // Logout API
        Route::post('/logout', [PesertaController::class, 'logout'])->name('logout');
    });
});
