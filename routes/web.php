<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\CommentController;


Route::get('/', [VideoController::class, 'index'])->name('videos.index');

Route::get('/watch/{video}', [VideoController::class, 'show'])->name('videos.show');

Route::middleware('auth')->group(function () {
    Route::get('/upload', [VideoController::class, 'create'])->name('videos.create');
    Route::post('/upload', [VideoController::class, 'store'])->name('videos.store');
    Route::post('/videos/{video}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::get('/my-comments', [CommentController::class, 'userComments'])->name('comments.index');
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__.'/auth.php';