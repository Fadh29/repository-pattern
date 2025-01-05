<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\PesertaController;
use App\Http\Controllers\WeatherController;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
// Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
// Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Route::get('/jurusan', [JurusanController::class, 'index'])->name('jurusan.index');
// Route::post('/jurusan', [JurusanController::class, 'store'])->name('jurusan.store');
// Route::put('/jurusan/{id}', [JurusanController::class, 'update'])->name('jurusan.update');
// Route::delete('/jurusan/{id}', [JurusanController::class, 'destroy'])->name('jurusan.destroy');

// Route::get('/data-peserta', [PesertaController::class, 'index'])->name('peserta.index');
// Route::get('/input-peserta', [PesertaController::class, 'create'])->name('input-peserta');
// Route::post('/input-peserta', [PesertaController::class, 'store'])->name('peserta.store');
// Route::put('/update-peserta', [PesertaController::class, 'update'])->name('peserta.update');

// Route::get('/data-peserta', [PesertaController::class, 'index'])->name('peserta.index');
// Route::get('/input-peserta', [PesertaController::class, 'create'])->name('input-peserta');
// Route::post('/input-peserta', [PesertaController::class, 'store'])->name('peserta.store');
// Route::get('/edit-peserta/{id}', [PesertaController::class, 'edit'])->name('peserta.edit');
// Route::put('/update-peserta/{id}', [PesertaController::class, 'update'])->name('peserta.update');
// Route::delete('/delete-peserta/{id}', [PesertaController::class, 'destroy'])->name('peserta.destroy');
// Route::put('/peserta/{id}', [PesertaController::class, 'update'])->name('peserta.update');
// Route::delete('/peserta/{id}', [PesertaController::class, 'destroy'])->name('peserta.destroy');

Route::middleware(['guest'])->group(function () {
    Route::get('/login', [PesertaController::class, 'loginForm'])->name('login');
    Route::post('/login', [PesertaController::class, 'login'])->name('login.attempt');
});

// Halaman setelah login
Route::middleware(['auth'])->group(function () {
    Route::get('/', function () {
        return view('index');
    })->name('home');

    // Routes untuk jurusan
    Route::get('/jurusan', [JurusanController::class, 'index'])->name('jurusan.index');
    Route::post('/jurusan', [JurusanController::class, 'store'])->name('jurusan.store');
    Route::put('/jurusan/{id}', [JurusanController::class, 'update'])->name('jurusan.update');
    Route::delete('/jurusan/{id}', [JurusanController::class, 'destroy'])->name('jurusan.destroy');

    // Routes untuk peserta
    Route::get('/data-peserta', [PesertaController::class, 'index'])->name('peserta.index');
    Route::get('/input-peserta', [PesertaController::class, 'create'])->name('peserta.create');
    Route::post('/input-peserta', [PesertaController::class, 'store'])->name('peserta.store');
    Route::get('/edit-peserta/{id}', [PesertaController::class, 'edit'])->name('peserta.edit');
    Route::put('/update-peserta/{id}', [PesertaController::class, 'update'])->name('peserta.update');
    Route::delete('/delete-peserta/{id}', [PesertaController::class, 'destroy'])->name('peserta.destroy');

    Route::get('/weather', [WeatherController::class, 'index'])->name('weather.index');
    Route::get('/weather/check', [WeatherController::class, 'checkWeather'])->name('weather.check');
});

Route::post('/logout', [PesertaController::class, 'logout'])->name('logout');
