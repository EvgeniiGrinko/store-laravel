<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class OrderSku extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_sku', function (Blueprint $table) {
            $table->id();
            $table->integer('order_id');
            $table->integer('sku_id');
            $table->double('price');
            $table->integer('count')->default(1);
            $table->timestamps();
        });
        Schema::dropIfExists('order_product');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('order_product', function (Blueprint $table) {
        $table->id();
        $table->integer('order_id');
        $table->integer('product_id');
        $table->double('price');
        $table->integer('count')->default(1);
        $table->timestamps();
    });
        Schema::dropIfExists('order_sku');
    }
}
