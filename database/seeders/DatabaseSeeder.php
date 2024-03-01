<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //User Seeder
        \App\Models\User::create([
            'id' => fake()->uuid(),
            'name' => "admin",
            'email' => "admin@email.com",
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ]);
        \App\Models\User::create([
            'id' => fake()->uuid(),
            'name' => "admin2",
            'email' => "admin2@email.com",
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ]);


        // Category Seeder
        foreach (['Elektronik', 'Fashion', 'Software'] as $c) {
            \App\Models\Category::create([
                'id' => fake()->uuid(),
                'name' => $c
            ]);
        }

        \App\Models\Product::factory(50)->create();
    }
}
