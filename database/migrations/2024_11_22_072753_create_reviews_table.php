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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id(); // ID tự tăng
            $table->unsignedBigInteger('product_id'); // Khóa ngoại liên kết với sản phẩm
            $table->unsignedBigInteger('user_id')->nullable(); // Khóa ngoại liên kết với người dùng (nullable nếu người dùng không đăng nhập)
            $table->tinyInteger('rating')->comment('Điểm đánh giá (1-5)'); // Rating từ 1-5
            $table->text('content')->comment('Nội dung bình luận'); // Nội dung đánh giá
            $table->timestamps(); // created_at và updated_at
    
            // Định nghĩa khóa ngoại
            $table->foreign('product_id')->references('product_id')->on('products')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null'); // Nếu user bị xóa, user_id sẽ là null
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
};
