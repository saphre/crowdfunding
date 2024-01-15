<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\UserDonation;

class UserDonationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UserDonation::create([
            'user_id' => 1,
            'donation_id' => 1,
            'is_initiator' => true,
            'created_at' => now()
        ]);
        UserDonation::create([
            'user_id' => 1,
            'donation_id' => 2,
            'is_initiator' => true,
            'created_at' => now()
        ]);
        UserDonation::create([
            'user_id' => 1,
            'donation_id' => 3,
            'is_initiator' => true,
            'created_at' => now()
        ]);
        UserDonation::create([
            'user_id' => 1,
            'donation_id' => 4,
            'is_initiator' => true,
            'created_at' => now()
        ]);
    }
}
