<?php

use App\Http\Controllers\Api\ProviderController;
use App\Http\Controllers\Api\ServiceController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\VehicleController;
use App\Http\Controllers\Api\VehicleServiceController;
use App\Http\Controllers\Api\TransactionController;
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
    return ['message'=>'post'];
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
        


        // Route::get('/service',[VehicleServiceController::class, 'index']);

        Route::prefix('/{vehicle_id}/services')->group(function(){
            Route::get('/',[VehicleServiceController::class, 'index']);

            Route::post('/create',[VehicleServiceController::class, 'store']);
            Route::get('/view/{vehicle_service_id}',[VehicleServiceController::class, 'view']);
            Route::put('/update/{vehicle_service_id}',[VehicleServiceController::class, 'update']);
            Route::delete('/view/{vehicle_service_id}',[VehicleServiceController::class, 'destroy']);
        });
    });
    Route::prefix('/services')->group(function(){
        // Route::get('/{vehicle_id}/list', [ServiceController::class, 'vehicleServices']);
        // Route::post('/create', [ServiceController::class, 'store']);
        // Route::put('/{id}/update', [ServiceController::class, 'update']);
        // Route::delete('/{id}/delete', [ServiceController::class, 'delete']);

        Route::get('/', [ServiceController::class, 'index']);
    });

    Route::prefix('/transactions')->group(function(){
       Route::post('/', [TransactionController::class,'store']); 
    });

    Route::prefix('/providers')->group(function(){
        // Route::get('/{vehicle_id}/list', [ServiceController::class, 'vehicleServices']);
        // Route::post('/create', [ServiceController::class, 'store']);
        // Route::put('/{id}/update', [ServiceController::class, 'update']);
        // Route::delete('/{id}/delete', [ServiceController::class, 'delete']);

        Route::get('/', [ProviderController::class, 'index']);
    });
    

    
});
