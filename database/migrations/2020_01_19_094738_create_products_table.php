<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('code')->unique();
            $table->string('slug')->unique();
            $table->integer('supplier');
            $table->string('codeSymbology')->nullable();
            $table->integer('category')->nullable();
            $table->integer('subcategory')->nullable();
            $table->integer('unit');
            $table->integer('brand')->nullable();
            $table->integer('purchase_price');
            $table->integer('sell_price');
            $table->integer('alert_qty')->nullable();
            $table->string('image')->nullable();
            $table->text('description')->nullable();
            $table->integer('status')->default(1);
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
