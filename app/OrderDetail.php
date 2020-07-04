<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    public function orders() 
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function products()
    {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }
}
