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
            ['danhmuc_Ten' => 'Ao'],
            ['danhmuc_Ten' => 'Quan'],
            ['danhmuc_Ten' => 'Giay'],
            ['danhmuc_Ten' => 'Phu kien'],
            ['danhmuc_Ten' => 'Mu'],
        ]);
    }
}
