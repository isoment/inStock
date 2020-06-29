<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'product_id', 'status', 'tracking', 'customer_name', 'email', 'address',
        'item_cost', 'tax', 'shipping', 'total_price', 'paid'
    ];

    public function products() 
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
