<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Reservation;
use Faker\Generator as Faker;

$factory->define(Reservation::class, function (Faker $faker) {
    return [
        'restaurant_id' => random_int(1,5),
        'user_id' => 1,
        'room_id' => random_int(1,5),
        'reservation_date' => $faker->date(),
        'begin'  => '13:00',
        'end'    => '16:00',
        'status' => 1
    ];
});
