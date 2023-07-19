<?php

use App\Http\Controllers\KendaraanController;
use App\Http\Controllers\MobilController;
use App\Http\Controllers\MotorController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'masters'], function () {
    Route::apiResource('motor', MotorController::class);
    Route::apiResource('mobil', MobilController::class);
    Route::apiResource('kendaraan', KendaraanController::class);
});
