<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::create([
            'name' => 'Brevis',
            'password' => Hash::make('admin123'),
            'email' => 'brevisnguyen@example.com',
        ]);

        \App\Models\Category::create(['name' => 'Khác', 'slug' => 'danh-muc-khac']);

        \App\Models\Unit::create(['name' => 'Viên']);
    }
}
