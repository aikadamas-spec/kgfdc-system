<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Before adding the unique constraint, deduplicate any existing rows
        // that share the same session_id — keep only the most recently active one.
        if (Schema::hasTable('visitor_logs')) {
            DB::statement('
                DELETE v1 FROM visitor_logs v1
                INNER JOIN visitor_logs v2
                    ON v1.session_id = v2.session_id
                    AND v1.id < v2.id
            ');
        }

        Schema::table('visitor_logs', function (Blueprint $table) {
            // Drop the plain index first (can't have both plain + unique on same column)
            $table->dropIndex(['session_id']);

            // Add the unique constraint — makes updateOrInsert() truly atomic
            $table->unique('session_id', 'visitor_logs_session_id_unique');
        });
    }

    public function down(): void
    {
        Schema::table('visitor_logs', function (Blueprint $table) {
            $table->dropUnique('visitor_logs_session_id_unique');
            $table->index('session_id');
        });
    }
};
