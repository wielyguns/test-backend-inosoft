<?php

use App\Http\Controllers\PenjualanController;
use Illuminate\Support\Facades\Route;

Route::apiResource('penjualan', PenjualanController::class);
