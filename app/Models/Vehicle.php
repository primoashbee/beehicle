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

    public function serviceSummary()
    {
      return $this->hasMany(ServiceSummary::class);
    }
}
