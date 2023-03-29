<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSystemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('systems', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('siteName');
            $table->string('siteEmail');
            $table->string('siteLogo')->nullable();
            $table->string('sitePhone');
            $table->string('unitCode');
            $table->string('expenseCategoryUnit');
            $table->string('brandCode');
            $table->string('categoryCode');
            $table->string('productCode');
            $table->string('invoiceCode');
            $table->string('purchaseCode');
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
        Schema::dropIfExists('systems');
    }
}
