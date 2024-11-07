<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductImagesSeeder extends Seeder
{
    public function run()
    {
        DB::table('product_images')->insert([
            [
                'product_id' => 1, // Men's Casual Shirt
                'color_id' => 1, // Black
                'image_path' => 'images/mens_casual_shirt_black.jpg',
                'alt_text' => 'Men’s Casual Shirt in Black',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 1,
                'color_id' => 2, // White
                'image_path' => 'images/mens_casual_shirt_white.jpg',
                'alt_text' => 'Men’s Casual Shirt in White',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 2, // Men's Slim Fit Pants
                'color_id' => 1, // Black
                'image_path' => 'images/mens_slim_fit_pants_black.jpg',
                'alt_text' => 'Men’s Slim Fit Pants in Black',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 3, // Women's Elegant Dress
                'color_id' => 3, // Red
                'image_path' => 'images/womens_elegant_dress_red.jpg',
                'alt_text' => 'Women’s Elegant Dress in Red',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
