<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Plan::class, function (Faker $faker) {
    return [
        'title' => $faker->word,
        'lifespan' => $faker->randomNumber(),
        'description' => $faker->text,
        'offer' => $faker->word,
        'charges' => $faker->word,
    ];
});
