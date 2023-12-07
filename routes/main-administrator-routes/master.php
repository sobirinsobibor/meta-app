<?php

use Illuminate\Support\Facades\Route;

//main-administrator-controller
use App\Http\Controllers\main_administrator_controllers\DashboardController as adminDashboardController;
use App\Http\Controllers\main_administrator_controllers\DeviceBrandController as adminDeviceBrandController;
use App\Http\Controllers\main_administrator_controllers\DeviceCategoryController as adminDeviceCategoryController;
use App\Http\Controllers\main_administrator_controllers\DeviceTypeController as adminDeviceTypeController;
use App\Http\Controllers\main_administrator_controllers\ServerFunctionController as adminServerFunctionController;
use App\Http\Controllers\main_administrator_controllers\ServerTypeController as adminServerTypeController;
use App\Http\Controllers\main_administrator_controllers\TeamUnitController as adminTeamUnitController;
use App\Http\Controllers\main_administrator_controllers\UpLinkController as adminUpLinkController;
use App\Http\Controllers\main_administrator_controllers\UserController as adminUserController;

$sub_administrator_url = 'master';


//master 
Route::get('/'.$main_administrator_url.'/'.$sub_administrator_url, [adminDashboardController::class, 'master'])->name($main_administrator_url.'.'.$sub_administrator_url);

//master.user
Route::resource('/'.$main_administrator_url.'/'.$sub_administrator_url.'/user', adminUserController::class)->names([
    'index' => $main_administrator_url.'.'.$sub_administrator_url.'.user',
]);
Route::get($main_administrator_url.'/'.$sub_administrator_url.'/userjson', [adminUserController::class, 'userJson']);

//master.jenis-perangkat
Route::resource('/'.$main_administrator_url.'/master/jenis-perangkat', adminDeviceTypeController::class)->names([
    'index' => $main_administrator_url.'.'.$sub_administrator_url.'.jenis-perangkat',
]);
Route::get($main_administrator_url.'/master/devicetypejson', [adminDeviceTypeController::class, 'deviceTypeJson']);

//master.merk-perangkat
Route::resource('/'.$main_administrator_url.'/master/merk-perangkat', adminDeviceBrandController::class)->names([
    'index' => $main_administrator_url.'.'.$sub_administrator_url.'.merk-perangkat',
]);
Route::get($main_administrator_url.'/'.$sub_administrator_url.'/devicebrandjson', [adminDeviceBrandController::class, 'deviceBrandJson']);

//master.unit-kerja
Route::resource('/'.$main_administrator_url.'/'.$sub_administrator_url.'/unit-kerja', adminTeamUnitController::class)->names([
    'index' => $main_administrator_url.'.'.$sub_administrator_url.'.unit-kerja',
]);
Route::get($main_administrator_url.'/'.$sub_administrator_url.'/teamunitjson', [adminTeamUnitController::class, 'teamUnitJson']);

//master.ketegori-perangkat
Route::resource('/'.$main_administrator_url.'/'.$sub_administrator_url.'/kategori-perangkat', adminDeviceCategoryController::class)->names([
    'index' => $main_administrator_url.'.'.$sub_administrator_url.'.kategori-perangkat',
]);
Route::get($main_administrator_url.'/'.$sub_administrator_url.'/devicecategoryjson', [adminDeviceCategoryController::class, 'deviceCategoryJson']);


//master.tipe-server
Route::resource('/'.$main_administrator_url.'/'.$sub_administrator_url.'/tipe-server', adminServerTypeController::class)->names([
    'index' => $main_administrator_url.'.'.$sub_administrator_url.'.tipe-server',
]);
Route::get($main_administrator_url.'/'.$sub_administrator_url.'/servertypejson', [adminServerTypeController::class, 'serverTypeJson']);

//master.fungsi-server
Route::resource('/'.$main_administrator_url.'/'.$sub_administrator_url.'/fungsi-server', adminServerFunctionController::class)->names([
    'index' => $main_administrator_url.'.'.$sub_administrator_url.'.fungsi-server',
]);
Route::get($main_administrator_url.'/'.$sub_administrator_url.'/serverfunctionjson', [adminServerFunctionController::class, 'serverFunctionJson']);

//master.up-link
Route::resource('/'.$main_administrator_url.'/'.$sub_administrator_url.'/up-link', adminUpLinkController::class)->names([
    'index' => $main_administrator_url.'.'.$sub_administrator_url.'.up-link',
]);
Route::get($main_administrator_url.'/'.$sub_administrator_url.'/uplinkjson', [adminUpLinkController::class, 'upLinkJson']);

?>