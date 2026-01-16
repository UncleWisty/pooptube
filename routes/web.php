<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VideoController;

Route::get('/', [VideoController::class, 'index'])->name('videos.index');
Route::get('/upload', [VideoController::class, 'create'])->name('videos.create');
Route::post('/upload', [VideoController::class, 'store'])->name('videos.store');
Route::get('/watch/{video}', [VideoController::class, 'show'])->name('videos.show');