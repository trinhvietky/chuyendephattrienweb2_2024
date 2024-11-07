<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'user1',
            'email' => 'user1@gmail.com',
            'phone' => '0123456789',
            'password' => '0123456',
            'usertype' => 'user',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('users')->insert([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'phone' => '0987654321',
            'password' => bcrypt('adminpassword'), // Mã hóa mật khẩu cho admin
            'usertype' => 'admin', // Đặt role thành admin
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
