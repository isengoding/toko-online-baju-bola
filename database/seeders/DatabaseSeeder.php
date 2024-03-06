<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Team;
use App\Models\User;
use App\Models\Brand;
use App\Models\Stock;
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

        // Product::factory()->create();

        // User::factory(5)->create();

        User::factory()->create([
            'name' => 'Jenniya',
            'role' => 'admin',
            'email' => 'admin@admin.com',
        ]);

        User::factory()->create([
            'name' => 'Grande',
            'role' => 'user',
            'email' => 'grande@gg.com',
        ]);

        $brand = Brand::factory()->create([
            'name' => 'Adidas',
            'image' => 'adidas-1991-2022-logo.png',
        ]);

        $team = Team::factory()->create([
            'name' => 'Ac Milan',
            'image' => 'acmilan.png',
        ]);

        Stock::factory()
            ->for(Product::factory()->state([
                'name' => 'Ac milan season 2022-2023',
                'brand_id' => $brand->id,
                'team_id' => $team->id,
                'image' => 'acmilan2-removebg.png',
            ]))
            ->create([
                'size' => 'S',
                'size_stock' => 10,
            ]);

    }
}
