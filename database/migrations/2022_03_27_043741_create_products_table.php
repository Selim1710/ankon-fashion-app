<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('old_price');
            $table->integer('new_price');
            $table->string('size');
            $table->string('image');
            $table->integer('offer');
            $table->string('description');

          

            $table->unsignedBigInteger('subCategory_id')->default();
            $table->foreign('subCategory_id')
                ->references('id')
                ->on('subcategories')
                ->onDelete('cascade');

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
        Schema::dropIfExists('products');
    }
}
