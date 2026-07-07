<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;

Route::get('/', function () {
    return view('about');
});

Route::get('/projects', [ProjectController::class, 'index']);

Route::get('/certificates', function () {
    return view('certificates');
});
