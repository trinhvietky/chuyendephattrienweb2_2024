<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('blogs')->insert([
            [
                'title' => 'Winter Collection 1',
                'content' => 'Các sản phẩm mùa đông đã có mặt trên tất cả các hệ thống và của hàng chờ các bạn mua sắm ngay thôi. Với các thiết kế basic nhưng không kém phần tinh tế, đường nét cầu kì nhưng cực kì dễ phối đò, phù hợp cho các tất cả các bạn. ',
                'cover_image' => 'img/blog-details/blog-01.jpg', // Dresses
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Winter Collection 2',
                'content' => 'Các sản phẩm mùa đông đã có mặt trên tất cả các hệ thống và của hàng chờ các bạn mua sắm ngay thôi. Với các thiết kế basic nhưng không kém phần tinh tế, đường nét cầu kì nhưng cực kì dễ phối đò, phù hợp cho các tất cả các bạn. ',
                'cover_image' => 'img/blog-details/blog-02.jpg', // Dresses
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Winter Collection 3',
                'content' => 'Các sản phẩm mùa đông đã có mặt trên tất cả các hệ thống và của hàng chờ các bạn mua sắm ngay thôi. Với các thiết kế basic nhưng không kém phần tinh tế, đường nét cầu kì nhưng cực kì dễ phối đò, phù hợp cho các tất cả các bạn. ',
                'cover_image' => 'img/blog-details/blog-03.jpg', // Dresses
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Winter Collection 4',
                'content' => 'Các sản phẩm mùa đông đã có mặt trên tất cả các hệ thống và của hàng chờ các bạn mua sắm ngay thôi. Với các thiết kế basic nhưng không kém phần tinh tế, đường nét cầu kì nhưng cực kì dễ phối đò, phù hợp cho các tất cả các bạn. ',
                'cover_image' => 'img/blog-details/blog-04.jpg', // Dresses
                'created_at' => now(),
                'updated_at' => now()
            ],
            
        ]);
    }
}
