<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VoucherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('voucher')->insert([
            'voucher_code' => 'CODE01',
            'description' => 'chào mừng 20/11',
            'discount_amount' => 100,
            'start_date' => today(),
            'end_date' => today(),
            'minimum_order' => 100000, 
            'usage_limit' => 1000, 
            'status' => 0, 
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('voucher')->insert([
            'voucher_code' => 'CODE02',
            'description' => 'chào mừng 20/11',
            'discount_amount' => 100,
            'start_date' => today(),
            'end_date' => today(),
            'minimum_order' => 100000, 
            'usage_limit' => 1000, 
            'status' => 0, 
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('voucher')->insert([
            'voucher_code' => 'CODE03',
            'description' => 'chào mừng 20/11',
            'discount_amount' => 100,
            'start_date' => today(),
            'end_date' => today(),
            'minimum_order' => 100000, 
            'usage_limit' => 1000, 
            'status' => 0, 
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('voucher')->insert([
            'voucher_code' => 'CODE04',
            'description' => 'chào mừng 20/11',
            'discount_amount' => 100,
            'start_date' => today(),
            'end_date' => today(),
            'minimum_order' => 100000, 
            'usage_limit' => 1000, 
            'status' => 0, 
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('voucher')->insert([
            'voucher_code' => 'CODE05',
            'description' => 'chào mừng 20/11',
            'discount_amount' => 100,
            'start_date' => today(),
            'end_date' => today(),
            'minimum_order' => 100000, 
            'usage_limit' => 1000, 
            'status' => 0, 
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('voucher')->insert([
            'voucher_code' => 'CODE06',
            'description' => 'chào mừng 20/11',
            'discount_amount' => 100,
            'start_date' => today(),
            'end_date' => today(),
            'minimum_order' => 100000, 
            'usage_limit' => 1000, 
            'status' => 0, 
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('voucher')->insert([
            'voucher_code' => 'CODE07',
            'description' => 'chào mừng 20/11',
            'discount_amount' => 100,
            'start_date' => today(),
            'end_date' => today(),
            'minimum_order' => 100000, 
            'usage_limit' => 1000, 
            'status' => 0, 
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('voucher')->insert([
            'voucher_code' => 'CODE08',
            'description' => 'chào mừng 20/11',
            'discount_amount' => 100,
            'start_date' => today(),
            'end_date' => today(),
            'minimum_order' => 100000, 
            'usage_limit' => 1000, 
            'status' => 0, 
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('voucher')->insert([
            'voucher_code' => 'CODE09',
            'description' => 'chào mừng 20/11',
            'discount_amount' => 100,
            'start_date' => today(),
            'end_date' => today(),
            'minimum_order' => 100000, 
            'usage_limit' => 1000, 
            'status' => 0, 
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('voucher')->insert([
            'voucher_code' => 'CODE10',
            'description' => 'chào mừng 20/11',
            'discount_amount' => 100,
            'start_date' => today(),
            'end_date' => today(),
            'minimum_order' => 100000, 
            'usage_limit' => 1000, 
            'status' => 0, 
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('voucher')->insert([
            'voucher_code' => 'CODE11',
            'description' => 'chào mừng 20/11',
            'discount_amount' => 100,
            'start_date' => today(),
            'end_date' => today(),
            'minimum_order' => 100000, 
            'usage_limit' => 1000, 
            'status' => 0, 
            'created_at' => now(),
            'updated_at' => now(),
        ]);
       
    }
}
