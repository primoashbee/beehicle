<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTravelRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('travel_records', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('vehicle_id');
            $table->string('address_start');
            $table->string('address_end');
            $table->string('odometer_start');
            $table->string('odometer_end');
            $table->dateTime('datetime');
            $table->longText('notes')->nullable();
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
        Schema::dropIfExists('travel_records');
    }
}
