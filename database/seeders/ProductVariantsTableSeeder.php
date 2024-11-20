<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductVariantsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('product_variants')->insert([
            [
                'product_id' => 1, // Women’s Elegant Dress
                'color_id' => 4, // Blue
                'size_id' => 2, // Medium
                'stock' => 15,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 1, // Women’s Elegant Dress
                'color_id' => 5, // Green
                'size_id' => 3, // Large
                'stock' => 18,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 2, // Women’s Casual Top
                'color_id' => 6, // Olive
                'size_id' => 1, // Small
                'stock' => 40,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 2, // Women’s Casual Top
                'color_id' => 7, // Silver
                'size_id' => 2, // Medium
                'stock' => 30,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 3, // Men’s Sports Jacket
                'color_id' => 1, // Black
                'size_id' => 2, // Medium
                'stock' => 22,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 3, // Men’s Sports Jacket
                'color_id' => 8, // Brown
                'size_id' => 3, // Large
                'stock' => 28,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 4, // Women’s Skirt
                'color_id' => 2, // Yellow
                'size_id' => 2, // Medium
                'stock' => 35,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 4, // Women’s Skirt
                'color_id' => 1, // Gray
                'size_id' => 1, // Small
                'stock' => 25,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 5, // Men’s Leather Boots
                'color_id' => 1, // Black
                'size_id' => 3, // Large
                'stock' => 40,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 5, // Men’s Leather Boots
                'color_id' => 2, // White
                'size_id' => 2, // Medium
                'stock' => 30,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 6, // Women’s Heeled Sandals
                'color_id' => 3, // Red
                'size_id' => 1, // Small
                'stock' => 50,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 6, // Women’s Heeled Sandals
                'color_id' => 4, // Blue
                'size_id' => 2, // Medium
                'stock' => 40,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 7, // Men’s Running Shoes
                'color_id' => 5, // Green
                'size_id' => 3, // Large
                'stock' => 45,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 7, // Men’s Running Shoes
                'color_id' => 6, // Olive
                'size_id' => 2, // Medium
                'stock' => 38,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 8, // Women’s Handbag
                'color_id' => 7, // Silver
                'size_id' => 1, // Small
                'stock' => 60,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 8, // Women’s Handbag
                'color_id' => 8, // Brown
                'size_id' => 2, // Medium
                'stock' => 50,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
