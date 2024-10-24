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
                'product_name' => 'Women\'s Summer Skirt',
                'description' => 'A breezy skirt for the summer.',
                'price' => 39.99,
                'subCategory_id' => 4, // Skirts
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
