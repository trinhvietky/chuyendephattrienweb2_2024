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
                'product_name' => 'Men\'s Casual Shirt',
                'description' => 'Stylish and comfortable casual shirt for men.',
                'price' => 29.99,
                'subCategory_id' => 1, // Shirts
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'product_name' => 'Men\'s Slim Fit Pants',
                'description' => 'Perfect slim fit pants for a modern look.',
                'price' => 49.99,
                'subCategory_id' => 2, // Pants
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'product_name' => 'Women\'s Elegant Dress',
                'description' => 'An elegant dress for special occasions.',
                'price' => 59.99,
                'subCategory_id' => 3, // Dresses
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'product_name' => 'Women\'s Casual Top',
                'description' => 'Comfortable and stylish top for women.',
                'price' => 39.99,
                'subCategory_id' => 4, // Tops
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'product_name' => 'Men\'s Sports Jacket',
                'description' => 'A sporty jacket for men for outdoor activities.',
                'price' => 79.99,
                'subCategory_id' => 5, // Jackets
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'product_name' => 'Women\'s Skirt',
                'description' => 'Stylish skirt for every occasion.',
                'price' => 49.99,
                'subCategory_id' => 6, // Skirts
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'product_name' => 'Men\'s Leather Boots',
                'description' => 'Durable leather boots for men.',
                'price' => 99.99,
                'subCategory_id' => 1, // Footwear
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'product_name' => 'Women\'s Heeled Sandals',
                'description' => 'Stylish heeled sandals for women.',
                'price' => 59.99,
                'subCategory_id' => 2, // Footwear
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'product_name' => 'Men\'s Running Shoes',
                'description' => 'Lightweight and comfortable shoes for running.',
                'price' => 89.99,
                'subCategory_id' => 3, // Footwear
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'product_name' => 'Women\'s Handbag',
                'description' => 'Elegant handbag for women.',
                'price' => 79.99,
                'subCategory_id' => 4, // Bags
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
