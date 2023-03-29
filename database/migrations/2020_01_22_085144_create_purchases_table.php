<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code')->nullable();
            $table->integer('biller_id')->nullable();
            $table->integer('store_id')->nullable();
            $table->double('grand_total');
            $table->double('discount')->nullable();
            $table->double('tax')->nullable();
            $table->double('paid_amount')->nullable();
            $table->double('due')->nullable();
            $table->text('note')->nullable();
            $table->string('documents')->nullable();
            $table->integer('import_by')->nullable();
            $table->integer('is_received')->default(0);
            $table->string('reference')->nullable();
            $table->string('purchase_date');
            $table->string('supplier_id')->nullable();
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
        Schema::dropIfExists('purchases');
    }
}
