<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;

Route::get('/', [ProjectController::class, 'index'])->name('home');

Route::redirect('/projects', '/#projects', 301);
Route::redirect('/certificates', '/#credentials', 301);
