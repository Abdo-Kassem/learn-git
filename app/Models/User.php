<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $guarded = [];
    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public const FEATURED = 1;
    public const ACTIVE = 2;
    public const NEW = 3;


    public function getJWTIdentifier() {
        return $this->getKey();
    }
    
    public function getJWTCustomClaims() {
        return [];
    }

    /*
    public function getLocationAttribute($value)
    {
        return json_decode($value);
    }

    public function setLocationAttribute($value)
    {
        $this->attributes['location'] = json_encode($value);
    }
    */
    public function products()
    {
        return $this->hasMany(Product::class, 'user_id', 'id');
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class, 'user_id', 'id');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id', 'id');
    }

    public function area()
    {
        return $this->belongsTo(Area::class, 'area_id', 'id');
    }

    public function searchHistroy()
    {
        return $this->hasMany(SearchHistory::class, 'user_id', 'id');
    }

}
