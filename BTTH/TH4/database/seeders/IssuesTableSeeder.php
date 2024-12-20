<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class IssuesTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        foreach (range(1, 20) as $index) {
            DB::table('issues')->insert([
                'computer_id' => $faker->numberBetween(1, 10),
                'reported_by' => $faker->name,
                'reported_date' => $faker->dateTimeThisYear,
                'description' => $faker->text,
                'urgency' => $faker->randomElement(['Low', 'Medium', 'High']),
                'status' => $faker->randomElement(['Open', 'In Progress', 'Resolved']),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
