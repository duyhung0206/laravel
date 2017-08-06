<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_product', function (Blueprint $table) {
            $table->increments('order_product_id');
            $table->integer('order_id')->unsigned();
            $table->integer('product_id');
            $table->integer('type');
            $table->string('name');
            $table->string('sku');
            $table->float('price', 8, 2);
            $table->float('qty', 8, 2);
            $table->float('row_total', 8, 2);

            $table->foreign('order_id')->references('order_id')->on('order')->onDelete('cascade');

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
        Schema::dropIfExists('order_product');
    }
}
