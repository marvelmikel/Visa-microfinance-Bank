<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facade\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        $user = \App\Models\User::updateOrCreate(
            [
                'email' => 'testuser@example.com'
            ],
            [
                'name' => 'Test User',
                'email' => 'testuser@example.com',
                'password' => \Hash::make('password'),
            ]
        );

        $user->wallet()->updateOrCreate(['user_id' => $user->id]);


        $admin = \App\Models\User::updateOrCreate(
            [
                'email' => 'testadmin@example.com',
            ],
            [
                'name' => 'Test Admin',
                'email' => 'testadmin@example.com',
                'password' => \Hash::make('password'),
            ]
        );

        $admin->wallet()->updateOrCreate(['user_id' => $admin->id]);
    }
}
