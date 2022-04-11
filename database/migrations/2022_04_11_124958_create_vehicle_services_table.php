<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehicleServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicle_services', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('vehicle_id');
            $table->unsignedInteger('service_id');
            $table->unsignedInteger('provider_id');
            $table->string('name');
            $table->date('date');
            $table->decimal('cost',9,2);
            $table->longText('notes')->nullable();;
            $table->softDeletes();
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
        Schema::dropIfExists('vehicle_services');
    }
}
