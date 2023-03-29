<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('sales_date');
            $table->string('code')->nullable();
            $table->integer('biller_id')->nullable();
            $table->integer('store_id')->nullable();
            $table->double('grand_total');
            $table->double('discount')->nullable();
            $table->double('tax')->nullable();
            $table->double('paid_amount')->nullable();
            $table->double('due')->nullable();
            $table->integer('payment_type');
            $table->text('payment_note')->nullable();
            $table->integer('cateated_by');
            $table->integer('sales_type')->nullable();
            $table->string('customer_id');
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
        Schema::dropIfExists('sales');
    }
}
