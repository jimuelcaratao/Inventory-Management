<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Products', function (Blueprint $table) {
            $table->string('barcode', 20)->primary();
            $table->string('sku', 30)->unique();
            $table->string('product_name', 50);
            $table->string('description', 100)->nullable();
            $table->string('category', 100);
            $table->string('brand', 100);
            $table->string('stock', 100);
            $table->string('price', 100);
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
        Schema::dropIfExists('Products');
    }
}
