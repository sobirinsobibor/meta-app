<?php

use App\Http\Controllers\usi_administrator_controllers\FileController as usiFileController;
use Illuminate\Support\Facades\Route;


$sub_administrator_url = 'file';

//pendataan-perangkat-jaringan.perangkat
Route::resource($usi_administrator_url.'/'.$sub_administrator_url, usiFileController::class)->names([
    'index' => $usi_administrator_url.'.'.$sub_administrator_url,
]);

?>