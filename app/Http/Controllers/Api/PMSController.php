<?php

namespace App\Http\Controllers\Api;

use App\Models\PMS;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class PMSController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'vehicle_id'=>'required|exists:vehicles,id',
            'pms'=>['required', Rule::in(['1000','5000','10000'])]
        ]);

        if($validator->fails()){
            return response([
                'code'=>422,
                'message'=>'Please check all fields',
                'data'=>$validator->errors()
            ],422);
        }
        if($request->pms == '1000'){
            $rules = [
                'break_system'=>'required',
                'engine'=>'required',
                'oil'=>'required',
                'filters'=>'required',
                'washer_fluid'=>'required',
                'engine_coolant'=>'required',
                'cost'=>'required',
                'date'=>'required|date',
                'notes'=>'nullable',
            ];
        }
        if($request->pms == '5000'){
            $rules = [
                'change_oil'=>'required',
                'change_oil_filter'=>'required',
                'change_oil_leaks'=>'required',
                'date'=>'required|date',
                'notes'=>'nullable'
            ];
        }
        if($request->pms == '10000'){
            $rules = [
                'mandatory_oil_change'=>'required',
                'brake_pads'=>'required',
                'axle_joints'=>'required',
                'parking_break'=>'required',
                'clutch'=>'required',
                'steering'=>'required',
                'suspension_system'=>'required',
                'date'=>'required|date',
                'notes'=>'nullable'
            ];
        }
        $validator = Validator::make($request->all(),$rules);
        if($validator->fails()){
            return response([
                'code'=>422,
                'message'=>'Please check all fields',
                'data'=>$validator->errors()
            ],422);
        }
        if(PMS::where('vehicle_id', $request->vehicle_id)->where('pms_kms', $request->pms)->count() > 0){
                return response([
                    'code'=>422,
                    'message'=>'Already have record for this PMS',
                    'data'=> []
                ],422);
        }
        $pms = PMS::create([
            'vehicle_id'=>$request->vehicle_id,
            'pms_kms'=>$request->pms,
            'data' => json_encode($request->all()),
            'date'=> Carbon::parse($request->date)
        ]);
        return response([
            'code'=>200,
            'message'=>'PMS Created',
            'data'=>UserController::refreshData()
        ],200);
    }
}
