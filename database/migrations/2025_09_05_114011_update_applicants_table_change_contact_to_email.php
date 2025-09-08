<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateApplicantsTableChangeContactToEmail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::table('applicants', function (Blueprint $table) {
        // Only drop contact_no if it exists
        if (Schema::hasColumn('applicants', 'contact_no')) {
            $table->dropColumn('contact_no');
        }
        
        // Only add email if it doesn't exist
        if (!Schema::hasColumn('applicants', 'email')) {
            $table->string('email')->unique();
        }
    });
}

public function down()
{
    Schema::table('applicants', function (Blueprint $table) {
        // Only drop email if it exists
        if (Schema::hasColumn('applicants', 'email')) {
            $table->dropColumn('email');
        }
        
        // Only add contact_no if it doesn't exist
        if (!Schema::hasColumn('applicants', 'contact_no')) {
            $table->string('contact_no')->nullable();
        }
    });
}
}
