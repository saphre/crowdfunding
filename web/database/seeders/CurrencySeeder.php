<?php

namespace Database\Seeders;

use App\Models\Currency;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Currency::create([
            'name' => "European Euro",
            "code" => "EUR",
            'symbol' => "€",
            'is_active' => false,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        Currency::create([
            'name' => "United States Dollar",
            "code" => "USD",
            'symbol' => "$",
            'is_active' => false,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        Currency::create([
            'name' => "Pound Sterling",
            "code" => "GBP",
            'symbol' => "£",
            'is_active' => false,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        Currency::create([
            'name' => "Central African CFA franc",
            "code" => "XAF",
            'symbol' => "FCFA",
            'is_active' => true,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
