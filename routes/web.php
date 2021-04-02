<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FloorController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserAuthentication;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ReceptionistController;
use App\Http\Controllers\ClientStatisticsController;
use App\Models\Reservation;
use App\Models\User;

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


Route::group(['middleware' => ['auth']], function () {
    Route::group(['middleware' =>    ['role:admin|manager' ] ], function () {

        //===========================================Routes of Receptionists==============================================================//
        Route::get('/receptionists', [ReceptionistController::class, 'index'])     ->name('receptionists.index');          //
        Route::get('/receptionists/{user}', [ReceptionistController::class, 'show'])      ->name('receptionists.show');           //
        Route::post('/receptionists', [ReceptionistController::class, 'store'])     ->name('receptionists.store');          //
        Route::get('/receptionists/{user}/edit', [ReceptionistController::class, 'edit'])      ->name('receptionists.edit');           //
        Route::post('/receptionists/{user}/update', [ReceptionistController::class, 'update'])    ->name('receptionists.update');         //
        Route::delete('/receptionists/{user}', [ReceptionistController::class, 'destroy'])   ->name('receptionists.destroy');        //
        Route::delete('/receptionists/destroy/all', [ReceptionistController::class, 'destroyAll'])->name('receptionists.destroyAll');     //
        Route::post('/receptionists/{user}/ban', [ReceptionistController::class, 'ban_receptionist'])->name('receptionists.ban');      //
        Route::post('/receptionists/{user}/unban', [ReceptionistController::class, 'unban_receptionist'])->name('receptionists.unban');  //
        //================================================================================================================================//

        //================================================Client Statistics Routes ===========================================//
        Route::get('/client/statistcs', [ClientStatisticsController::class,'index'])      ->name('clients.statistics');       //
        Route::get('/get-client-count', [ClientStatisticsController::class,'clientData']) ->name('clients.data');             //
        Route::get('/get-country-count', [ClientStatisticsController::class,'countryData'])->name('clients.countryData');      //
        Route::get('/get-reservations-revenue', [ClientStatisticsController::class,'reservationsRevenue'])->name('clients.reservationsRevenue');      //
        
       
        //====================================================================================================================//
    });

    Route::group(['middleware' => ['role:admin|manager|receptionist' ] ], function () {
        Route::get('/', [HomeController::class , 'index'])->name('dashboard.home');
        //===============================================Routes of Clients=============================================================//
        Route::get('/clients', [ClientController::class, 'index'])            ->name('clients.index');                 //
        Route::get('/clients/{user}', [ClientController::class, 'show'])      ->name('clients.show');                         //
        Route::post('/clients', [ClientController::class, 'store'])           ->name('clients.store');                  //
        Route::get('/clients/{user}/edit', [ClientController::class, 'edit'])      ->name('clients.edit');                         //
        Route::post('/clients/{user}/update', [ClientController::class, 'update'])    ->name('clients.update');                       //
        Route::delete('/clients/{user}', [ClientController::class, 'destroy'])   ->name('clients.destroy');                      //
        Route::delete('/clients/destroy/all', [ClientController::class, 'destroyAll'])->name('clients.destroyAll');                   //
        Route::post('/clients/{user}/approve', [ClientController::class, 'approve_client'])->name('clients.approveClient');            //
        Route::get('/approved-clients', [ClientController::class, 'get_approved_clients'])         ->name('clients.approved');  //
        //=============================================================================================================================//
    });


    Route::group(['middleware' => ['role:admin' ] ], function () {

        //===========================================Routes of Managers===================================================//
        Route::get('/managers', [ManagerController::class, 'index'])     ->name('managers.index');         //
        Route::get('/managers/{user}', [ManagerController::class, 'show'])      ->name('managers.show');          //
        Route::post('/managers', [ManagerController::class, 'store'])     ->name('managers.store');         //
        Route::get('/managers/{user}/edit', [ManagerController::class, 'edit'])      ->name('managers.edit');          //
        Route::post('/managers/{user}/update', [ManagerController::class, 'update'])    ->name('managers.update');        //
        Route::delete('/managers/{user}', [ManagerController::class, 'destroy'])   ->name('managers.destroy');       //
        Route::delete('/managers/destroy/all', [ManagerController::class, 'destroyAll'])->name('managers.destroyAll');    //
        //================================================================================================================//

        //==============================================All Users Routes==============================================//
        Route::get('/users', [UserController::class, 'index'])->name('users.index');                   //
        Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');                     //
        Route::post('/users', [UserController::class, 'store'])->name('users.store');                   //
        Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');                     //
        Route::post('/users/{user}/update', [UserController::class, 'update'])->name('users.update');                 //
        Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');               //
        Route::delete('/users/destroy/all', [UserController::class, 'destroyAll'])->name('users.destroyAll');         //
        //============================================================================================================//

        //=====================================Routes of Roles===============================================//
        Route::get('/roles', [RoleController::class, 'index'])     ->name('roles.index');     //
        Route::get('/roles/{role}', [RoleController::class, 'show'])      ->name('roles.show');      //
        Route::post('/roles', [RoleController::class, 'store'])     ->name('roles.store');     //
        Route::get('/roles/{role}/edit', [RoleController::class, 'edit'])      ->name('roles.edit');      //
        Route::put('/roles/{role}', [RoleController::class, 'update'])    ->name('roles.update');    //
        Route::delete('/roles/{role}', [RoleController::class, 'destroy'])   ->name('roles.destroy');   //
        Route::delete('/roles/destroy/all', [RoleController::class, 'destroyAll'])->name('roles.destroyAll');//
        //===================================================================================================//

        //===========================================Routes of Permissions==========================================================//
        Route::get('/permissions', [PermissionController::class, 'index'])     ->name('permissions.index');     //
        Route::get('/permissions/{permission}', [PermissionController::class, 'show'])      ->name('permissions.show');      //
        Route::post('/permissions', [PermissionController::class, 'store'])     ->name('permissions.store');     //
        Route::get('/permissions/{permission}/edit', [PermissionController::class, 'edit'])      ->name('permissions.edit');      //
        Route::put('/permissions/{permission}', [PermissionController::class, 'update'])    ->name('permissions.update');    //
        Route::delete('/permissions/{permission}', [PermissionController::class, 'destroy'])   ->name('permissions.destroy');   //
        Route::delete('/permissions/destroy/all', [PermissionController::class, 'destroyAll'])->name('permissions.destroyAll');//
        //==========================================================================================================================//
    });

    Route::group(['middleware' => ['role:admin|manager' ] ], function () {
        //===========================================Routes of Floors====================================================//
        Route::get('/floors', [FloorController::class, 'index'])     ->name('floors.index');              //
        Route::get('/floors/{floor}', [FloorController::class, 'show'])      ->name('floors.show');               //
        Route::post('/floors', [FloorController::class, 'store'])     ->name('floors.store');              //
        Route::get('/floors/{floor}/edit', [FloorController::class, 'edit'])      ->name('floors.edit');               //
        Route::put('/floors/{floor}', [FloorController::class, 'update'])    ->name('floors.update');             //
        Route::delete('/floors/{floor}', [FloorController::class, 'destroy'])   ->name('floors.destroy');            //
        Route::delete('/floors/destroy/all', [FloorController::class, 'destroyAll'])->name('floors.destroyAll');         //
        //===============================================================================================================//

        //===========================================Routes of rooms=====================================================//
        Route::get('/rooms', [RoomController::class, 'index'])->name('rooms.index');                     //
        Route::get('/rooms/{room}', [RoomController::class, 'show'])->name('rooms.show');                       //
        Route::post('/rooms', [RoomController::class, 'store'])->name('rooms.store');                     //
        Route::get('/rooms/{room}/edit', [RoomController::class, 'edit'])->name('rooms.edit');                       //
        Route::put('/rooms/{room}', [RoomController::class, 'update'])->name('rooms.update');                   //
        Route::delete('/rooms/{room}', [RoomController::class, 'destroy'])->name('rooms.destroy');                 //
        Route::delete('/rooms/destroy/all', [RoomController::class, 'destroyAll'])->name('rooms.destroyAll');           //
        //===============================================================================================================//
    });

    Route::any('/logout', [UserAuthentication::class , 'logout'])->name('dashboard.logout');

    Route::get('/profile', [ProfileController::class , 'edit'])->name('profile.edit');
    Route::post('/profile', [ProfileController::class , 'update']) ->name('profile.save');
});


//=====================================login & registeration & authentication routes==============================================//
Route::get('/login', [UserAuthentication::class , 'login'])               ->name('dashboard.login');            //
Route::post('/login', [UserAuthentication::class , 'dologin'])             ->name('dashboard.login');            //
Route::get('/forgot/password', [UserAuthentication::class , 'forgot_password'])     ->name('dashboard.forgot_password');  //
Route::post('/forgot/password', [UserAuthentication::class , 'forgot_password_post'])->name('dashboard.forgot_password');  //
Route::get('/reset/password/{token}', [UserAuthentication::class , 'reset_password'])      ->name('dashboard.reset_password');   //
Route::post('/reset/password/{token}', [UserAuthentication::class , 'reset_password_post']) ->name('dashboard.reset_password');   //
                                                                                                                                  //
Route::get('/register', [RegisterController::class , 'create'])->name('dashboard.registration.create');                          //
Route::post('/register', [RegisterController::class , 'store']) ->name('dashboard.registration.store');                           //
//================================================================================================================================//

//===========================================Routes of Reservations====================================================//
Route::get('/reservations/book', [ReservationController::class, 'book'])->name('reserv.book');
Route::get('/related-rooms', [ReservationController::class, 'create'])->name('reserv.create');
Route::get('/all-reservations', [ReservationController::class, 'index'])->name('reserv.all');
Route::get('/all-reservations/{reserv}', [ReservationController::class, 'show'])->name('reserv.show');
Route::delete('/all-reservations/{reserv}', [ReservationController::class, 'cancel'])->name('reserv.cancel');
//=====================================================================================================================//

//==========================================Routes of Payments=========================================================//
Route::post('/checkout', [StripeController::class, 'stripe'])->name('stripe.get');
Route::post('/myreservations', [StripeController::class, 'stripepost'])->name('stripe.post');
//=====================================================================================================================//
//===========testing only============//
Route::get('/', [HomeController::class , 'index'])->name('dashboard.home');
//===================================//

//===============================Routes to change language============================//
Route::get('lang/{lang}', function ($lang) {                                          //
    session()->has('lang') ? session()->forget('lang') : '';                          //
    $lang == 'ar' ? session()->put('lang', 'ar') : session()->put('lang', 'en');      //
    return back();                                                                    //
});                                                                                   //
//====================================================================================//
