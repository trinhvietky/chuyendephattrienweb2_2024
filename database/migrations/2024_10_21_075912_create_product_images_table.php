<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_images', function (Blueprint $table) {
            $table->id('image_id'); // Khóa chính, tự động tăng
            $table->unsignedBigInteger('product_id'); // Khóa ngoại tham chiếu tới bảng products
            $table->unsignedBigInteger('color_id'); // Khóa ngoại tham chiếu tới bảng colors
            $table->string('image_path', 255)->nullable(); // Đường dẫn ảnh, có thể để trống
            $table->string('alt_text', 255)->nullable(); // Văn bản thay thế khi không có ảnh, có thể để trống
            $table->timestamps(); // created_at và updated_at

            // Khóa ngoại
            $table->foreign('product_id')->references('product_id')->on('products')->onDelete('cascade');
            $table->foreign('color_id')->references('color_id')->on('colors')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_images');
    }
}
