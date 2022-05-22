<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\VehicleService;
class ServiceSummary extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function services()
    {
        $this->hasMany(VehicleService::class,'key','key');
    }
}
