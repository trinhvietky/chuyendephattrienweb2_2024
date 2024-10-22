<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductVariantsTable extends Migration
{
    public function up()
    {
        Schema::create('product_variants', function (Blueprint $table) {
            $table->id('productVariant_id');
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('color_id');
            $table->unsignedBigInteger('size_id');
            $table->integer('stock');
            $table->timestamps();
            // Định nghĩa khóa ngoại
            $table->foreign('product_id')->references('product_id')->on('products')->onDelete('cascade');
            $table->foreign('color_id')->references('color_id')->on('colors')->onDelete('cascade');
            $table->foreign('size_id')->references('size_id')->on('sizes')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('product_variants');
    }
}
