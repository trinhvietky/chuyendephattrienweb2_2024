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
            ['size_name' => 'Small', 'created_at' => now(), 'updated_at' => now()],
            ['size_name' => 'Medium', 'created_at' => now(), 'updated_at' => now()],
            ['size_name' => 'Large', 'created_at' => now(), 'updated_at' => now()],
            ['size_name' => 'X-Large', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
