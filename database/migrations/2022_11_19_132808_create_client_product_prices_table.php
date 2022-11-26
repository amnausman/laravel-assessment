<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientProductPricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_product_prices', function (Blueprint $table) {
            $table->id();

            $table->index('client_id');
            $table->unsignedBigInteger('client_id')->comment = 'Id of client';
            $table->foreign('client_id')
            ->references('id')
            ->on('users')
            ->onDelete('cascade');

            $table->index('product_id');
            $table->unsignedBigInteger('product_id')->comment = 'Id of product';
            $table->foreign('product_id')
            ->references('id')
            ->on('products')
            ->onDelete('cascade');

            $table->float('price')->comment = 'Special price of Product for specific user'; //Special price for product
            $table->softDeletes();
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
        Schema::dropIfExists('client_product_prices');
    }
}
