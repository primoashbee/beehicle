<?php

use App\Http\Controllers\Api\ServiceController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\VehicleController;
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

Route::get('/test', function(){
    return ['message'=>'get'];
});

Route::post('/test', function(){
    return ['message'=>'get'];
});
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/user/register', [UserController::class, 'store']);
Route::post('/user/login', [UserController::class, 'login']);

Route::middleware('auth:sanctum')->group(function(){

    Route::prefix('/vehicles')->group(function(){
        Route::get('/', [VehicleController::class, 'index']);
        Route::post('/create', [VehicleController::class, 'store']);
        Route::put('/{id}/update', [VehicleController::class, 'update']);
        Route::delete('/{id}/delete', [VehicleController::class, 'delete']);
    });
    Route::prefix('/services')->group(function(){
        Route::get('/{vehicle_id}/list', [ServiceController::class, 'vehicleServices']);
        Route::post('/create', [ServiceController::class, 'store']);
        Route::put('/{id}/update', [ServiceController::class, 'update']);
        Route::delete('/{id}/delete', [ServiceController::class, 'delete']);
    });
    
});
