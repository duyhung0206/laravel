<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchaseorderProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchaseorder_product', function (Blueprint $table) {
            $table->increments('purchaseorder_product_id');
            $table->integer('purchaseorder_id')->unsigned();
            $table->integer('product_id');
            $table->integer('type');
            $table->string('name');
            $table->string('sku');
            $table->float('price', 8, 2);
            $table->float('qty', 8, 2);
            $table->float('row_total', 8, 2);

            $table->foreign('purchaseorder_id')->references('purchaseorder_id')->on('purchaseorder')->onDelete('cascade');
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
        Schema::dropIfExists('purchaseorder_product');
    }
}
