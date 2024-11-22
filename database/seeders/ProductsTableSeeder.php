<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('products')->insert([
            [
                'product_name' => 'Áo sweater tay dài',
                'description' => 'Áo sweater tay dài phù hợp cho mùa đông, giữ ấm tốt',
                'price' => 100000,
                'category_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_name' => 'Áo sweater tay dài',
                'description' => 'Áo sweater tay dài chất liệu cao cấp của Ruyich',
                'price' => 300000,
                'category_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_name' => 'Áo khoác',
                'description' => 'Áo khoác dáng dài, phù hợp cho mùa thu đông',
                'price' => 250000,
                'category_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_name' => 'Áo sweater len',
                'description' => 'Áo sweater len mềm mại và thoải mái',
                'price' => 350000,
                'category_id' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_name' => 'Áo sweater len',
                'description' => 'Áo len chất lượng cao, giữ ấm cơ thể',
                'price' => 300000,
                'category_id' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_name' => 'Áo khoác len',
                'description' => 'Áo khoác len ấm áp, thời trang',
                'price' => 200000,
                'category_id' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_name' => 'Áo sweater tay dài phối màu',
                'description' => 'Áo sweater tay dài phối màu, thời trang và ấm áp',
                'price' => 300000,
                'category_id' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_name' => 'Áo sweater tay dài phối màu',
                'description' => 'Áo sweater tay dài phối màu, đẹp và ấm áp',
                'price' => 360000,
                'category_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_name' => 'Áo sweater in USA',
                'description' => 'Áo sweater in hình quốc kỳ USA, phù hợp cho mùa đông',
                'price' => 150000,
                'category_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
