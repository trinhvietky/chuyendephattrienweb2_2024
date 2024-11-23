<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductVariantsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('product_variants')->insert([
            [
                'product_id' => 1,
                'color_id' => 4,
                'size_id' => 1,
                'stock' => 10,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 1,
                'color_id' => 4,
                'size_id' => 2,
                'stock' => 20,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 1,
                'color_id' => 4,
                'size_id' => 3,
                'stock' => 30,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 2,
                'color_id' => 1,
                'size_id' => 2,
                'stock' => 20,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 2,
                'color_id' => 1,
                'size_id' => 4,
                'stock' => 50,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 3,
                'color_id' => 1,
                'size_id' => 4,
                'stock' => 20,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 3,
                'color_id' => 1,
                'size_id' => 2,
                'stock' => 30,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 4,
                'color_id' => 1,
                'size_id' => 4,
                'stock' => 100,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 4,
                'color_id' => 1,
                'size_id' => 3,
                'stock' => 200,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 5,
                'color_id' => 1,
                'size_id' => 1,
                'stock' => 10,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 5,
                'color_id' => 1,
                'size_id' => 2,
                'stock' => 20,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 5,
                'color_id' => 1,
                'size_id' => 3,
                'stock' => 30,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 6,
                'color_id' => 2,
                'size_id' => 2,
                'stock' => 20,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 6,
                'color_id' => 2,
                'size_id' => 4,
                'stock' => 40,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 6,
                'color_id' => 2,
                'size_id' => 3,
                'stock' => 50,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 7,
                'color_id' => 4,
                'size_id' => 1,
                'stock' => 10,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 7,
                'color_id' => 4,
                'size_id' => 2,
                'stock' => 10,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 7,
                'color_id' => 4,
                'size_id' => 4,
                'stock' => 30,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 8,
                'color_id' => 7,
                'size_id' => 2,
                'stock' => 15,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 8,
                'color_id' => 7,
                'size_id' => 4,
                'stock' => 30,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 9,
                'color_id' => 4,
                'size_id' => 2,
                'stock' => 10,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 9,
                'color_id' => 4,
                'size_id' => 3,
                'stock' => 20,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 9,
                'color_id' => 4,
                'size_id' => 4,
                'stock' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
