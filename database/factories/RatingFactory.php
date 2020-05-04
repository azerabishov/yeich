<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Rating;
use Faker\Generator as Faker;

$factory->define(Rating::class, function (Faker $faker) {
    return [
        'design' => random_int(3,5),
        'service' => random_int(3,5),
        'food' => random_int(3,5),
        'contingent' => random_int(3,5),
        'star' => random_int(3,5),
        'comment' => $faker->sentence,
        'reservation_id' =>random_int(1,9),
        'user_id' => 1
    ];
});
