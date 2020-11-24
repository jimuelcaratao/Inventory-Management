<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cart_items', function (Blueprint $table) {
            $table->id('cart_item_id');
            $table->string('transaction_no', 20);
            $table->string('barcode', 20);
            $table->string('quantity', 100);
            $table->string('price', 100);
            $table->timestamps();

            $table->foreign('barcode')->references('barcode')->on('products');
            $table->foreign('transaction_no')->references('transaction_no')->on('carts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cart_items');
    }
}
