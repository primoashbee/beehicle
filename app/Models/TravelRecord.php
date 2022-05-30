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
}
