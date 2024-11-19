<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        //
        Schema::create('voucher', function (Blueprint $table) {
            $table->id();
            $table->string('voucher_code')->unique();
            $table->string('description');
            $table->double('discount_amount');
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->double('minimum_order');
            $table->integer('usage_limit');
            $table->tinyInteger('status');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('voucher');
    }
};
