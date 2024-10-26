<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            ['category_name' => 'Men', 'created_at' => now(), 'updated_at' => now()],
            ['category_name' => 'Women', 'created_at' => now(), 'updated_at' => now()],
            ['category_name' => 'Kids', 'created_at' => now(), 'updated_at' => now()],
            ['category_name' => 'Accessories', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
