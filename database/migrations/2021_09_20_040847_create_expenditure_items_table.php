<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpenditureItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expenditure_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('measure_id');
            $table->unsignedBigInteger('product_id');
            $table->integer('price');
            $table->integer('quantity');
            $table->timestamps();

            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('measure_id')->references('id')->on('measures');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('expenditure_items', function (Blueprint $table) {
            $table->dropForeign(['product_id']);
            $table->dropForeign(['measure_id']);
        });

        Schema::dropIfExists('expenditure_items');
    }
}
