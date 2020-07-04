<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;

class Product extends Model
{
    use SearchableTrait;

    protected $searchable = [
        'columns' => [
            'products.name' => 10,
            'products.type' => 10,
            'products.brand' => 10,
        ]
    ];

    protected $fillable = [
        'name', 'type', 'brand', 'price', 'description'
    ];

    // public function details() 
    // {
    //     return $this->belongsTo(OrderDetail::class, 'product_id');
    // }
}
