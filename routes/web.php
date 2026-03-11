<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;

Route::get('/', [HomeController::class, 'index']);

Route::get('/profile', function () {
    return "Nama: Made Puja Rajistha AW <br> NIM: 245150707111056 <br> Program Studi: Teknologi Informasi";
});

Route::get('/welcome/{name}', function ($name) {
    return "Selamat datang, " . $name . "!";
});

Route::get('/dashboard', [DashboardController::class, 'index']);