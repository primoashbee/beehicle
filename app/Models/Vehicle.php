<?php

namespace App\Models;

use App\Models\PMS;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vehicle extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];

    protected $dates = [
        'created_at',
        'updated_at',
        'date_purchased'
    ];

    protected $appends = ['pms_records'];
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

    public function travels()
    {
        return $this->hasMany(TravelRecord::class);
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function pms()
    {
        return $this->hasMany(PMS::class);
    }

    public function getPMSRecordsAttribute()
    {
        $first = PMS::where('vehicle_id', $this->id)->where('pms_kms', 1000)->first();
        $second = PMS::where('vehicle_id', $this->id)->where('pms_kms', 5000)->first();
        $third = PMS::where('vehicle_id', $this->id)->where('pms_kms', 10000)->first();

        $has_travel_record    =  is_null($this->travels()->orderBy('id','desc')->first()) ? false : true;
        return [
            [ 
                'pms_kms'=>'1000',
                'data'=> $first,
                'alert'=> ($has_travel_record && $this->travels()->orderBy('id','desc')->first()->odometer_end >= 1000) ? true : false,
                'done'=> !is_null($first) ? true : false
            ],
            [ 
                'pms_kms'=>'5000',
                'data'=> $second,
                'alert'=> ($has_travel_record && $this->travels()->orderBy('id','desc')->first()->odometer_end >= 5000)   ? true : false,
                'done'=> !is_null($second) ? true : false

            ],
            [ 
                'pms_kms'=>'10000',
                'data'=> $third,
                'alert'=> ($has_travel_record && $this->travels()->orderBy('id','desc')->first()->odometer_end >= 10000)  ? true : false,
                'done'=> !is_null($third) ? true : false

            ],
        ];
    }
}
