<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\Product::factory(10)->create();

        Product::factory()->create();

        User::factory(5)->create();

        User::factory()->create([
            'name' => 'Jenniya',
            'role' => 'admin',
            'email' => 'admin@admin.com',
        ]);
    }
}
