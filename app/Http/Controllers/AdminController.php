<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Vehicle;
use App\Models\ServiceSummary;
use App\Models\Service;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    //
    public function index(){
        // dd('here');
        // $data['user'] = User::all();
        // $data['vehicle'] = Vehicle::all();
        // return response()->json($data);
        // exit;
        $total_users = User::where('type',User::APP_USER)->count();
        $total_vehicles = Vehicle::count();
        $total_transactions = Transaction::count();
        $total_services = Service::count();
        return view('pages.dashboard',compact('total_users','total_vehicles','total_transactions','total_services'));
        // return User::with('vehicles.services')->get();
    }

    public function users()
    {
        $users = User::where('type', User::APP_USER)->paginate(10);
        return view('pages.users', compact('users'));
    }

    public function vehicles()
    {
        $vehicles = Vehicle::paginate(10);
        return view('pages.vehicles',compact('vehicles'));
    }
    
    public function services()
    {
        $services = ServiceSummary::with('services','vehicle.user','provider')->paginate(10);
        return view('pages.services',compact('services'));
    }

    public function transactions()
    {
        $transactions = Transaction::with('vehicle','user')->paginate(10);
        return view('pages.transactions',compact('transactions'));
    }
    public function profile()
    {
        $user = auth()->user();
        return view('pages.profile', compact('user'));
    }
    public function updateProfile(Request $request)
    {
        $user = auth()->user();
        $id = $user->id;
        $request->validate(
            [
                'name'=>'required',
                'email'=>'required|unique:users,email,'.$id,
                'phone_number'=>'required|unique:users,phone_number,'.$id,
                'password'=>'nullable|min:8|confirmed',
            ]
        );
        if(!is_null($request->password)){
            $user->update(
                [
                    'name'=>$request->name,
                    'email'=>$request->email,
                    'phone_number'=>$request->phone_number,
                    'password'=> Hash::make($request->password)
                ]
             );
             session()->flash('status', [
                 'code'=>200,
                 'message'=>'Profile Successfully Updated'
            ]);
            return redirect()->back();
        }
        $user->update(
            [
                'name'=>$request->name,
                'email'=>$request->email,
                'phone_number'=>$request->phone_number,
            ]
         );
         session()->flash('status', [
             'code'=>200,
             'message'=>'Profile Successfully Updated'
        ]);

        return redirect()->back();
    }
}
