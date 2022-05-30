<?php

namespace App\Http\Controllers\Api;

use App\Models\Vehicle;
use App\Rules\OdometerRule;
use App\Models\TravelRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
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
        $status = $vehicle->fresh()->status;
        $message = 'Success';
        if($status['for_pms']){
            $message = 'Record Added. Please add PMS record for ' . $status['pms_kms']. ' kms';
        }
        return response()->json([
            'message' => $message,
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
