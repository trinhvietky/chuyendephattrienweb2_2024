<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SizesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sizes')->insert([
            ['size_name' => 'S', 'created_at' => now(), 'updated_at' => now()],
            ['size_name' => 'M', 'created_at' => now(), 'updated_at' => now()],
            ['size_name' => 'L', 'created_at' => now(), 'updated_at' => now()],
            ['size_name' => 'XL', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
