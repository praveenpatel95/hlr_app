<?php

namespace Database\Seeders;

use App\Models\Group;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $groups = [
            ['group_value' => 1, 'category' => 'A', 'wait_time' => fake()->numberBetween(10, 60),],
            ['group_value' => 2, 'category' => 'B', 'wait_time' => fake()->numberBetween(10, 60),],
            ['group_value' => 3, 'category' => 'C', 'wait_time' => fake()->numberBetween(10, 60),],
            ['group_value' => 4, 'category' => 'D', 'wait_time' => fake()->numberBetween(10, 60),],
            ['group_value' => 5, 'category' => 'E', 'wait_time' => fake()->numberBetween(10, 60),],
            ['group_value' => 6, 'category' => 'F', 'wait_time' => fake()->numberBetween(10, 60),],
        ];

        foreach ($groups as $group) {
            Group::create($group);
        }
    }
}
