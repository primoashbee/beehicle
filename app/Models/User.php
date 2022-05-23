<?php

namespace App\Models;

use Illuminate\Validation\Rule;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;
    const APP_USER = 2;
    const ADMIN = 1;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    // protected $fillable = [
    //     'name',
    //     'email',
    //     'password',
    // ];
    protected $guarded = [];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function vehicles()
    {
        return $this->hasMany(Vehicle::class, 'user_id');
    }
    public function getUserTypeAttribute()
    {
        if($this->type == self::ADMIN){
            return 'Adminstrator';
        }
        if($this->type == self::APP_USER){
            return 'App User';
        }
    }

    public function getIsAdminAttribute()
    {
        return $this->type == self::ADMIN ? true : false;
    }

    public function getVerifiedAttribute()
    {
        return is_null($this->email_verified_at) ? false : true;
    }

    public function getVerifiedStatusAttribute()
    {
        return $this->verified == 'Verified' ? 'Verified' : 'Pending';
    }

}
