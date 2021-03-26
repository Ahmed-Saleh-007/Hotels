<?php

use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
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
Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
Route::post('/users',[UserController::class, 'store'])->name('users.store');
Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::put('/users/{user}',[UserController::class, 'update'])->name('users.update');
Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
<<<<<<< HEAD
Route::delete('/users/dstroy/all', [UserController::class, 'destroyAll'])->name('users.destroyAll');
=======
// Route::post('/posts/{post}/restore',[PostController::class, 'restore'])->name('posts.restore');
// Route::get('/posts/ajax/show', [PostController::class, 'ajaxShow'])->name('posts.ajax.show');
Route::delete('/users/destroy/all', [UserController::class, 'destroyAll'])->name('users.destroyAll');
>>>>>>> 4931a7c7125fcd7a748bc01843ef908b60aae8dc

//=====================================Routes of Roles==============================================//
Route::get('/roles',               [RoleController::class, 'index'])     ->name('roles.index');     //
Route::get('/roles/{role}',        [RoleController::class, 'show'])      ->name('roles.show');      //
Route::post('/roles',              [RoleController::class, 'store'])     ->name('roles.store');     //
Route::get('/roles/{role}/edit',   [RoleController::class, 'edit'])      ->name('roles.edit');      //
Route::put('/roles/{role}',        [RoleController::class, 'update'])    ->name('roles.update');    //
Route::delete('/roles/{role}',     [RoleController::class, 'destroy'])   ->name('roles.destroy');   //
Route::delete('/roles/dstroy/all', [RoleController::class, 'destroyAll'])->name('roles.destroyAll');//
//==================================================================================================//

Route::get('/', function () {
    return view('index');
});

Route::get('lang/{lang}', function ($lang) {
    session()->has('lang') ? session()->forget('lang') : '';
    $lang == 'ar' ? session()->put('lang', 'ar') : session()->put('lang', 'en');
    return back();
});


// Route::get('/add-permission', function(){

//     Permission::create(['name' => 'add post']);

//     dd('permission added');


// });


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
