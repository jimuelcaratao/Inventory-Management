<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Product extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Product', function (Blueprint $table) {
            $table->id('SKU');
            $table->string('Barcode', 50)->unique();
            $table->string('ProductName', 50);
            $table->string('Description', 100);
            $table->string('Brand', 100);
            $table->string('Category', 100);
            $table->string('Stock', 100);
            $table->string('Price', 100);
            // $table->softDeletes();
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
        Schema::dropIfExists('Product');
    }
}
