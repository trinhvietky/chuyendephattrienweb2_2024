<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id('orderitem_id'); // Khóa chính, tự động tăng
            $table->unsignedBigInteger('order_id'); // Khóa ngoại tới bảng orders
            $table->unsignedBigInteger('product_id'); // Khóa ngoại tới bảng products
            $table->integer('quantity'); // Số lượng sản phẩm
            $table->unsignedBigInteger('size_id'); // Khóa ngoại tới bảng sizes
            $table->unsignedBigInteger('color_id'); // Khóa ngoại tới bảng colors
            $table->double('price', 15, 2); // Giá sản phẩm tại thời điểm đặt hàng
            $table->timestamps(); // created_at, updated_at

            // Khóa ngoại
            $table->foreign('order_id')->references('order_id')->on('orders')->onDelete('cascade');
            $table->foreign('product_id')->references('product_id')->on('products')->onDelete('cascade');
            $table->foreign('size_id')->references('size_id')->on('sizes')->onDelete('restrict');
            $table->foreign('color_id')->references('color_id')->on('colors')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_items');
    }
};
