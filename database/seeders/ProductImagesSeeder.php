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
                'product_id' => 1, // Women’s Elegant Dress
                'color_id' => 4, // Blue
                'image_path' => 'img/product/product-02.jpg',
                'alt_text' => 'Women’s Elegant Dress in Blue',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 1, // Women’s Elegant Dress
                'color_id' => 5, // Green
                'image_path' => 'img/product/product-03.jpg',
                'alt_text' => 'Women’s Elegant Dress in Green',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 2, // Women’s Casual Top
                'color_id' => 6, // Olive
                'image_path' => 'img/product/product-04.jpg',
                'alt_text' => 'Women’s Casual Top in Olive',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 2, // Women’s Casual Top
                'color_id' => 7, // Silver
                'image_path' => 'img/product/product-05.jpg',
                'alt_text' => 'Women’s Casual Top in Silver',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 3, // Men’s Sports Jacket
                'color_id' => 1, // Black
                'image_path' => 'img/product/product-06.jpg',
                'alt_text' => 'Men’s Sports Jacket in Black',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 3, // Men’s Sports Jacket
                'color_id' => 8, // Brown
                'image_path' => 'img/product/product-07.jpg',
                'alt_text' => 'Men’s Sports Jacket in Brown',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 4, // Women’s Skirt
                'color_id' => 2, // Yellow
                'image_path' => 'img/product/product-09.jpg',
                'alt_text' => 'Women’s Skirt in Yellow',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 4, // Women’s Skirt
                'color_id' => 1, // Gray
                'image_path' => 'img/product/product-08.jpg',
                'alt_text' => 'Women’s Skirt in Gray',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 5, // Men’s Leather Boots
                'color_id' => 1, // Black
                'image_path' => 'img/product/product-10.jpg',
                'alt_text' => 'Men’s Leather Boots in Black',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 5, // Men’s Leather Boots
                'color_id' => 2, // White
                'image_path' => 'img/product/product-11.jpg',
                'alt_text' => 'Men’s Leather Boots in White',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 6, // Women’s Heeled Sandals
                'color_id' => 3, // Red
                'image_path' => 'img/product/product-12.jpg',
                'alt_text' => 'Women’s Heeled Sandals in Red',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 6, // Women’s Heeled Sandals
                'color_id' => 4, // Blue
                'image_path' => 'img/product/product-13.jpg',
                'alt_text' => 'Women’s Heeled Sandals in Blue',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 7, // Men’s Running Shoes
                'color_id' => 5, // Green
                'image_path' => 'img/product/product-14.jpg',
                'alt_text' => 'Men’s Running Shoes in Green',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 7, // Men’s Running Shoes
                'color_id' => 6, // Olive
                'image_path' => 'img/product/product-15.jpg',
                'alt_text' => 'Men’s Running Shoes in Olive',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 8, // Women’s Handbag
                'color_id' => 7, // Silver
                'image_path' => 'img/product/product-16.jpg',
                'alt_text' => 'Women’s Handbag in Silver',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 8, // Women’s Handbag
                'color_id' => 8, // Brown
                'image_path' => 'img/product/product-17.jpg',
                'alt_text' => 'Women’s Handbag in Brown',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
