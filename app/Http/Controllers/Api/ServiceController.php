<?php

namespace App\Http\Controllers\Api;

use App\Models\Vehicle;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Support\Facades\Validator;

class ServiceController extends Controller
{
    public function index()
    {
        return response()->json([
            'message' => 'Success',
            'code' => 200,
            'data' => [
                'services'=> Service::select('id','name')->orderBy('name','asc')->get()
            ]
        ], 200);       
    }
    public function vehicleServices($vehicle_id)
    {
        $vehicle = Vehicle::find($vehicle_id);
        if (is_null($vehicle)) {
            return response()->json([
                'message' => 'Invalid Resource',
                'code' => 404,
                'data' => []
            ], 404);
        }
        return response()->json([
            'message' => 'Success',
            'code' => 200,
            'data' => [
                'services'=> $vehicle->services
            ]
        ], 200);

    }
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'vehicle_id'=>'required|exists:vehicles,id',
                'name' => 'required',
                'service_date' => 'required|date',
                'amount' => 'required|gte:0',
                'next_service_date' => 'required|date',
                'service_provider' => 'required',
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

        $service = $vehicle->services()->create([
            'name'=>$request->name,
            'service_date'=>$request->service_date,
            'amount'=>$request->amount,
            'next_service_date'=>$request->next_service_date,
            'service_provider'=>$request->service_provider,
        ]);
        return response()->json([
            'message' => 'Success',
            'code' => 200,
            'data' => [
                'services'=> $service
            ]
        ], 200);

    }

    public function update(Request $request, $id)
    {
        $service = Service::find($id);
        if (is_null($service)) {
            return response()->json([
                'message' => 'Invalid Resource',
                'code' => 404,
                'data' => []
            ], 404);
        }
        
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required',
                'service_date' => 'required|date',
                'amount' => 'required|gte:0',
                'next_service_date' => 'required|date',
                'service_provider' => 'required',
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
                'vehicle_id' => $request->vehicle_id,
                'name' => $request->name,
                'service_date' => $request->service_date,
                'amount' => $request->amount,
                'next_service_date' => $request->next_service_date,
                'service_provider' => $request->service_provider,            
        ]);

        return response()->json([
            'message' => 'Service updated success',
            'code' => 200,
            'data' => [
                'service' => $service
            ]
        ], 200);
    }

    public function delete($id)
    {
        $service = Service::find($id);

        if (is_null($service)) {
            return response()->json([
                'message' => 'Invalid Resource',
                'code' => 404,
                'data' => []
            ], 404);
        }

        $service->delete();

        return response()->json([
            'message' => 'Service delete success',
            'code' => 200,
            'data' => [
            ]
        ], 200);
    }
}
