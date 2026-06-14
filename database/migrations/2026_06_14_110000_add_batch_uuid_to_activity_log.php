<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * spatie/laravel-activitylog v4 uses a `batch_uuid` column that the
 * v5-era create migration did not include. This adds it to existing
 * databases that were migrated before the downgrade. Guarded so it is
 * a no-op on fresh installs (where the create migration already adds it).
 */
return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('activity_log') && ! Schema::hasColumn('activity_log', 'batch_uuid')) {
            Schema::table('activity_log', function (Blueprint $table) {
                $table->uuid('batch_uuid')->nullable()->after('properties');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('activity_log', 'batch_uuid')) {
            Schema::table('activity_log', function (Blueprint $table) {
                $table->dropColumn('batch_uuid');
            });
        }
    }
};
