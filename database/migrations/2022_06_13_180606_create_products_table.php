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
            $table->id()->index();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->unsignedBigInteger('sub_category_id')->nullable();
            $table->string('name')->unique();
            $table->string('arabic_name')->unique();
            $table->string('sku')->unique();
            $table->float('selling_price');
            $table->float('discount_price')->nullable();
            $table->float('price');
            $table->longText('description')->nullable();
            $table->longText('arabic_description')->nullable();
            $table->boolean('status')->default(0);
            $table->Integer('offer')->nullable();
            $table->string('image');
            $table->string('wash_care')->nullable();
            $table->string('contents')->nullable();
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
