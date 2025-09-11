<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFinalStatusToApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::table('applications', function (Blueprint $table) {
        $table->enum('final_status', ['pending', 'approved', 'rejected'])
              ->default('pending')
              ->after('status');
    });
}

public function down()
{
    Schema::table('applications', function (Blueprint $table) {
        $table->dropColumn('final_status');
    });
}
}
