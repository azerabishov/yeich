<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(\App\Sponsor::class, function (Faker $faker) {
    return [
        'name' => $faker->company,
        'image' => $faker->imageUrl(),
        'website' => $faker->url,
        'ended_at' => '2020-05-07 21:00:00'
    ];
});
