<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create([
            'name' => "Community",
            'created_at' => now(),
            'updated_at' => now()
        ]);
        Category::create([
            'name' => "Marriage",
            'created_at' => now(),
            'updated_at' => now()
        ]);
        Category::create([
            'name' => "Religion",
            'created_at' => now(),
            'updated_at' => now()
        ]);
        Category::create([
            'name' => "Competition",
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
