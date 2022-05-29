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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id');
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->string('sku')->unique();
            $table->float('selling_price');
            $table->float('discount_price')->nullable();
            $table->mediumText('short_description');
            $table->longText('long_description');
            $table->boolean('featured')->default(0);
            $table->boolean('trend')->default(0);
            $table->boolean('status')->default(0);
            $table->string('image');
            $table->integer('stock_qty')->default(0);
            $table->integer('stock_ordered')->default(0);

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
        Schema::dropIfExists('products');
    }
}
