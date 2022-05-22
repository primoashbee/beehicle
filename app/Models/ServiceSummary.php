<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\VehicleServices;
class ServiceSummary extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function services()
    {
        $this->hasMany(VehicleServices::class,'key','key');
    }
}
