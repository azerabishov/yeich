<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Menu;
use Faker\Generator as Faker;

$factory->define(Menu::class, function (Faker $faker) {
    return [
        'menu' => $faker->url,
        'pdf' => $faker->url,
        'restaurant_id' => factory(App\Restaurant::class)->create()
    ];
});
