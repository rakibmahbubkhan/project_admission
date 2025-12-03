<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('admission_forms', function (Blueprint $table) {
            // Basic Offer Details
            $table->string('offer_title')->nullable();
            $table->string('intake')->nullable(); // e.g. "Sept 2025"
            $table->string('degree')->nullable(); // Diploma, Bachelor, etc.
            $table->string('major')->nullable();
            $table->string('teaching_language')->nullable(); // English/Chinese
            $table->string('scholarship_type')->nullable();
            $table->string('location')->nullable();
            $table->string('university_name_override')->nullable(); // "University Name" column requested

            // Program Details (Fees)
            $table->decimal('tuition_fees', 10, 2)->nullable(); // Yearly
            $table->string('dorm_fees')->nullable(); // String because "As per Dorm Type"
            $table->decimal('medical_fees', 10, 2)->nullable();
            $table->decimal('insurance_fees', 10, 2)->nullable();
            $table->decimal('resident_permit_fee', 10, 2)->nullable();
            $table->decimal('text_book_fee', 10, 2)->nullable();
            $table->decimal('deposit_fee', 10, 2)->nullable();
            $table->decimal('dorm_deposit', 10, 2)->nullable();
            $table->string('other_fees')->nullable();

            // Scholarship Details
            $table->string('scholarship_coverage')->nullable();
            $table->decimal('stipend_amount', 10, 2)->nullable(); // If stipend selected
            $table->text('scholarship_other_facilities')->nullable(); // If others selected

            // Fees Payable after Scholarship
            $table->decimal('after_scholarship_tuition_fees', 10, 2)->nullable();
            $table->string('after_scholarship_dorm_fees')->nullable();

            // Restrictions
            $table->string('age_restriction')->nullable();
            $table->text('country_restriction')->nullable();
            $table->boolean('accept_in_china')->default(false);
            $table->boolean('accept_studied_in_china')->default(false);

            // Service Policy
            $table->boolean('has_exclusive_service_policy')->default(false);
            $table->boolean('has_premium_service_policy')->default(false);
            

            // Add specific columns for Exclusive Policy
            $table->decimal('exclusive_partner_rate', 10, 2)->nullable()->after('has_exclusive_service_policy');
            $table->decimal('exclusive_student_rate', 10, 2)->nullable()->after('exclusive_partner_rate');

            // Add specific columns for Premium Policy
            $table->decimal('premium_partner_rate', 10, 2)->nullable()->after('has_premium_service_policy');
            $table->decimal('premium_student_rate', 10, 2)->nullable()->after('premium_partner_rate');

             $table->string('tuition_fee_type')->default('Annual')->nullable()->after('tuition_fees');
            $table->string('dorm_fee_type')->default('Annual')->nullable()->after('dorm_fees');
            
            $table->string('after_scholarship_tuition_fee_type')->default('Annual')->nullable()->after('after_scholarship_tuition_fees');
            $table->string('after_scholarship_dorm_fee_type')->default('Annual')->nullable()->after('after_scholarship_dorm_fees');
        });
    }

    public function down(): void
    {
        Schema::table('admission_forms', function (Blueprint $table) {
            $table->dropColumn([
                'offer_title', 'intake', 'degree', 'major', 'teaching_language', 
                'scholarship_type', 'location', 'university_name_override',
                'tuition_fees', 'dorm_fees', 'medical_fees', 'insurance_fees', 
                'resident_permit_fee', 'text_book_fee', 'deposit_fee', 'dorm_deposit', 'other_fees',
                'scholarship_coverage', 'stipend_amount', 'scholarship_other_facilities',
                'after_scholarship_tuition_fees', 'after_scholarship_dorm_fees',
                'age_restriction', 'country_restriction', 'accept_in_china', 'accept_studied_in_china',
                'has_exclusive_service_policy', 'has_premium_service_policy',
                'exclusive_partner_rate',
                'exclusive_student_rate',
                'premium_partner_rate',
                'premium_student_rate',
                'tuition_fee_type',
                'dorm_fee_type',
                'after_scholarship_tuition_fee_type',
                'after_scholarship_dorm_fee_type',
            ]);
        });
    }
};