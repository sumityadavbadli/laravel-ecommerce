<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChildOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('child_orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('custId');
            $table->string('orderId');
            $table->string('productId');
            $table->string('productName');
            $table->string('productSummary');
            $table->integer('productQuantity');
            $table->float('productPrice');
            $table->string('productImage');
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
        Schema::dropIfExists('child_orders');
    }
}
