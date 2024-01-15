<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => "John Doe",
            "email" => "admin@crowdfunding.com",
            "password" => Hash::make("Admin@4202"),
            'created_at' => now(),
            'updated_at' => now()
        ]);
        User::create([
            'name' => "Jane Doe",
            "email" => "jane@crowdfunding.com",
            "password" => Hash::make("Admin@4202"),
            'created_at' => now(),
            'updated_at' => now()
        ]);
        User::create([
            'name' => "Jannette Doe",
            "email" => "jannette@crowdfunding.com",
            "password" => Hash::make("Admin@4202"),
            'created_at' => now(),
            'updated_at' => now()
        ]);
        User::create([
            'name' => "Sam Doe",
            "email" => "sam@crowdfunding.com",
            "password" => Hash::make("Admin@4202"),
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
