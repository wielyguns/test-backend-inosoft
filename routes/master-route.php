<?php

use App\Http\Controllers\MotorController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'masters'], function () {
    Route::apiResource('motor', MotorController::class);
});
