<?php

namespace App\Models;

use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TravelRecord extends Model
{
    use HasFactory;
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
}
