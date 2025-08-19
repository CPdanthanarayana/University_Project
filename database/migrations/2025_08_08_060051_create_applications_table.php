<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->string('service_no_name')->nullable();
            $table->string('designation')->nullable();
            $table->string('faculty')->nullable();
            $table->string('department')->nullable();
            $table->string('contact_no')->nullable();
            $table->text('purpose')->nullable();
            $table->boolean('supporting_docs')->default(false);
            $table->json('travelers')->nullable(); // For dynamic SN and Name fields
            $table->string('from_location')->nullable();
            $table->string('to_location')->nullable();
            $table->date('departure_date')->nullable();
            $table->time('departure_time')->nullable();
            $table->date('return_date')->nullable();
            $table->time('return_time')->nullable();
            $table->string('route')->nullable();
            $table->string('parking_place')->nullable();
            $table->json('program')->nullable(); // For tentative program
            $table->string('applicant_signature_path')->nullable();
            $table->date('applicant_date')->nullable();
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
        Schema::dropIfExists('applications');
    }
}
