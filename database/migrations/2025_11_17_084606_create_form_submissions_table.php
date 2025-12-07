<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('form_submissions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('agent_id')->nullable();
            $table->unsignedBigInteger('university_id');
            $table->unsignedBigInteger('form_id');

            $table->json('answers'); // All section-wise answers

            // Updated Enum List
            $table->enum('status', [
                'draft',
                'pending', 
                'submitted', 
                'processing', 
                'correct_and_resubmit',
                'pay_application_fees',
                'pay_required_deposit',
                'passed_initial_review',
                'pre_admitted',
                'admitted',
                'successful',
                'rejected',
                'refunded'
            ])->default('pending');

            $table->decimal('commission', 10, 2)->default(0.00); // Ensure commission column exists if referenced in views
            $table->boolean('commission_paid')->default(false);

            $table->timestamps();
        });

        // Add foreign keys separately
        Schema::table('form_submissions', function (Blueprint $table) {
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
            $table->foreign('agent_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('university_id')->references('id')->on('universities')->onDelete('cascade');
            $table->foreign('form_id')->references('id')->on('admission_forms')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('form_submissions');
    }
};