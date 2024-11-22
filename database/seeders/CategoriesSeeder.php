<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('categories')->insert([
            ['category_name' => 'Áo',
            'created_at' => now(),
            'updated_at' => now()],

            ['category_name' => 'Quần',
            'created_at' => now(),
            'updated_at' => now()],

            ['category_name' => 'Giày',
            'created_at' => now(),
            'updated_at' => now()],

            ['category_name' => 'Phụ kiện',
            'created_at' => now(),
            'updated_at' => now()],

            ['category_name' => 'Mũ',
            'created_at' => now(),
            'updated_at' => now()],
        ]);
    }
}
