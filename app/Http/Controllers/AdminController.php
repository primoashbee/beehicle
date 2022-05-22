<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Vehicle;
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
        return view('pages.dashboard');
        // return User::with('vehicles.services')->get();
    }

    public function users()
    {
        $users = User::paginate(10);
        return view('pages.users', compact('users'));
    }

    public function vehicles()
    {
        return view('pages.users');
    }
    
    public function services()
    {
        return view('pages.services');
    }

    public function transactions()
    {
        return view('pages.users');
    }
}
