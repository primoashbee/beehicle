<?php

namespace App\Models;

use App\Models\Service;
use App\Models\Provider;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VehicleService extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function provider()
    {
        return $this->belongsTo(Provider::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function getServicesAttribute()
    {
        
        return VehicleService::where('key', $this->key)->get();
        // return $this->hasMany(VehicleService::class,'key','key');
    }
}
