<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;

class Order extends Model
{
    use SearchableTrait;

    protected $searchable = [
        'columns' => [
            'orders.customer_name' => 10,
            'orders.email' => 10,
            'orders.address' => 10,
            'orders.tracking' =>10,
            'orders.status' => 10,
            'orders.product_name' => 10,
        ]
    ];

    protected $fillable = [
        'product_id', 'status', 'tracking', 'customer_name', 'email', 'address',
        'item_cost', 'tax', 'shipping', 'total_price', 'paid'
    ];

    public function products() 
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
