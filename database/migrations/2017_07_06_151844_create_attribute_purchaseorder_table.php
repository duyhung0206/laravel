<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttributePurchaseorderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attribute_purchaseorder', function (Blueprint $table) {
            $table->increments('attribute_purchaseorder_id');
            $table->integer('purchaseorder_id')->unsigned();
            $table->integer('type');
            $table->string('label');
            $table->string('value');

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
        Schema::dropIfExists('attribute_purchaseorder');
    }
}
