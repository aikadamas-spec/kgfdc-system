<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('visitor_logs', function (Blueprint $table) {
            $table->id();
            $table->string('ip_address', 45);       // supports IPv4 and IPv6
            $table->string('session_id', 100);
            $table->string('url_visited', 500);
            $table->timestamp('last_activity');
            $table->timestamps();

            // Index for fast lookups when counting active/unique visitors
            $table->index('session_id');
            $table->index('last_activity');
            $table->index('ip_address');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('visitor_logs');
    }
};
