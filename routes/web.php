<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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



Route::get('/users', [UserController::class, 'index'])->name('users.index');
//Route::get('/posts/create',[PostController::class, 'create'])->name('posts.create');
Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
Route::post('/users',[UserController::class, 'store'])->name('users.store');
Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::put('/users/{user}',[UserController::class, 'update'])->name('users.update');
Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
// Route::post('/posts/{post}/restore',[PostController::class, 'restore'])->name('posts.restore');
// Route::get('/posts/ajax/show', [PostController::class, 'ajaxShow'])->name('posts.ajax.show');
Route::delete('/users/dstroy/all', [UserController::class, 'destroyAll'])->name('users.destroyAll');

Route::get('/', function () {
    return view('index');
});

Route::get('lang/{lang}', function ($lang) {
    session()->has('lang') ? session()->forget('lang') : '';
    $lang == 'ar' ? session()->put('lang', 'ar') : session()->put('lang', 'en');
    return back();
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
