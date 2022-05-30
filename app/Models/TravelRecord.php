<?php

namespace App\Models;

use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class TravelRecord extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];
    protected $dates = [
        'datetime',
        'created_at',
        'updated_at'
    ];
    
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function getIsLatestAttribute()
    {
        $vehicle_id = $this->vehicle_id;
        return TravelRecord::where('vehicle_id', $vehicle_id)->orderBy('id','desc')->first()->id == $this->id;
    }
}
