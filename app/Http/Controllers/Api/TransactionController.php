<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Transaction;

class TransactionController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'vehicle_id'=>'required|exists:vehicles,id',
                'from.address'=>'required',
                'from.lat'=>'required',
                'from.lng'=>'required',

                'to.address'=>'required',
                'to.lat'=>'required',
                'to.lng'=>'required',

                'odometer'=>'required'
            ]
        );

        if($validator->fails())
        {
            return response()->json([
                'message' => 'Invalid Values',
                'code'=>422,
                'data' => $validator->errors()
            ], 422);  
        }

        $transaction = Transaction::create([
            'vehicle_id'=>$request->vehicle_id,
            'from_address'=>$request->from['address'],
            'from_lat'=>$request->from['lat'],
            'from_lng'=>$request->from['lng'],

            'to_address'=>$request->from['address'],
            'to_lat'=>$request->to['lat'],
            'to_lng'=>$request->to['lng'],
        ]);

        return response()->json([
            'message' => 'Success',
            'code' => 200,
            'data'=> [$transaction]
        ]);
    }
}
