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
        $table->dropColumn('contact_no');
        $table->string('email')->unique();
    });
}

public function down()
{
    Schema::table('applicants', function (Blueprint $table) {
        $table->dropColumn('email');
        $table->string('contact_no')->nullable();
    });
}
}
