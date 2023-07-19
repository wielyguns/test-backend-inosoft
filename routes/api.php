<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//User Routes
require __DIR__ . '/AuthRoute.php';
// Master Routes
require __DIR__ . '/MasterRoute.php';
// Penjualan Routes
require __DIR__ . '/PenjualanRoute.php';
// Report Routes
require __DIR__ . '/ReportRoute.php';
