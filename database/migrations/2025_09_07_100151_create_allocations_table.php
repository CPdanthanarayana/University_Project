<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAllocationsTable extends Migration
{
    public function up()
    {
        Schema::create('allocations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('application_id');   // the approved request
            $table->unsignedBigInteger('vehicle_id');       // chosen vehicle
            $table->dateTime('start_at');                   // departure datetime
            $table->dateTime('end_at');                     // return datetime
            $table->unsignedBigInteger('allocated_by');     // admin who allocated
            $table->enum('status', ['allocated','completed','canceled'])->default('allocated');
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->foreign('application_id')->references('id')->on('applications')->onDelete('cascade');
            $table->foreign('vehicle_id')->references('id')->on('vehicles')->onDelete('restrict');
            $table->index(['vehicle_id','start_at','end_at']); // for overlap queries
        });
    }

    public function down()
    {
        Schema::dropIfExists('allocations');
    }
}
