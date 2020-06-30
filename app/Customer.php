<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;

class Customer extends Model
{
    use SearchableTrait;

    protected $searchable = [
        'columns' => [
            'customers.customer_name' => 10,
            'customers.email' => 10,
            'customers.address' => 10,
            'customers.phone_number' => 10,
        ]
    ];

    protected $fillable = [
        'customer_name', 'email', 'address', 'phone_number', 'contact_method'
    ];
}
