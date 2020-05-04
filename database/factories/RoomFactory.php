<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Room;
use Faker\Generator as Faker;

$factory->define(Room::class, function (Faker $faker) {
    return [
        'name' => $faker->firstName,
        'image' => $faker->imageUrl(),
        'feature' => $faker->sentence(5),
        'number_of_person' => random_int(3,8),
        'deposite' => '50',
        'time_interval' => strval(random_int(-1,5)),
        'restaurant_id' => 4
    ];
});


//            $table->id();
//            $table->string('name');
//            $table->string('image');
//            $table->text('feature');
//            $table->integer('number_of_person');
//            $table->string('deposite');
//            $table->string('time_interval');
//            $table->unsignedBigInteger('restaurant_id');
//            $table->timestamps();
