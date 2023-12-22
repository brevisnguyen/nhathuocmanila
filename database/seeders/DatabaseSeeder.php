<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use App\Models\Medication;
use App\Models\Post;
use App\Models\Unit;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Brevis',
            'password' => Hash::make('admin123'),
            'email' => 'brevisnguyen@example.com',
        ]);

        Medication::factory()
            ->has(Category::factory()->count(3))
            ->for(Unit::factory())
            ->count(10)
            ->create();
        Post::factory()
            ->count(20)
            ->create();
    }
}
