<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicantsTable extends Migration
{
    public function up(): void
    {
        Schema::create('applicants', function (Blueprint $table) {
            $table->id();
            $table->string('service_no')->nullable();
            $table->string('name');
            $table->string('designation')->nullable();
            $table->string('faculty')->nullable();
            $table->string('department')->nullable();
            $table->string('contact_no')->nullable();
            $table->timestamps();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('applicants');
    }
}