<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vehicle extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function services()
    {
        return $this->hasMany(VehicleService::class);
    }
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function getVehicleServicesAttribute()
    {
        // return \DB::table('vehicle_services')
        //         ->select('name','date','cost','created_at')
        //         ->distinct()
        //         ->get();
        
        return VehicleService::select('name','date','cost','created_at','key')
            ->distinct()
            ->get()
            ->each->append('services');
        return $services;
    }
}
