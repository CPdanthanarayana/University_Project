<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FixApplicationVisitsColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('application_visits', function (Blueprint $table) {
            // Remove the day column if it exists
            if (Schema::hasColumn('application_visits', 'day')) {
                $table->dropColumn('day');
            }
        });

        Schema::table('application_visits', function (Blueprint $table) {
            // Rename columns to match model expectations
            if (Schema::hasColumn('application_visits', 'date')) {
                $table->renameColumn('date', 'visit_date');
            }
            if (Schema::hasColumn('application_visits', 'place')) {
                $table->renameColumn('place', 'location');
            }
        });

        Schema::table('application_visits', function (Blueprint $table) {
            // Add new columns that the model expects
            if (!Schema::hasColumn('application_visits', 'visit_time')) {
                $table->time('visit_time')->nullable()->after('visit_date');
            }
            if (!Schema::hasColumn('application_visits', 'purpose')) {
                $table->string('purpose')->after('location');
            }
            if (!Schema::hasColumn('application_visits', 'notes')) {
                $table->text('notes')->nullable()->after('purpose');
            }
            if (!Schema::hasColumn('application_visits', 'status')) {
                $table->enum('status', ['scheduled', 'completed', 'cancelled'])->default('scheduled')->after('notes');
            }
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
