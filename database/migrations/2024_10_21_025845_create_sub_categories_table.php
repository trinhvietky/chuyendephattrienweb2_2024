<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubCategoriesTable extends Migration
{
    public function up()
    {
        Schema::create('sub_categories', function (Blueprint $table) {
            $table->id('subCategory_id');  // Khóa chính cho bảng sub_categories
            $table->unsignedBigInteger('category_id');  // Khóa ngoại tới bảng categories
            $table->string('subCategory_name', 255)->unique();  // Tên sub_category duy nhất
            $table->timestamps();

            // Thiết lập khóa ngoại, tham chiếu tới bảng categories
            // $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }


    public function down()
    {
        Schema::dropIfExists('sub_categories');
    }
}
