<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sub_categories')->insert([
            ['category_id' => 1, 'subCategory_name' => 'Shirts', 'created_at' => now(), 'updated_at' => now()],
            ['category_id' => 1, 'subCategory_name' => 'Pants', 'created_at' => now(), 'updated_at' => now()],
            ['category_id' => 2, 'subCategory_name' => 'Dresses', 'created_at' => now(), 'updated_at' => now()],
            ['category_id' => 2, 'subCategory_name' => 'Skirts', 'created_at' => now(), 'updated_at' => now()],
            ['category_id' => 3, 'subCategory_name' => 'T-Shirts', 'created_at' => now(), 'updated_at' => now()],
            ['category_id' => 4, 'subCategory_name' => 'Bags', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
