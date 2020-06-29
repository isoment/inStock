<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name', 'type', 'brand', 'price', 'description'
    ];

    public function orders() 
    {
        return $this->hasMany(Order::class);
    }
}
