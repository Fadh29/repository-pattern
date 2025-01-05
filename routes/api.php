<?php

// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\PesertaController;
use App\Http\Controllers\WeatherController;

// Rute untuk tamu (guest)
Route::middleware(['guest'])->group(function () {
    Route::get('/login', [PesertaController::class, 'login'])->name('login');
    // Route::get('/login', [PesertaController::class, 'loginForm'])->name('login');
});

// Rute untuk pengguna terautentikasi
Route::middleware(['auth:sanctum'])->group(function () {
    // Rute Jurusan
    Route::get('/jurusan', [JurusanController::class, 'index'])->name('jurusan.index');
    Route::post('/jurusan', [JurusanController::class, 'store'])->name('jurusan.store');
    Route::put('/jurusan/{id}', [JurusanController::class, 'update'])->name('jurusan.update');
    Route::delete('/jurusan/{id}', [JurusanController::class, 'destroy'])->name('jurusan.destroy');

    // Rute Peserta
    Route::get('/peserta', [PesertaController::class, 'index'])->name('peserta.index');
    Route::post('/peserta', [PesertaController::class, 'store'])->name('peserta.store');
    Route::get('/peserta/{id}', [PesertaController::class, 'edit'])->name('peserta.edit');
    Route::put('/peserta/{id}', [PesertaController::class, 'update'])->name('peserta.update');
    Route::delete('/peserta/{id}', [PesertaController::class, 'destroy'])->name('peserta.destroy');

    // Rute Cuaca
    Route::get('/weather', [WeatherController::class, 'index'])->name('weather.index');
    Route::get('/weather/check', [WeatherController::class, 'checkWeather'])->name('weather.check');

    // Logout
    Route::post('/logout', [PesertaController::class, 'logout'])->name('logout');
});
