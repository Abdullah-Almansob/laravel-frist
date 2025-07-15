<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\RegisterController;

Route::get('/new-register', [RegisterController::class, 'showForm'])->name('register.form');
Route::post('/new-register', [RegisterController::class, 'register'])->name('register.submit');


Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');




Route::get('/custom-login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/custom-login', [AuthController::class, 'login'])->name('login.custom');






Route::get('/post', [PostController::class, 'index'])->name('post.index');
Route::get('/post/create', [PostController::class, 'create'])->name('post.create');
Route::get('/post/{id}', [PostController::class, 'show'])->name('post.show');
Route::post('/post', [PostController::class, 'store'])->name('post.store');
Route::delete('/post/{id}', [PostController::class, 'delete'])->name('post.delete');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// إنشاء وتعديل وحذف البوستات (للمستخدمين فقط)
Route::middleware(['auth', 'admin'])->group(function () {

    Route::get('/post/{id}/edit', [PostController::class, 'edit'])->name('post.edit');
    Route::put('/post/{id}', [PostController::class, 'update'])->name('post.update');
    Route::resource('users', UserController::class)->except(['show', 'edit', 'update']);
    Route::get('/admin/users', [UserController::class, 'index'])->name('users.index');
    Route::post('/admin/users', [UserController::class, 'store'])->name('users.store');
    Route::post('/users/{id}/make-admin', [UserController::class, 'makeAdmin'])->name('users.makeAdmin');
    Route::get('/users/{id}/posts', [UserController::class, 'userPosts'])->name('users.posts');
});

require __DIR__ . '/auth.php';
