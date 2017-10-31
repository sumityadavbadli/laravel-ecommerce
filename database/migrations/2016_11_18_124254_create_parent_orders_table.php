<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParentOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parent_orders', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('orderId');
            $table->string('custId');
            $table->integer('noOfUnits');
            $table->float('amount');
            $table->boolean('orderStatus')->default(0);
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
        Schema::dropIfExists('parent_orders');
    }
}
