<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesDueReturnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_due_returns', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('customer_id');
            $table->double('paid_amount');
            $table->double('current_due');
            $table->double('balance');
            $table->string('payment_method')->nullable();
            $table->text('payment_note')->nullable();
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
        Schema::dropIfExists('sales_due_returns');
    }
}
