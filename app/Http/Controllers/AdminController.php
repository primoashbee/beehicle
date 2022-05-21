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
        // return view('admin/dashboard');
        return User::with('vehicles.services')->get();
    }
}
