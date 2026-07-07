<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;

Route::get('/', function () {
    return view('welcome');
});

// Clean Theme Routes
Route::prefix('clean')->group(function () {
    Route::get('/', function () { return view('clean.about'); });
    Route::get('/projects', [ProjectController::class, 'index'])->defaults('theme', 'clean');
    Route::get('/certificates', function () { return view('clean.certificates'); });
});

// Creative Theme Routes
Route::prefix('creative')->group(function () {
    Route::get('/', function () { return view('creative.about'); });
    Route::get('/projects', [ProjectController::class, 'index'])->defaults('theme', 'creative');
    Route::get('/certificates', function () { return view('creative.certificates'); });
});
