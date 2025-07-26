<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    
    const OLD = 1;
    const NEW = 2;
    const DELIVERY_FROM_PLACE = 1;
    const SHIPPING = 2;


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
    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class);
    }

    public function product_images()
    {
        return $this->hasMany('App\Models\ProductImage');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id', 'id');
    }

    public function likes()
    {
        return $this->hasMany(Like::class, 'product_id', 'id');
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id', 'id');
    }

    public function area()
    {
        return $this->belongsTo(Area::class, 'area_id', 'id');
    }

    public function subscription()
    {
        return $this->hasOne(Subscription::class, 'product_id', 'id');
    }

    public function views()
    {
        return $this->hasMany(ProductView::class, 'product_id', 'id');
    }

    public function complaints()
    {
        return $this->belongsToMany(
            User::class, 
            Complaint::class, 
            'product_id', 
            'user_id', 
            'id', 
            'id'
        );
    }

}
