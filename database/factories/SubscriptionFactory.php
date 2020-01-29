<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Subscription::class, function (Faker $faker) {
    return [
        'start_date' => $faker->dateTimeBetween('-30 days', '0 days'),
        'expiry_date' => $faker->dateTimeBetween('-30 days', '+30 days'),
        'amount' => $faker->randomFloat(),
        'payment_mode' => 'Mpesa',
        // 'mpesa_id' => $faker->randomNumber(),
        'user_id' => function () {
            return factory(App\User::class)->create()->id;
        },
        'plan_id' => function(){
            $plan_ids = [
                1, 2, 3,
            ];
            return $plan_ids[array_rand($plan_ids)];
        },
        'mpesa_id' => function () {
            return factory(App\Mpesa::class)->create()->id;
        },
    ];
});
