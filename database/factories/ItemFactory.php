<?php

use Faker\Generator as Faker;
use App\Models\Item;

$factory->define(Item::class, function (Faker $faker) {
    return [
        'item_category_id' => array_random([1, 2, 3, 4, 5]),
        'name' => $faker->text(15),
        'image' => $faker->image('public/images/', 50, 50, 'cats', false),
        'price' => $faker->randomNumber(4),
        'stock' => $faker->randomNumber(2),
    ];
});
