<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use App\Models\Post;
use App\Models\Product;
use App\Models\Unit;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = User::create([
            'name' => 'Brevis',
            'email' => 'brevisnguyen@gmail.com',
            'password' => 'admin',
            'role' => 'admin'
        ]);

        Post::factory()->count(10)->for($user)->create();

        Product::factory()
            ->has(Category::factory()->count(2))
            ->hasAttached(
                Unit::factory()->count(3),
                ['amount' => 200, 'default' => false]
            )
            ->count(10)
            ->create();
    }
}
