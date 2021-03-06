<?php

namespace App\Http\Controllers\Api;

use App\Models\Vehicle;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\VehicleService;
use App\Models\ServiceSummary;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class VehicleServiceController extends Controller
{
    public function index($vehicle_id)
    {
   
            
        $vehicle = Vehicle::findOrFail($vehicle_id);

        return response()->json([
            'message' => 'Success',
            'code' => 200,
            'data' => [
                'services'=> $vehicle->services->load('service','provider')
            ]
        ], 200);       
    
    }
    public function view($vehicle_service_id)
    {
   
            
        $service = VehicleService::findOrFail($vehicle_service_id);

        return response()->json([
            'message' => 'Success',
            'code' => 200,
            'data' => [
                'services'=> $service->load('vehicle','provider','service')
            ]
        ], 200);       
    
    }

    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'vehicle_id'=>'required|exists:vehicles,id',
                'service_ids'=>'required',
                'service_ids.*'=>'required|exists:services,id',
                'provider_id'=>'required|exists:providers,id',
                'name'=>'required',
                'date'=>'required|date',
                'cost'=>'required|gte:0',
                
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Invalid Values',
                'code' => 422,
                'data' => $validator->errors()
            ], 422);
        }
        $vehicle = Vehicle::find($request->vehicle_id);
        $services = [];
        $key = Str::uuid();
        $summary = ServiceSummary::create([
            'name'=>$request->name,
            'date'=>$request->date,
            'cost'=>$request->cost,
            'notes'=>$request->notes,
            'provider_id'=>$request->provider_id,
            'vehicle_id'=>$vehicle->id,
            'key'=>$key
        ]);
        foreach($request->service_ids as $service_id){
            $services[] = $vehicle->services()->create([
                'service_id'=>$service_id,
                'provider_id'=>$request->provider_id,
                'name'=>$request->name,
                'date'=>$request->date,
                'cost'=>$request->cost,
                'notes'=>$request->notes,
                'key'=>$key
            ]);
        }
        $service = VehicleService::distinct('key')->where('key', $key)->first();
        $service['services'] = $services;
        return response()->json([
            'message' => 'Successful Service Created',
            'data' => [
                'service'=> $service
            ],
            'code' => 200
        ], 200);
    }
    public function update(Request $request, $vehicle_service_id)
    {
        $service = VehicleService::find($vehicle_service_id);

        $validator = Validator::make(
            $request->all(),
            [
                'vehicle_id'=>'required|exists:vehicles,id',
                'service_id'=>'required|exists:services,id',
                'provider_id'=>'required|exists:providers,id',
                'name'=>'required',
                'date'=>'required|date',
                'cost'=>'required|gte:0',
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Invalid Values',
                'code' => 422,
                'data' => $validator->errors()
            ], 422);
        }
        $service->update([
            'service_id'=>$request->service_id,
            'provider_id'=>$request->provider_id,
            'name'=>$request->name,
            'date'=>$request->date,
            'cost'=>$request->cost,
            'notes'=>$request->notes,
        ]);

        return response()->json([
            'message' => 'Successful Service Update',
            'data' => [
                'service'=> $service
            ],
            'code' => 200
        ], 200);
    }

    public function destroy($vehicle_service_id)
    {
        $service = VehicleService::findOrFail($vehicle_service_id);
        return response()->json([
            'message' => 'Success',
            'code' => 200,
            'data' => [
                'services'=> $service->delete()
            ]
        ], 200);     

    }
}
