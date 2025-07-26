<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_id', 'id');
    }
}
