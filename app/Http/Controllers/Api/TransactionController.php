<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TransactionController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'vehicle_id'=>'required|exists:vehicles,id',
                'from.lat'=>'required',
                'from.lng'=>'required',
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

        return response()->json([
            'message' => 'Success',
            'code' => 200,
            'data'=> []
        ]);
    }
}
