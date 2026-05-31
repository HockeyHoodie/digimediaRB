<?php

use App\Http\Controllers\ProjectController;
use App\Http\Controllers\IssueController;
use Illuminate\Support\Facades\Route;

Route::inertia('/', 'Welcome')->name('home');

Route::get('/dashboard', [ProjectController::class, 'dashboard'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::resource('projects', ProjectController::class);
Route::resource('issues', IssueController::class);

require __DIR__.'/settings.php';
