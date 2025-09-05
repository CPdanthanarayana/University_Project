
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicationsTable extends Migration
{
    public function up(): void
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');          
            $table->foreignId('applicant_id')->constrained('applicants'); 

            $table->text('purpose');
            $table->boolean('documents_attached')->default(false); // Yes/No
            $table->string('supporting_docs')->nullable(); // path to uploaded file(s)
            $table->string('program')->nullable();
            $table->string('from_location');
            $table->string('to_location');
            $table->date('departure_date');
            $table->date('return_date');
            
            $table->string('applicant_signature_path')->nullable(); // image path
            $table->date('applicant_signed_date')->nullable(); // date of signature

            $table->enum('status', ['pending','approved','rejected'])->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
}