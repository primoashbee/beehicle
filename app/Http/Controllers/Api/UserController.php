<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
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
            $message = 'Invalid Values';

            return response()->json([
                'message' => $message,
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
        $user->sendEmailVerificationNotification();
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
        $data = User::with(['vehicles.transactions','vehicles.services','vehicles.serviceSummary.services','vehicles.travels','vehicles.pms'])->find($user_id);
        
        return response()->json([
            'message'=>'Successful',
            'data'=> $data
        ],200);
    }

    public static function refreshData()
    {
        $user_id = auth('sanctum')->user()->id;
        // return User::find($user_id);
        $data = User::with(['vehicles.transactions','vehicles.services','vehicles.serviceSummary.services','vehicles.travels','vehicles.pms'])->find($user_id);
        return $data;
    }

    public function resetPassword(Request $request)
    {
        $validator = Validator::make($request->all(),
        [
            'email'=>'required|email'
        ]
        );
        if($validator->fails()){
            return response()->json([
                'code'=>422,
                'message'=>'Invalid email',
                'data'=> $validator->errors()
            ]);
        }
        $status = Password::sendResetLink(['email'=>$request->email]);

        return response()->json([
            'code'=>200,
            'message'=>'Please check email',
            'data'=> []
        ],200);
    }

    public function update(Request $request, $user_id)
    {
        $user = User::find($user_id);
        
        $validator = Validator::make(
            $request->all(),
                [
                    'name' => ['required', 'string', 'max:255'],
                    // 'gender' => ['required', Rule::in(['Male', 'Female'])],
                    'birthday' => ['required', 'date'],
                    'phone_number' => ['required', 'unique:users,phone_number, ' . $user->id],
                    'address' => ['required'],
                    'email' => ['required', 'string', 'email', 'unique:users,email, ' . $user->id],
                ]
        );
        
        if($validator->fails()){
            $message = 'Invalid Values';

            return response()->json([
                'message' => $message,
                'code'=>422,
                'data' => $validator->errors()
            ], 422);            
        }

        $user->update([
            'name'=>$request->name,
            'birthday'=> Carbon::parse($request->birthday),
            'phone_number'=>$request->phone_number,
            'address'=>$request->address,
            'email'=>$request->email
        ]);

        return response()->json([
            'message'=>'Profile Updated',
            'code'=>200,
            'data'=> UserController::refreshData()
        ],200);
    }
    
}
