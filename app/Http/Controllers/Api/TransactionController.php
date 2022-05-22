<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'vehicle_id'=>'required|exists:vehicles,id',
                'lat'=>'required',
                'lng'=>'required',
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
    }
}
