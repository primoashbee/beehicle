<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
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
            'birthday' => Carbon::parse($request->birthday),
            'phone_number' => $request->phone_number,
            'address' => $request->address,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $token = $user->createToken('auth_token')->plainTextToken;
        return response()->json([
            'message'=>'Successful Registration',
            'data'=>[
                'access_token'=>$token,
                'code'=>200,
                'token_type'=>'Bearer'
            ],
            'code'=>200
        ],200);
    }

    public function login(Request $request)
    {
        if(!Auth::attempt($request->only('email','password'))){
            return response()->json([
                'message'=>'Invalid Credentials',
                'code'=>401
            ],401);
        }

        $user = User::where('email',$request->email)->first();
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message'=>'Successful Login',
            'data'=>[
                'access_token'=>$token,
                'code'=>200,
                'token_type'=>'Bearer'
            ]
        ],200);
    }

    public function setup()
    {
        $user_id = auth('sanctum')->user()->id;
        $data = User::with(['vehicles.transactions','vehicles.services','vehicles.service_summary'])->find($user_id);
        
        return response()->json([
            'message'=>'Successful',
            'data'=> $data
        ],200);
    }
    
}
