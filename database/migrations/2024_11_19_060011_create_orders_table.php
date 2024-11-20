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
        Schema::create('orders', function (Blueprint $table) {
            $table->id('order_id'); // Khóa chính
            $table->unsignedBigInteger('user_id'); // Khóa ngoại tới bảng users
            $table->double('total_amount', 15, 2); // Tổng tiền đơn hàng
            $table->tinyInteger('status')->default(0); // Trạng thái đơn hàng
            $table->string('voucher_code')->nullable(); // Khóa ngoại tới bảng vouchers
            $table->tinyInteger('shipping_method'); // Phương thức vận chuyển

            // Thông tin khách hàng
            $table->string('name'); // Tên khách hàng (nếu nhập khác)
            $table->string('phone'); // Số điện thoại (nếu nhập khác)
            $table->string('email'); // Email (nếu nhập khác)

            // Địa chỉ giao hàng
            $table->string('province'); // Tỉnh/Thành phố (nhập tay)
            $table->string('district'); // Quận/Huyện (nhập tay)
            $table->string('ward');
            $table->string('specific_address'); // Địa chỉ cụ thể (nhập tay)

            $table->string('note')->nullable(); // Ghi chú của khách hàng (tùy chọn)

            $table->timestamps(); // created_at, updated_at

            // Định nghĩa khóa ngoại
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('voucher_code')->references('voucher_code')->on('voucher')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
