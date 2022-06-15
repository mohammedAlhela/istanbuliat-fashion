<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSizeGuidesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('size_guides', function (Blueprint $table) {
            $table->id()->index();
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('size_id');
            $table->string('shoulder');
            $table->string('bust');
            $table->string('wist');
            $table->string('hip');
            $table->string('length');
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
        Schema::dropIfExists('size_guides');
    }
}
