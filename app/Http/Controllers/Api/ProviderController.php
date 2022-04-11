<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Provider;
use Illuminate\Http\Request;

class ProviderController extends Controller
{
    public function index()
    {
        return response()->json([
            'message' => 'Success',
            'code' => 200,
            'data' => [
                'services'=> Provider::select('id','name')->orderBy('name','asc')->get()
            ]
        ], 200);       
    }
}
