<?php

use Illuminate\Database\Seeder;

class ModelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Match::class, 50)->create();
        // factory(App\Mpesa::class, 50)->create();
        factory(App\Subscription::class, 50)->create();
    }
}
