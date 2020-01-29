<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        App\User::create([
            'name' => 'Developer',
            'slug' => str_slug('Developer@Test'),
            'email' => 'info@24seven.co.ke',
            'phone' => '+254 7XX XXXXXX',
            'type' => 'super',
            'is_admin' => true,
            'view' => false,
            'password' => bcrypt('@24seven')
        ]);
        App\User::create([
            'name' => 'Double Quick Admin',
            'slug' => str_slug('Double Quick Admin'),
            'email' => 'info@doublequik.com',
            'phone' => '+254 7XX XXXXXX',
            'type' => 'super',
            'is_admin' => true,
            'password' => bcrypt('@double2019')
        ]);
    }
}
