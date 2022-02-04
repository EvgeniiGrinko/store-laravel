<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSkuPropertyOptionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sku_property_option', function (Blueprint $table) {
            $table->id('id');
            $table->timestamps();
            $table->unsignedInteger('property_option_id');
            $table->unsignedInteger('sku_id');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sku_product');
    }
}
