<?php

namespace Database\Seeders;

use App\Models\Blog;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(DanhmucSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(ColorsTableSeeder::class);
        $this->call(SizesTableSeeder::class);
        $this->call(SubCategoriesTableSeeder::class);
        $this->call(ProductsTableSeeder::class);
        // $this->call(AddressSeeder::class);
        $this->call(ProductVariantsTableSeeder::class);
        $this->call(ProductImagesSeeder::class);
        $this->call(CartSeeder::class);
        $this->call(BlogSeeder::class);
    }
}
