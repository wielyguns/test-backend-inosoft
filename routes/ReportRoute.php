<?php

use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;

Route::apiResource('report', ReportController::class)->only([
    'index'
]);
