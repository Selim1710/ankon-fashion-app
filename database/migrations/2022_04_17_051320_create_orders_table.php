<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('customer_id');
            $table->string('name')->nullable();
            $table->string('email');
            $table->string('address');
            $table->string('phone')->nullable();

            $table->string('product_id');
            $table->string('product_name');
            $table->string('image');
            $table->string('size');
            $table->string('price');
            $table->string('quantity');
            $table->string('total');
            $table->string('order_status')->default('pending');
            $table->string('payment_status')->default('Cash On Delivery');

            $table->timestamps();
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
}
