<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Match::class, function (Faker $faker) {
    return [
        'league' => function(){
            $leagues = [
                'EPL - England', 'KPL - Kenya', 'COPA - America', 'Championship - England', 'FA', 'AFCON', 'World Cup', 
            ];
            return $leagues[array_rand($leagues)];
        },
        'home' =>  function(){
            $teams = [
                'Man U', 'Harambe Stars', 'Senegal', 'Chelsea', 'Arsenal', 'Watford', 'Aston Villa', 'Barc', 'Real Madrid', 'Bayern', 'BVB', 'Hapoel',
            ];
            return $teams[array_rand($teams)];
        },
        'away' => function(){
            $teams = [
                'Man U', 'Harambe Stars', 'Senegal', 'Chelsea', 'Arsenal', 'Watford', 'Aston Villa', 'Barc', 'Real Madrid', 'Bayern', 'BVB', 'Hapoel',
            ];
            return $teams[array_rand($teams)];
        },
        'slug' => $faker->slug,
        'tip' => function(){
            $tips = [
                'Corect Score(0 - 0)', 'GG', 'Over 2.5', 'Under 1.5', '1 - HT', '1',
            ];
            return $tips[array_rand($tips)];
        },
        // 'outcome' => $faker->word,
        'odd' => function(){
            $odds = [
                '2.5', '3.6', '1.5', '1.4', '2.4'
            ];
            return $odds[array_rand($odds)];
        },
        'time' => $faker->dateTimeBetween('-30 days', '+30 days'),
        'pro' => $faker->boolean,
        // 'won' => $faker->boolean,
    ];
});
