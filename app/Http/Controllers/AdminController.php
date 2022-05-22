<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Vehicle;
use App\Models\ServiceSummary;
use App\Models\Service;
use App\Models\Transaction;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function index(){
        // dd('here');
        // $data['user'] = User::all();
        // $data['vehicle'] = Vehicle::all();
        // return response()->json($data);
        // exit;
        $total_users = User::count();
        $total_vehicles = Vehicle::count();
        $total_transactions = Transaction::count();
        $total_services = Service::count();
        return view('pages.dashboard',compact('total_users','total_vehicles','total_transactions','total_services'));
        // return User::with('vehicles.services')->get();
    }

    public function users()
    {
        $users = User::paginate(10);
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
}
