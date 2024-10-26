<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id('product_id');  // Khóa chính cho bảng products
            $table->string('product_name', 255);
            $table->text('description');
            $table->double('price');
            $table->unsignedBigInteger('subCategory_id');  // Khóa ngoại tới bảng sub_categories

            // Định nghĩa khóa ngoại
            $table->foreign('subCategory_id')->references('subCategory_id')->on('sub_categories')->onDelete('cascade');

            $table->timestamps();
        });
    }



    public function down()
    {
        Schema::dropIfExists('products');
    }
}
