<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGuestParentOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guest_parent_orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('orderId');
            $table->string('visitorId');
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
        Schema::dropIfExists('guest_parent_orders');
    }
}
