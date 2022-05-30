<?php

namespace App\Http\Controllers\Api;

use App\Models\Vehicle;
use App\Models\TravelRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use App\Rules\OdometerRule;
use Illuminate\Support\Facades\Validator;

class TravelRecordController extends Controller
{
    public function store(Request $request){
        $validator = Validator::make(
            $request->all(),
            [
                'vehicle_id'=>'required|exists:vehicles,id',

                'address_start'=>'required',
                'address_end'=>'required',
                
                'odometer_start'=>['required','gte:0', new OdometerRule($request->vehicle_id, 'start')],
                'odometer_end'=>'required|gte:odometer_start',
                'datetime'=>'required|date|before:tomorrow',
                'notes'=>'nullable',
            ]
        );

        if($validator->fails())
        {
            return response()->json([
                'message' => 'Invalid Values',
                'code'=>422,
                'data' => $validator->errors()
            ],422);
        }

        $vehicle = Vehicle::find($request->vehicle_id);
        $request->request->add([
            'datetime' => Carbon::parse($request->datetime)
        ]);
        $travel = $vehicle->travels()->create($request->except('vehicle_id'));
        if($vehicle->pms_records){

        }
        return response()->json([
            'message' => 'Success',
            'code' => 200,
            'data'=> UserController::refreshData()
        ]);
    }
    public function delete($trasaction_id){
        

       $record = TravelRecord::find($trasaction_id);
       if($record->vehicle->user_id != auth('sanctum')->user()->id){
            return response()->json([
                'message' => 'Authentication failed',
                'code'=>422,
                'data' => []
            ], 422); 
       }

        $record->delete();
        return response()->json([
            'message' => 'Travel Record Deleted',
            'code' => 200,
            'data'=> UserController::refreshData()
        ]);
    }
}
