<?php

use App\Http\Controllers\main_administrator_controllers\IPServerController as adminIPServerController;
use Illuminate\Support\Facades\Route;

$sub_administrator_url = 'layanan';

Route::resource($main_administrator_url.'/'.$sub_administrator_url.'/ip-server', adminIPServerController::class)->names([
    'index' => $main_administrator_url.'.'.$sub_administrator_url.'.ip-server',
]);

?>