<?php

namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class ComputersTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        foreach (range(1, 50) as $index) {
            DB::table('computers')->insert([
                'computer_name' => $faker->unique()->word,
                'model' => $faker->word . ' ' . $faker->randomNumber(4),
                'operating_system' => $faker->randomElement(['Windows 10 Pro', 'Ubuntu 22.04', 'macOS Monterey']),
                'processor' => $faker->randomElement(['Intel Core i5-11400', 'AMD Ryzen 5 5600X']),
                'memory' => $faker->numberBetween(4, 64),
                'available' => $faker->boolean,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}

