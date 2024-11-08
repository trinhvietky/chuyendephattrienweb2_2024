<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderItemsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('order_items')->insert([
            [
                'order_id' => 1,
                'product_id' => 1,
                'quantity' => 2,
                'size_id' => 1,
                'color_id' => 2,
                'price' => 500.75,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'order_id' => 1,
                'product_id' => 2,
                'quantity' => 1,
                'size_id' => 1,
                'color_id' => 2,
                'price' => 300.50,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
