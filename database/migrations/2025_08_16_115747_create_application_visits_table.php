<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicationVisitsTable extends Migration
{
     public function up(): void
    {
        Schema::create('application_visits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('application_id')->constrained('applications')->onDelete('cascade');
            $table->string('day')->nullable();
            $table->date('date');
            $table->string('place');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('application_visits');
    }
}
