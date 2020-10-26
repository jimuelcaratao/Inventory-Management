<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id('order_item_id');
            $table->string('transaction_no', 20);
            $table->string('barcode', 20);
            $table->string('quantity', 100);
            $table->string('price', 100);
            $table->string('discount', 100);
            $table->timestamps();

            $table->foreign('barcode')->references('barcode')->on('products');
            $table->foreign('transaction_no')->references('transaction_no')->on('orders');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_items');
    }
}
