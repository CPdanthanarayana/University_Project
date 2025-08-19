<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateApplicationVisitsTableFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('application_visits', function (Blueprint $table) {
            // First, remove the day column as it's redundant
            $table->dropColumn('day');
        });

        Schema::table('application_visits', function (Blueprint $table) {
            // Rename existing columns to match controller expectations
            $table->renameColumn('date', 'visit_date');
            $table->renameColumn('place', 'location');
        });

        Schema::table('application_visits', function (Blueprint $table) {
            // Add new columns
            $table->time('visit_time')->nullable()->after('visit_date');
            $table->text('purpose')->after('location');
            $table->text('notes')->nullable()->after('purpose');
            $table->enum('status', ['scheduled', 'completed', 'cancelled'])->default('scheduled')->after('notes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('application_visits', function (Blueprint $table) {
            // Remove added columns
            $table->dropColumn(['visit_time', 'purpose', 'notes', 'status']);
        });

        Schema::table('application_visits', function (Blueprint $table) {
            // Reverse the column renames
            $table->renameColumn('visit_date', 'date');
            $table->renameColumn('location', 'place');
        });

        Schema::table('application_visits', function (Blueprint $table) {
            // Add back the day column
            $table->string('day')->nullable()->after('application_id');
        });
    }
}
