<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttributeOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attribute_order', function (Blueprint $table) {
            $table->increments('attribute_order_id');
            $table->integer('order_id')->unsigned();
            $table->integer('type');
            $table->string('label');
            $table->string('value');

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
        Schema::dropIfExists('attribute_order');
    }
}
