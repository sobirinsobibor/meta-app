<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;

// main_administrator_controllers
use App\Http\Controllers\main_administrator_controllers\DashboardController as adminDashboardController;

// usi_administrator_controllers
use App\Http\Controllers\usi_administrator_controllers\DashboardController as usiDashboardController;

// visitor_controllers
use App\Http\Controllers\visitor_controllers\DashboardController as visitorDashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/login', [LoginController::class, "index"])->name('login');
Route::post('/login', [LoginController::class, "authenticate"]);
Route::get('/logout', [LoginController::class, 'logout'] )->name('logout');


//auth middleware
Route::group(['middleware' => ['auth']], function () {
    Route::get('/', [Controller::class, "index"]); 

    Route::get('/profile', [Controller::class, "profile"])->name('profile'); 
});

//main-administrator-middleware
Route::group(['middleware' => ['auth', 'main-admin-middleware']], function() {

    $main_administrator_url = 'admin';

    Route::get('/'.$main_administrator_url, [adminDashboardController::class, 'index'] )->name($main_administrator_url);

    require __DIR__.'/main-administrator-routes/master.php';
    require __DIR__.'/main-administrator-routes/pendataan-perangkat-jaringan.php';
    require __DIR__.'/main-administrator-routes/layanan-data-center.php';
    require __DIR__.'/main-administrator-routes/ip_server.php';

});
//usi-administrator-middleware
Route::group(['middleware' => ['auth', 'usi-admin-middleware']], function() {
    $usi_administrator_url = 'staff';

    Route::get('/'.$usi_administrator_url, [usiDashboardController::class, 'index'])->name($usi_administrator_url);  
    
    require __DIR__.'/usi-administrator-routes/pendataan-perangkat-jaringan.php';
    require __DIR__.'/usi-administrator-routes/files.php';
    require __DIR__.'/usi-administrator-routes/layanan-data-center.php';
    require __DIR__.'/usi-administrator-routes/dokumentasi.php';

});

//visitor-middleware
Route::group(['middleware' => ['auth', 'visitor-middleware']], function() {
    $visitor_url = 'visitor';

    Route::get('/'.$visitor_url, [visitorDashboardController::class, 'index']);  
});

// Route::get('/', [Controller::class, "index"]);



