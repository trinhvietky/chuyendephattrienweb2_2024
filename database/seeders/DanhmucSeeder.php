<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DanhmucSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('danhmuc')->insert([
            ['danhmuc_Ten' => 'Áo'],
            ['danhmuc_Ten' => 'Quần'],
            ['danhmuc_Ten' => 'Giày'],
            ['danhmuc_Ten' => 'Phụ kiện'],
            ['danhmuc_Ten' => 'Mũ'],
        ]);
    }
}
