<?php

namespace Database\Seeders;

use App\Models\Donation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DonationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Donation::create([
            'category_id' => 1,
            'currency_id' => 4,
            'title' => "Help John Doe Return Home",
            'description' => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus nisi justo, rutrum a velit eget, lobortis faucibus est. Donec sit amet eros elit. Suspendisse sit amet suscipit ante, quis laoreet tortor. Sed dictum vulputate enim non volutpat. Aliquam mollis neque id aliquet dignissim. Donec malesuada a nibh vel mollis. Nulla ultrices nulla turpis, quis tempor nibh hendrerit scelerisque. Fusce nulla augue, blandit in volutpat eget, posuere nec lorem. Suspendisse nec malesuada augue, id fermentum purus. Morbi gravida leo ac risus lobortis consequat ut eu orci. Donec scelerisque eleifend purus sed convallis. Vestibulum mattis arcu a urna auctor auctor. Pellentesque a ligula enim. Nam magna quam, suscipit ut fermentum ut, feugiat ac mi.",
            'donation_img' => "https://images.unsplash.com/photo-1464037866556-6812c9d1c72e?q=80&w=1770&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D",
            'type' => "self",
            'target_amount' => "10000000",
            'contributed_amount' => "0",
            'is_complete' => false,
            'created_at' => now()
        ]);
        Donation::create([
            'category_id' => 2,
            'currency_id' => 4,
            'title' => "Curabitur tellus massa, maximus at metus id, luctus porttitor justo",
            'description' => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus nisi justo, rutrum a velit eget, lobortis faucibus est. Donec sit amet eros elit. Suspendisse sit amet suscipit ante, quis laoreet tortor. Sed dictum vulputate enim non volutpat. Aliquam mollis neque id aliquet dignissim. Donec malesuada a nibh vel mollis. Nulla ultrices nulla turpis, quis tempor nibh hendrerit scelerisque. Fusce nulla augue, blandit in volutpat eget, posuere nec lorem. Suspendisse nec malesuada augue, id fermentum purus. Morbi gravida leo ac risus lobortis consequat ut eu orci. Donec scelerisque eleifend purus sed convallis. Vestibulum mattis arcu a urna auctor auctor. Pellentesque a ligula enim. Nam magna quam, suscipit ut fermentum ut, feugiat ac mi.",
            'donation_img' => "https://images.unsplash.com/photo-1464037866556-6812c9d1c72e?q=80&w=1770&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D",
            'type' => "self",
            'target_amount' => "10000000",
            'contributed_amount' => "0",
            'is_complete' => false,
            'created_at' => now()
        ]);
        Donation::create([
            'category_id' => 3,
            'currency_id' => 4,
            'title' => "Class aptent taciti sociosqu ad litora torquent per conubia",
            'description' => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus nisi justo, rutrum a velit eget, lobortis faucibus est. Donec sit amet eros elit. Suspendisse sit amet suscipit ante, quis laoreet tortor. Sed dictum vulputate enim non volutpat. Aliquam mollis neque id aliquet dignissim. Donec malesuada a nibh vel mollis. Nulla ultrices nulla turpis, quis tempor nibh hendrerit scelerisque. Fusce nulla augue, blandit in volutpat eget, posuere nec lorem. Suspendisse nec malesuada augue, id fermentum purus. Morbi gravida leo ac risus lobortis consequat ut eu orci. Donec scelerisque eleifend purus sed convallis. Vestibulum mattis arcu a urna auctor auctor. Pellentesque a ligula enim. Nam magna quam, suscipit ut fermentum ut, feugiat ac mi.",
            'donation_img' => "https://images.unsplash.com/photo-1464037866556-6812c9d1c72e?q=80&w=1770&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D",
            'type' => "self",
            'target_amount' => "10000000",
            'contributed_amount' => "0",
            'is_complete' => false,
            'created_at' => now()
        ]);
        Donation::create([
            'category_id' => 4,
            'currency_id' => 4,
            'title' => "Integer ornare dui in leo sollicitudin maximus a a arcu",
            'description' => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus nisi justo, rutrum a velit eget, lobortis faucibus est. Donec sit amet eros elit. Suspendisse sit amet suscipit ante, quis laoreet tortor. Sed dictum vulputate enim non volutpat. Aliquam mollis neque id aliquet dignissim. Donec malesuada a nibh vel mollis. Nulla ultrices nulla turpis, quis tempor nibh hendrerit scelerisque. Fusce nulla augue, blandit in volutpat eget, posuere nec lorem. Suspendisse nec malesuada augue, id fermentum purus. Morbi gravida leo ac risus lobortis consequat ut eu orci. Donec scelerisque eleifend purus sed convallis. Vestibulum mattis arcu a urna auctor auctor. Pellentesque a ligula enim. Nam magna quam, suscipit ut fermentum ut, feugiat ac mi.",
            'donation_img' => "https://images.unsplash.com/photo-1464037866556-6812c9d1c72e?q=80&w=1770&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D",
            'type' => "self",
            'target_amount' => "10000000",
            'contributed_amount' => "0",
            'is_complete' => false,
            'created_at' => now()
        ]);
    }
}
