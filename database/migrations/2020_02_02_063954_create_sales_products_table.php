<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('sales_date');
            $table->integer('sale_id');
            $table->integer('pro_id');
            $table->double('unit_cost');
            $table->double('unit_price');
            $table->integer('qty');
            $table->double('subtotal');
            $table->double('product_revenue');
            $table->integer('store_id')->nullable();
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
        Schema::dropIfExists('sales_products');
    }
}
