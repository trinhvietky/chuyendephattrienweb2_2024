<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            [
                'product_name' => 'Women\'s Elegant Dress',
                'description' => 'An elegant dress for special occasions.',
                'price' => 100000,
                'category_id' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'product_name' => 'Women\'s Casual Top',
                'description' => 'Comfortable and stylish top for women.',
                'price' => 150000,
                'category_id' => 4,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'product_name' => 'Men\'s Sports Jacket',
                'description' => 'A sporty jacket for men for outdoor activities.',
                'price' => 200000,
                'category_id' => 5,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'product_name' => 'Women\'s Skirt',
                'description' => 'Stylish skirt for every occasion.',
                'price' => 180000,
                'category_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'product_name' => 'Men\'s Leather Boots',
                'description' => 'Durable leather boots for men.',
                'price' => 120000,
                'category_id' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'product_name' => 'Women\'s Heeled Sandals',
                'description' => 'Stylish heeled sandals for women.',
                'price' => 210000,
                'category_id' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'product_name' => 'Men\'s Running Shoes',
                'description' => 'Lightweight and comfortable shoes for running.',
                'price' => 300000,
                'category_id' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'product_name' => 'Women\'s Handbag',
                'description' => 'Elegant handbag for women.',
                'price' => 280000,
                'category_id' => 4,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
