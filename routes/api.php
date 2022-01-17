<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\VesselController;
use App\Http\Controllers\API\VoyageController;
use App\Http\Controllers\API\VesselOpexController;

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

Route::post('/voyages', [VoyageController::class, 'store']);

Route::put('/voyages/{voyage}', [VoyageController::class, 'update']);

Route::post('/vessels/{vessel}/vessel-opex', [VesselOpexController::class, 'store']);

Route::get('/vessels/{vessel}/financial-report', [VesselController::class, 'report']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
