<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;

class Order extends Model
{
    use SearchableTrait;

    protected $searchable = [
        'columns' => [
            'orders.ship_to' => 10,
            'orders.ship_address' => 10,
            'orders.tracking' =>10,
            'orders.status' => 10,
            'orders.shipper' => 10,
        ]
    ];

    protected $fillable = [
        'product_id', 'status', 'tracking', 'customer_name', 'email', 'address',
        'item_cost', 'tax', 'shipping', 'total_price', 'paid'
    ];

    public function details() 
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function customers()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
}
