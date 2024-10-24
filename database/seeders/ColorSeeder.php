<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('colors')->insert([
            [
                'color_name' => 'Black',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'color_name' => 'Blue',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'color_name' => 'Green',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
