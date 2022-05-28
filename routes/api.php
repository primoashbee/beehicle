<?php

use Illuminate\Http\Request;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ServiceController;
use App\Http\Controllers\Api\VehicleController;
use App\Http\Controllers\Api\ProviderController;
use App\Http\Middleware\Api\EmailMustBeVerified;
use App\Http\Controllers\Api\TransactionController;
use App\Http\Controllers\Api\TravelRecordController;
use App\Http\Controllers\Api\VehicleServiceController;

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
Route::post('/user/reset-password', [UserController::class, 'resetPassword']);

Route::middleware(['auth:sanctum',EmailMustBeVerified::class])->group(function(){

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

    Route::prefix('/transaction')->group(function(){
       Route::post('/', [TransactionController::class,'store']); 
    });

    Route::prefix('/providers')->group(function(){
        // Route::get('/{vehicle_id}/list', [ServiceController::class, 'vehicleServices']);
        // Route::post('/create', [ServiceController::class, 'store']);
        // Route::put('/{id}/update', [ServiceController::class, 'update']);
        // Route::delete('/{id}/delete', [ServiceController::class, 'delete']);

        Route::get('/', [ProviderController::class, 'index']);
    });

    Route::get('/setup', [UserController::class,'setup']);
    Route::post('/travels', [TravelRecordController::class, 'store']); 
    Route::delete('/travels/{transaction_id}', [TravelRecordController::class, 'delete']); 

    Route::put('/profile/{user_id}', [UserController::class, 'update']);
});

Route::post('/photo', function(Request $request){
    $url = Storage::disk('mortgages')->putFileAs('', $request->file('file'),'ashbee.jpeg');
});
