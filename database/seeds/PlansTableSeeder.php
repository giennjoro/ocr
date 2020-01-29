<?php

use Illuminate\Database\Seeder;

class PlansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Plan::create([
            'title' => '1 Day Plan',
            'description' => 'Daily',
            'charges' => 50.00,
            'lifespan' => 1,
        ]);
        App\Plan::create([
            'title' => '1 Week Plan',
            'description' => 'Weekly',
            'offer' => '25% off',
            'charges' => 300.00,
            'lifespan' => 7,
        ]);
        App\Plan::create([
            'title' => '1 Month Plan',
            'description' => 'Monthly',
            'offer' => '30% off',
            'charges' => 600.00,
            'lifespan' => 30,
        ]);
    }
}
