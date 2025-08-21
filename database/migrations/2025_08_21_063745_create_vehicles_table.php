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
        $table->string('vehicle_no')->unique();
        $table->string('type');
        $table->integer('capacity');
        $table->string('driver');
        $table->string('fuel');
        $table->date('insurance_expiry');
        $table->text('notes')->nullable();
        $table->enum('status', ['available', 'under_maintenance', 'reserved', 'out_of_service'])->default('available');
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
        Schema::dropIfExists('vehicles');
    }
}
