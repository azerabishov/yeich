<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Category;
use Faker\Generator as Faker;

$factory->define(Category::class, function (Faker $faker) {
    return [
        'name' => 'asian',
        'is_category' => 0,
        'is_cuisen' => 1,
        'is_feature' => 0,
    ];
});


//$table->id();
//$table->string('name');
//$table->integer('is_category');
//$table->integer('is_cuisen');
//$table->integer('is_feature');
//$table->timestamps();
