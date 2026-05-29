<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->id();

            // Applicant details
            $table->string('full_name');
            $table->string('email')->nullable();
            $table->string('phone_number');
            $table->string('gender');                          // Male / Female
            $table->date('date_of_birth')->nullable();
            $table->string('course_applied');                  // e.g. "Ufundi wa Magari"
            $table->string('course_type')->default('mrefu');   // mrefu | mfupi

            // Payment
            $table->string('payment_reference')->unique();     // Generated UUID ref
            $table->decimal('amount', 10, 2)->default(10000);  // TSH 10,000 form fee
            $table->string('beem_transaction_id')->nullable(); // Filled by Beem callback
            $table->string('beem_reference')->nullable();      // Beem push reference

            // Status flow: pending_payment → paid → form_submitted → approved | rejected
            $table->enum('application_status', [
                'pending_payment',
                'paid',
                'form_submitted',
                'approved',
                'rejected',
            ])->default('pending_payment');

            $table->boolean('form_unlocked')->default(false);  // Unlocked after payment
            $table->text('notes')->nullable();                 // Admin notes

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};
