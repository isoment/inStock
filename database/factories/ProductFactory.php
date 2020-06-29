<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => $faker->randomElement(['Dummy Product']),
        'type' => $faker->randomElement(['Camera', 'Laptop', 'Phone', 'Watch', 'Tablet', 'Computer', 'Other']),
        'brand' => $faker->randomElement(['Apple', 'Samsung', 'Google', 'Sony', 'Canon', 'Fuji', 'HTC', 'Lenovo']),
        'price' => $faker->randomFloat(2, 100, 2000),
        'description' => $faker->paragraph
    ];
});
