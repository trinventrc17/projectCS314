<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoomChangesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('room_changes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('session');
            $table->string('roomType');
            $table->string('roomPrice');
            $table->string('promoType');
            $table->string('promoPrice');
            $table->string('movies');
            $table->string('numberOfMoviesOrHour');
            $table->string('startTime');
            $table->string('endTime');
            $table->string('numberOfExtraPerson')->default('0');
            $table->string('additionalTimeFee')->default('0');
            $table->string('corkageFee')->default('0');
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
        Schema::dropIfExists('room_changes');
    }
}
