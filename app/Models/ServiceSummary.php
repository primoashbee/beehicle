<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\VehicleService;
use App\Models\Provider;
class ServiceSummary extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function services()
    {
        return $this->hasMany(VehicleService::class,'key','key');
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function provider(){
        return $this->belongsTo(Provider::class);
    }
}
