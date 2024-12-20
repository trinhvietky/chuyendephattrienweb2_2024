<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ColorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('colors')->insert([
            ['color_name' => 'Black', 'created_at' => now(), 'updated_at' => now()],
            ['color_name' => 'White', 'created_at' => now(), 'updated_at' => now()],
            ['color_name' => 'Red', 'created_at' => now(), 'updated_at' => now()],
            ['color_name' => 'Blue', 'created_at' => now(), 'updated_at' => now()],
            ['color_name' => 'Green', 'created_at' => now(), 'updated_at' => now()],
            ['color_name' => 'Olive', 'created_at' => now(), 'updated_at' => now()],
            ['color_name' => 'Silver', 'created_at' => now(), 'updated_at' => now()],
            ['color_name' => 'Brown', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
