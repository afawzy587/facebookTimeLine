<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::middleware('auth','setlocale')->group(function () {
    Route::get('/', [PostController::class,'index'])->name('posts.index');

    Route::post('/post', [PostController::class, 'store'])->name('post.store');
    Route::delete('/post/{id}', [PostController::class, 'destroy'])->name('post.destroy');

    Route::post('/comment', [CommentController::class, 'store'])->name('comment.store');
    Route::delete('/comment/{id}', [CommentController::class, 'destroy'])->name('comment.destroy');
    Route::post('/comment/bulck_delete', [CommentController::class, 'bulck_delete'])->name('comment.bulck_delete');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
