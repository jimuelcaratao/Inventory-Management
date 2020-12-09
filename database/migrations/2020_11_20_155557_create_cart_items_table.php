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
            $table->string('cart_id', 20);
            $table->string('barcode', 20);
            $table->string('quantity', 100);
            $table->string('price', 100);
            $table->timestamps();

            $table->foreign('barcode')->references('barcode')->on('products');
            $table->foreign('cart_id')->references('cart_id')->on('carts');
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
