<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('visitor_logs', function (Blueprint $table) {
            $table->string('country', 100)->nullable()->after('session_id');
            $table->string('region', 100)->nullable()->after('country');
            $table->string('city', 100)->nullable()->after('region');
            $table->decimal('latitude', 10, 7)->nullable()->after('city');
            $table->decimal('longitude', 10, 7)->nullable()->after('latitude');

            // Index country + city for fast grouping in dashboard queries
            $table->index('country', 'visitor_logs_country_idx');
            $table->index('city',    'visitor_logs_city_idx');
        });
    }

    public function down(): void
    {
        Schema::table('visitor_logs', function (Blueprint $table) {
            $table->dropIndex('visitor_logs_country_idx');
            $table->dropIndex('visitor_logs_city_idx');
            $table->dropColumn(['country', 'region', 'city', 'latitude', 'longitude']);
        });
    }
};
