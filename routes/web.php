<?php


use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ReceptionistController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserAuthentication;
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

//=====================================Routes of Roles===============================================//
Route::get('/roles',                [RoleController::class, 'index'])     ->name('roles.index');     //
Route::get('/roles/{role}',         [RoleController::class, 'show'])      ->name('roles.show');      //
Route::post('/roles',               [RoleController::class, 'store'])     ->name('roles.store');     //
Route::get('/roles/{role}/edit',    [RoleController::class, 'edit'])      ->name('roles.edit');      //
Route::put('/roles/{role}',         [RoleController::class, 'update'])    ->name('roles.update');    //
Route::delete('/roles/{role}',      [RoleController::class, 'destroy'])   ->name('roles.destroy');   //
Route::delete('/roles/destroy/all', [RoleController::class, 'destroyAll'])->name('roles.destroyAll');//
//===================================================================================================//


//===========================================Routes of Permissions==========================================================//
Route::get('/permissions',                     [PermissionController::class, 'index'])     ->name('permissions.index');     //
Route::get('/permissions/{permission}',        [PermissionController::class, 'show'])      ->name('permissions.show');      //
Route::post('/permissions',                    [PermissionController::class, 'store'])     ->name('permissions.store');     //
Route::get('/permissions/{permission}/edit',   [PermissionController::class, 'edit'])      ->name('permissions.edit');      //
Route::put('/permissions/{permission}',        [PermissionController::class, 'update'])    ->name('permissions.update');    //
Route::delete('/permissions/{permission}',     [PermissionController::class, 'destroy'])   ->name('permissions.destroy');   //
Route::delete('/permissions/destroy/all',      [PermissionController::class, 'destroyAll'])->name('permissions.destroyAll');//
//==========================================================================================================================//


//===========================================Routes of Receptionists==============================================================//
Route::group(['middleware' =>    ['auth', 'role:admin|manager|receptionist' ] ], function () {
    Route::get('/receptionists', [ReceptionistController::class, 'index'])     ->name('receptionists.index');     //
    Route::get('/receptionists/{user}', [ReceptionistController::class, 'show'])      ->name('receptionists.show');      //
    Route::post('/receptionists', [ReceptionistController::class, 'store'])     ->name('receptionists.store');     //
    Route::get('/receptionists/{user}/edit', [ReceptionistController::class, 'edit'])      ->name('receptionists.edit');      //
    Route::post('/receptionists/{user}/update', [ReceptionistController::class, 'update'])    ->name('receptionists.update');    //
    Route::delete('/receptionists/{user}', [ReceptionistController::class, 'destroy'])   ->name('receptionists.destroy');   //
    Route::delete('/receptionists/destroy/all', [ReceptionistController::class, 'destroyAll'])->name('receptionists.destroyAll');//

    Route::post('/receptionists/{user}/approve', [ReceptionistController::class, 'approve'])->name('receptionists.approveClient');//
});

//================================================================================================================================//

//===========================================Routes of Clients==================================================//

Route::group(['middleware' => ['auth', 'role:admin|manager|receptionist' ] ], function () {  
    
    Route::get('/', [HomeController::class , 'index']);
    
    Route::get('/clients', [ClientController::class, 'index'])            ->name('clients.index');     //
    Route::get('/clients/{user}', [ClientController::class, 'show'])      ->name('clients.show');      //
    Route::post('/clients', [ClientController::class, 'store'])           ->name('clients.store');     //
    Route::get('/clients/{user}/edit', [ClientController::class, 'edit'])      ->name('clients.edit');      //
    Route::post('/clients/{user}/update', [ClientController::class, 'update'])    ->name('clients.update');    //
    Route::delete('/clients/{user}', [ClientController::class, 'destroy'])   ->name('clients.destroy');   //
    Route::delete('/clients/destroy/all', [ClientController::class, 'destroyAll'])->name('clients.destroyAll');
});

//==============================================================================================================//

//===========================================Routes of Managers===================================================//
Route::group(['middleware' => ['auth', 'role:admin' ] ], function () {                                             //

    Route::get('/managers', [ManagerController::class, 'index'])     ->name('managers.index');     //
    Route::get('/managers/{user}', [ManagerController::class, 'show'])      ->name('managers.show');      //
    Route::post('/managers', [ManagerController::class, 'store'])     ->name('managers.store');     //
    Route::get('/managers/{user}/edit', [ManagerController::class, 'edit'])      ->name('managers.edit');      //
    Route::post('/managers/{user}/update', [ManagerController::class, 'update'])    ->name('managers.update');    //
    Route::delete('/managers/{user}', [ManagerController::class, 'destroy'])   ->name('managers.destroy');   //
    Route::delete('/managers/destroy/all', [ManagerController::class, 'destroyAll'])->name('managers.destroyAll');//

    //=============================all users routes=========================//
    Route::get('/users',                [UserController::class, 'index'])->name('users.index');
    Route::get('/users/{user}',         [UserController::class, 'show'])->name('users.show');
    Route::post('/users',               [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{user}/edit',    [UserController::class, 'edit'])->name('users.edit');
    Route::post('/users/{user}/update', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}',      [UserController::class, 'destroy'])->name('users.destroy');
    Route::delete('/users/destroy/all', [UserController::class, 'destroyAll'])->name('users.destroyAll');
    
});                                                                                                               //
//================================================================================================================//


//=====================================login & registeration & authentication routes==============================================//

Route::get('/login',  [UserAuthentication::class , 'login'])->name('dashboard.login');
Route::post('/login', [UserAuthentication::class , 'dologin'])->name('dashboard.login');

Route::any('/logout', [UserAuthentication::class , 'logout'])->name('dashboard.logout');

Route::get('/register',  [UserAuthentication::class , 'register'])->name('dashboard.register');
Route::post('/register', [UserAuthentication::class , 'doregister'])->name('dashboard.register');

Route::get('/forgot/password',  [UserAuthentication::class , 'forgot_password'])->name('dashboard.forgot_password');
Route::post('/forgot/password', [UserAuthentication::class , 'forgot_password_post'])->name('dashboard.forgot_password');

Route::get('/reset/password/{token}',  [UserAuthentication::class , 'reset_password'])->name('dashboard.reset_password');
Route::post('/reset/password/{token}', [UserAuthentication::class , 'reset_password_post'])->name('dashboard.reset_password');

//================================================================================================================================//

//===========testing only=============//

//===================================//



Route::get('lang/{lang}', function ($lang) {
    session()->has('lang') ? session()->forget('lang') : '';
    $lang == 'ar' ? session()->put('lang', 'ar') : session()->put('lang', 'en');
    return back();
});
