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
                'product_id' => 1, // ID của sản phẩm Men’s Casual Shirt
                'color_id' => 1,    // ID của màu Black
                'size_id' => 1,     // ID của size Small
                'stock' => 50,      // Số lượng sản phẩm cho biến thể
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 1, // ID của sản phẩm Men’s Casual Shirt
                'color_id' => 2,    // ID của màu White
                'size_id' => 2,     // ID của size Medium
                'stock' => 30,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 2, // ID của sản phẩm Men’s Slim Fit Pants
                'color_id' => 1,    // ID của màu Black
                'size_id' => 3,     // ID của size Large
                'stock' => 20,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 3, // ID của sản phẩm Women’s Elegant Dress
                'color_id' => 3,    // ID của màu Red
                'size_id' => 2,     // ID của size Medium
                'stock' => 15,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
