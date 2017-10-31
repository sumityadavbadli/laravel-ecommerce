<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateManageProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manage_products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('productId')->unique();
            $table->integer('parentCategory');
            $table->string('productName');
            $table->string('modelNumber');
            $table->longText('shortDescription');
            $table->float('regularPrice');
            $table->float('salePrice');
            $table->float('productWeight');
            $table->float('productLength')->nullable();
            $table->float('productBreadth')->nullable();
            $table->float('productHeight')->nullable();
            $table->longText('productDescription');
            $table->string('productImage');
            $table->string('productFullImage');
            $table->string('productTags');
            $table->string('productGallery');
            $table->boolean('status')->default(0);
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
        Schema::dropIfExists('manage_products');
    }
}
