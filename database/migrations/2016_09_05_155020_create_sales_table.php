<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->increments('id');
            $table->string('session');
            $table->integer('customer_id');
            $table->integer('cashier_id');
            $table->string('roomType');
            $table->string('roomPrice');
            $table->string('promoType');
            $table->string('promoPrice');
            $table->string('movies')->default('None');
            $table->string('numberOfMoviesOrHour');
            $table->string('startTime');
            $table->string('endTime');
            $table->string('reservationfee')->default('0');;
            $table->string('numberOfExtraPerson')->default('0');
            $table->string('discountFee')->default('0');
            $table->string('additionalTimeFee')->default('0');
            $table->string('corkageFee')->default('0');
            $table->string('todayOrTomorrow')->default('Today');
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
        Schema::drop('sales');
    }
}
