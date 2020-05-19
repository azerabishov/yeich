<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Restaurant;
use Faker\Generator as Faker;

$factory->define(Restaurant::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'image' => $faker->imageUrl(),
        'average_price' => '100-200',
        'metro' => $faker->state,
        'phone' => $faker->phoneNumber,
        'payment_method' => 'visa,paypal',
        'dress_code' => 'casual',
        'parking' => 'no',
        'categories' => '1,2,5,6,8,9',
        'description' => $faker->sentence,
        'open_time' => ('10:00'),
        'close_time' => ('12:00'),
        'mainhall' => 1,
        'room' => 1,

    ];
});
