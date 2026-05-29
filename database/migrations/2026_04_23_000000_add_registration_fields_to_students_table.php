<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('students', function (Blueprint $table) {

            // --- Student extra fields ---
            $table->string('middle_name')->nullable()->after('first_name');
            $table->string('nida_number')->nullable()->after('date_of_birth');
            $table->string('region')->nullable()->after('nida_number');
            $table->string('district')->nullable()->after('region');
            $table->string('ward')->nullable()->after('district');
            $table->string('street')->nullable()->after('ward');
            $table->string('course')->nullable()->after('street');
            $table->string('passport_photo')->nullable()->after('upload');
            $table->string('medical_form')->nullable()->after('passport_photo');

            // --- Father ---
            $table->string('father_first_name')->nullable()->after('medical_form');
            $table->string('father_middle_name')->nullable()->after('father_first_name');
            $table->string('father_last_name')->nullable()->after('father_middle_name');
            $table->string('father_address')->nullable()->after('father_last_name');
            $table->string('father_region')->nullable()->after('father_address');
            $table->string('father_district')->nullable()->after('father_region');
            $table->string('father_ward')->nullable()->after('father_district');
            $table->string('father_street')->nullable()->after('father_ward');
            $table->string('father_phone')->nullable()->after('father_street');

            // --- Mother ---
            $table->string('mother_first_name')->nullable()->after('father_phone');
            $table->string('mother_middle_name')->nullable()->after('mother_first_name');
            $table->string('mother_last_name')->nullable()->after('mother_middle_name');
            $table->string('mother_address')->nullable()->after('mother_last_name');
            $table->string('mother_region')->nullable()->after('mother_address');
            $table->string('mother_district')->nullable()->after('mother_region');
            $table->string('mother_ward')->nullable()->after('mother_district');
            $table->string('mother_phone')->nullable()->after('mother_ward');

            // --- Guardian ---
            $table->string('guardian_first_name')->nullable()->after('mother_phone');
            $table->string('guardian_middle_name')->nullable()->after('guardian_first_name');
            $table->string('guardian_last_name')->nullable()->after('guardian_middle_name');
            $table->string('guardian_region')->nullable()->after('guardian_last_name');
            $table->string('guardian_phone')->nullable()->after('guardian_region');

            // --- Sponsor ---
            $table->string('sponsor_first_name')->nullable()->after('guardian_phone');
            $table->string('sponsor_middle_name')->nullable()->after('sponsor_first_name');
            $table->string('sponsor_last_name')->nullable()->after('sponsor_middle_name');
            $table->string('sponsor_region')->nullable()->after('sponsor_last_name');
            $table->string('sponsor_district')->nullable()->after('sponsor_region');
            $table->string('sponsor_ward')->nullable()->after('sponsor_district');
            $table->string('sponsor_street')->nullable()->after('sponsor_ward');
            $table->string('sponsor_title')->nullable()->after('sponsor_street');
            $table->string('sponsor_organization')->nullable()->after('sponsor_title');
            $table->string('sponsor_business')->nullable()->after('sponsor_organization');
            $table->string('sponsor_phone')->nullable()->after('sponsor_business');
            $table->string('sponsor_email')->nullable()->after('sponsor_phone');
        });
    }

    public function down(): void
    {
        Schema::table('students', function (Blueprint $table) {
            $table->dropColumn([
                // Student
                'middle_name', 'nida_number', 'region', 'district', 'ward', 'street',
                'course', 'passport_photo', 'medical_form',
                // Father
                'father_first_name', 'father_middle_name', 'father_last_name',
                'father_address', 'father_region', 'father_district', 'father_ward',
                'father_street', 'father_phone',
                // Mother
                'mother_first_name', 'mother_middle_name', 'mother_last_name',
                'mother_address', 'mother_region', 'mother_district', 'mother_ward',
                'mother_phone',
                // Guardian
                'guardian_first_name', 'guardian_middle_name', 'guardian_last_name',
                'guardian_region', 'guardian_phone',
                // Sponsor
                'sponsor_first_name', 'sponsor_middle_name', 'sponsor_last_name',
                'sponsor_region', 'sponsor_district', 'sponsor_ward', 'sponsor_street',
                'sponsor_title', 'sponsor_organization', 'sponsor_business',
                'sponsor_phone', 'sponsor_email',
            ]);
        });
    }
};
