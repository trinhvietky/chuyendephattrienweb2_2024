<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrdersTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('orders')->insert([
            [
                'user_id' => 1,
                'order_date' => now(),
                'total_amount' => 1500.50,
                'status' => 0,
                'voucher_code' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
