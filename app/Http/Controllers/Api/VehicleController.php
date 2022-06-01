<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use Illuminate\Support\Facades\Validator;

class VehicleController extends Controller
{
    public function index()
    {
        $user =  auth('sanctum')->user();

        return response()->json([
            'message' => 'Success',
            'code' => 200,
            'data' => [
                'vehicles'=>$user->vehicles
            ]
        ], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'brand'=>'required',
                'plate_number'=>'required|unique:vehicles,plate_number',
                'vehicle_type'=>'required',
                'date_purchased'=>'required|date',
                'chasis'=>'required',
                'coding'=>'required',
                'vehicle_image_car'=>'required',
                'vehicle_image_orcr'=>'required'
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Invalid Values',
                'code' => 422,
                'data' => $validator->errors()
            ], 422);
        }

    
        $user = auth('sanctum')->user();

        $vehicle = $user->vehicles()->create([
            'brand'=>$request->brand,
            'plate_number'=>$request->plate_number,
            'vehicle_type'=>$request->vehicle_type,
            'date_purchased'=>$request->date_purchased,
            'chasis'=>$request->chasis,
            'coding'=>$request->coding,
        ]);

        return response()->json([
            'message' => 'Successful Vehicle Registration',
            'data' => UserController::refreshData(),
            'code' => 200
        ], 200);
    }
    public function update(Request $request, $vehicle_id)
    {
        $vehicle = Vehicle::find($vehicle_id);
        if(is_null($vehicle)){
            return response()->json([
                'message' => 'Invalid Resource',
                'code' => 404,
                'data' => []
            ], 404);           
        }
        
        $validator = Validator::make(
            $request->all(),
            [
                'brand'=>'required',
                'plate_number'=>'required|unique:vehicles,plate_number,' .$vehicle->id,
                'vehicle_type'=>'required',
                'date_purchased'=>'required|date',
                'chasis'=>'required',
                'coding'=>'required',
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Invalid Values',
                'code' => 422,
                'data' => $validator->errors()
            ], 422);
        }

        $user = auth('sanctum')->user();
        
        $vehicle->update([
            'brand'=>$request->brand,
            'plate_number'=>$request->plate_number,
            'vehicle_type'=>$request->vehicle_type,
            'date_purchased'=>$request->date_purchased,
            'chasis'=>$request->chasis,
            'coding'=>$request->coding,
        ]);

        return response()->json([
            'message' => 'Successful Vehicle Registration',
            'data' => UserController::refreshData(),
            'code' => 200
        ], 200);
    }

    public function delete($vehicle_id)
    {
        $vehicle = Vehicle::find($vehicle_id);
        if (is_null($vehicle)) {
            return response()->json([
                'message' => 'Invalid Resource',
                'code' => 404,
                'data' => []
            ], 404);
        }

        $vehicle->delete();
        return response()->json([
            'message' => 'Vehicle deleted successful',
            'code' => 200,
            'data' => []
        ], 200);
    }
    
}
