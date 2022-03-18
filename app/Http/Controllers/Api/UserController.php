<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //

    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
                [
                    'name' => ['required', 'string', 'max:255'],
                    'gender' => ['required', Rule::in(['Male', 'Female'])],
                    'birthday' => ['required', 'date'],
                    'phone_number' => ['required', 'unique:users,phone_number'],
                    'address' => ['required'],
                    'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                    'password' => ['required', 'string', 'min:8', 'confirmed'],
                ]
        );

        if($validator->fails()){
            return response()->json([
                'message' => 'Invalid Values',
                'code'=>422,
                'data' => $validator->errors()
            ], 422);            
        }
        $user =  User::create([
            'name' => $request->name,
            'gender' => $request->gender,
            'birthday' => $request->birthday,
            'phone_number' => $request->phone_number,
            'address' => $request->address,
            'email' => $request->email,
            'password ' => Hash::make($request->password),
        ]);
        return response()->json([
            'message'=>'test',
            'data'=>[
                'user'=>$user
            ]
        ],200);
    }
}
