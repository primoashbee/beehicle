<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id');
            $table->string('brand');
            $table->string('plate_number')->unique();
            $table->string('vehicle_type');
            $table->string('date_purchased');
            $table->string('chasis');
            $table->string('coding');
            $table->longText('description')->nullable();
            $table->timestamps();
        });
    }

    /**000
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vehicles');
    }
}
