<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Post;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/showLogin', [LoginController::class, 'show'])->name('showLogin');
Route::get('/login', [LoginController::class, 'login'])->name('login');
//Route::get('/login', [\App\Http\Controllers\Auth\LoginController::class, 'show'])->name('logout');
Route::post('/register', [RegisterController::class, 'create'])->name('register');
Route::get('/posts', [Post::class, 'index'])->name('posts');
Route::get('/posts/create', [Post::class, 'create'])->name('createPost')->middleware('\App\Http\Middleware\AuthUser');
Route::post('/posts', [Post::class, 'store'])->name('savePost')->middleware('\App\Http\Middleware\AuthUser');
Route::get('/posts/{id}', [Post::class, 'show'])->name('showPost');
Route::get('/posts/{id}/edit', [Post::class, 'edit'])->name('editPost')->middleware('\App\Http\Middleware\AuthOwner');
Route::put('/posts/{id}', [Post::class, 'update'])->name('updatePost');
Route::delete('/posts/{id}', [Post::class, 'destroy'])->name('deletePost');
Route::post('/posts/{id}/comments', [Post::class, 'addComment'])->name('addComment');
Route::delete('/comments/{id}', [Post::class, 'deleteComment'])->name('deleteComment');
