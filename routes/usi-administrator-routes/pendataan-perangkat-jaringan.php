<?php

use Illuminate\Support\Facades\Route;

//usi-administrator-controller
use App\Http\Controllers\usi_administrator_controllers\DeviceController as usiDeviceController;
use App\Http\Controllers\usi_administrator_controllers\DashboardController as usiDashboardController;
use App\Http\Controllers\usi_administrator_controllers\NetworkTopologyController as usiNetworkTopologyController;
use App\Http\Controllers\usi_administrator_controllers\RouterController as usiRouterController;
use App\Http\Controllers\usi_administrator_controllers\APWifiController as usiAPWifiController;
use App\Http\Controllers\usi_administrator_controllers\ServerController as usiServerController;
use App\Http\Controllers\usi_administrator_controllers\SwitchController as usiSwitchController;
use App\Http\Controllers\usi_administrator_controllers\WifiMappingController as usiWifiMappingController;

$sub_administrator_url = 'pendataan';

//pendataan-perangkat-jaringan
Route::get('/'.$usi_administrator_url.'/'.$sub_administrator_url, [usiDashboardController::class, 'pendataan'])->name($usi_administrator_url.'.pendataan');

//pendataan-perangkat-jaringan.perangkat
Route::resource($usi_administrator_url.'/'.$sub_administrator_url.'/perangkat', usiDeviceController::class)->names([
    'index' => $usi_administrator_url.'.'.$sub_administrator_url.'.perangkat',
    'store' => $usi_administrator_url.'.'.$sub_administrator_url.'.perangkat',
    'edit' => $usi_administrator_url.'.'.$sub_administrator_url.'.perangkat.{perangkat}.edit',
    'update' => $usi_administrator_url.'.'.$sub_administrator_url.'.perangkat.update',
]);
Route::get($usi_administrator_url.'/'.$sub_administrator_url.'/perangkat/searchMenu/{idMenu}/{deviceRegistrationId}', [usiDeviceController::class, 'searchMenu']);
Route::get($usi_administrator_url.'/'.$sub_administrator_url.'/devicejson', [usiDeviceController::class, 'deviceJson']);

// pendataan-perangkat/switch
Route::resource($usi_administrator_url.'/'.$sub_administrator_url.'/switch', usiSwitchController::class)->names([
    'index' => $usi_administrator_url.'.pendataan.switch'
]);
Route::get($usi_administrator_url.'/'.$sub_administrator_url.'/switchjson', [usiSwitchController::class, 'switchJson']);

//pendataan-perangkat/router
Route::resource($usi_administrator_url.'/'.$sub_administrator_url.'/router', usiRouterController::class)->names([
    'index' => $usi_administrator_url.'.pendataan.router'
]);
Route::get($usi_administrator_url.'/'.$sub_administrator_url.'/routerjson', [usiRouterController::class, 'routerJson']);

//pendataan-perangkat/ap_wifi
Route::resource($usi_administrator_url.'/'.$sub_administrator_url.'/ap-wifi', usiAPWifiController::class)->names([
    'index' => $usi_administrator_url.'.pendataan.ap-wifi'
]);
Route::get($usi_administrator_url.'/'.$sub_administrator_url.'/apwifijson', [usiAPWifiController::class, 'APWifiJson']);

//pendataan-perangkat/server
Route::resource($usi_administrator_url.'/'.$sub_administrator_url.'/server', usiServerController::class)->names([
    'index' => $usi_administrator_url.'.pendataan.server'
]);
Route::get($usi_administrator_url.'/'.$sub_administrator_url.'/serverjson', [usiServerController::class, 'serverJson']);


//pendataan-perangkat-jaringan.topologi-jaringan
Route::resource($usi_administrator_url.'/'.$sub_administrator_url.'/topologi-jaringan', usiNetworkTopologyController::class)->names([
    'index' => $usi_administrator_url.'.'.$sub_administrator_url.'.topologi-jaringan',
]);
Route::get($usi_administrator_url.'/'.$sub_administrator_url.'/networktopologijson', [usiNetworkTopologyController::class, 'networkTopologyJson']);

//pendataan-perangkat-jaringan.mapping-wifi
Route::resource($usi_administrator_url.'/'.$sub_administrator_url.'/mapping-wifi', usiWifiMappingController::class)->names([
    'index' => $usi_administrator_url.'.'.$sub_administrator_url.'.mapping-wifi',
    'show' => $usi_administrator_url.'.'.$sub_administrator_url.'.mapping-wifi.show',

]);
Route::get($usi_administrator_url.'/'.$sub_administrator_url.'/mappingwifijson', [usiWifiMappingController::class, 'mappingWifiJson']);

?>