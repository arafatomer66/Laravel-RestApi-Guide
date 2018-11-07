<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CategoryProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_product', function (Blueprint $table) {
            //php artisan make:migration category_product_table --create=category_product

            $table-> integer('category_id')->unsigned();
            $table-> integer('product_id')->unsigned();

            $table->foreign('category_id')->referance('id')->on('categories');
            $table->foreign('product_id')->referance('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('category_product');
    }
}
