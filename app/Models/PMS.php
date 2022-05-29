<?php

namespace App\Models;

use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PMS extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table ='pms';
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }
}
