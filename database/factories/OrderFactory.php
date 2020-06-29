<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Order;
use Faker\Generator as Faker;

$factory->define(Order::class, function (Faker $faker) {
    return [
        'product_id' => $faker->numberBetween(1, 25),
        'product_name' => $faker->randomElement(['Dummy Product']),
        'status' => $faker->randomElement(['Open', 'Paid', 'Shipped']),
        'tracking' => $faker->iban('CA'),
        'customer_name' => $faker->name(),
        'email' => $faker->email(),
        'address' => $faker->address(),
        'item_cost' => $faker->randomFloat(2, 200, 2000),
        'tax' => $faker->randomFloat(2, 1, 50),
        'shipping' => $faker->randomFloat(2, 1, 50),
        'total_price' => $faker->randomFloat(2, 200, 2000),
        'paid' => $faker->randomElement(['No', 'Yes']),
    ];
});
