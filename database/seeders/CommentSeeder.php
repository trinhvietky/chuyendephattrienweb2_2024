<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('comments')->insert([
            [
                'product_id' => 1, // Women’s Elegant Dress
                'user_id' => 1, // User ID
                'content' => 'This dress is absolutely gorgeous!',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 1, // Women’s Elegant Dress
                'user_id' => 2, // User ID
                'content' => 'Fits perfectly and the material is great!',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'product_id' => 2, // Another product
                'user_id' => 3, // User ID
                'content' => 'Amazing quality for the price!',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
