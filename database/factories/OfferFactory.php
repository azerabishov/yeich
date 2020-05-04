<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Offer;
use Faker\Generator as Faker;

$factory->define(Offer::class, function (Faker $faker) {
    return [
        'image' => $faker->imageUrl(),
        'description' => $faker->sentence(4),
        'sub_description' => $faker->sentence(9),
        'offer_hours' => $faker->time().'-'.$faker->time(),
        'restaurant_id' => random_int(1,20)
    ];
});
