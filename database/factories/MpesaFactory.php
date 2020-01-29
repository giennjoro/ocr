<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Mpesa::class, function (Faker $faker) {
    return [
        'user_id' => function(){
            $user_ids = [
                1, 2,
            ];
            return $user_ids[array_rand($user_ids)];
        },
        'plan_id' => function(){
            $plan_ids = [
                1, 2, 3,
            ];
            return $plan_ids[array_rand($plan_ids)];
        },
        'merchantRequestID' => $faker->word,
        'result' => $faker->text,
        'checkoutRequestID' => $faker->word,
        'resultCode' => function(){
            $results = [
                0, 1032, '',
            ];
            return $results[array_rand($results)];
        },
        'responseCode' => function(){
            $results = [
                0, 1032, '',
            ];
            return $results[array_rand($results)];
        },
        'resultDesc' => $faker->word,
        'responseDescription' => $faker->word,
        'customerMessage' => $faker->word,
        'mpesaReceiptNumber' => $faker->word,
        'phoneNumber' => $faker->phoneNumber,
        'amount' => $faker->randomFloat(),
        'balance' => $faker->randomFloat(),
        'active' => $faker->boolean,
        'transactionDate' => $faker->dateTimeBetween('-30 days', '+0 days'),
    ];
});
