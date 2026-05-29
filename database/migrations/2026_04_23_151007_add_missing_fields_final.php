<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('students', function (Blueprint $table) {
            // Angalia kama hazipo, kisha ziongeze
        if (!Schema::hasColumn('students', 'education_level')) $table->string('education_level')->nullable();
        if (!Schema::hasColumn('students', 'course_applied')) $table->string('course_applied')->nullable();
        if (!Schema::hasColumn('students', 'mother_street')) $table->string('mother_street')->nullable();
        if (!Schema::hasColumn('students', 'guardian_address')) $table->string('guardian_address')->nullable();
        if (!Schema::hasColumn('students', 'guardian_district')) $table->string('guardian_district')->nullable();
        if (!Schema::hasColumn('students', 'guardian_ward')) $table->string('guardian_ward')->nullable();
        if (!Schema::hasColumn('students', 'guardian_street')) $table->string('guardian_street')->nullable();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('students', function (Blueprint $table) {
            //
        });
    }
};
