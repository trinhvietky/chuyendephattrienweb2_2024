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
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'phone' => '0987654321',
            'password' => bcrypt('adminpassword'), // Mã hóa mật khẩu cho admin
            'usertype' => '1', // Đặt role thành admin
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('users')->insert([
            'name' => 'Admin User',
            'email' => 'user@example.com',
            'phone' => '0987654321',
            'password' => bcrypt('123456'), // Mã hóa mật khẩu cho admin
            'usertype' => '0', // Đặt role thành admin
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('users')->insert([
            'name' => 'User',
            'email' => '22211tt0960@mail.tdc.edu.vn',
            'phone' => '0987654321',
            'password' => bcrypt('12345678'), // Mã hóa mật khẩu cho admin
            'usertype' => '0',
            'image' => 'images/icons/avatar_user.png',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
