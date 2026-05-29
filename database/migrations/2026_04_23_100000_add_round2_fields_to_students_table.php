<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('students', function (Blueprint $table) {
            // Education level (from Round 1 view update)
            $table->string('education_level')->nullable()->after('date_of_birth');

            // Mother street (was missing)
            $table->string('mother_street')->nullable()->after('mother_ward');

            // Guardian full address fields (were missing)
            $table->string('guardian_address')->nullable()->after('guardian_last_name');
            $table->string('guardian_district')->nullable()->after('guardian_region');
            $table->string('guardian_ward')->nullable()->after('guardian_district');
            $table->string('guardian_street')->nullable()->after('guardian_ward');
        });
    }

    public function down(): void
    {
        Schema::table('students', function (Blueprint $table) {
            $table->dropColumn([
                'education_level',
                'mother_street',
                'guardian_address',
                'guardian_district',
                'guardian_ward',
                'guardian_street',
            ]);
        });
    }
};
