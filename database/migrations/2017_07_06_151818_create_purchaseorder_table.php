<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchaseorderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchaseorder', function (Blueprint $table) {
            $table->increments('purchaseorder_id');
            $table->integer('supplier_id')->unsigned();
            $table->date('order_date');
            $table->string('note');
            $table->float('total_amount', 8, 2);
            $table->float('total_paid', 8, 2);
            $table->integer('status');
            $table->boolean('mark_as_paid');

            $table->foreign('supplier_id')->references('supplier_id')->on('supplier')->onDelete('cascade');

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
        Schema::dropIfExists('purchaseorder');
    }
}
