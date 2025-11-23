<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('agent_id')->nullable()->constrained('users')->onDelete('set null');
            
            // 1. Personal Information (Permanent)
            $table->string('given_name')->nullable();
            $table->string('surname')->nullable();
            $table->string('gender')->nullable(); // Male, Female
            $table->string('nationality')->nullable();
            $table->string('religion')->nullable();
            $table->string('marital_status')->nullable();
            $table->string('city_of_birth')->nullable();
            $table->date('dob')->nullable();
            $table->string('native_language')->nullable();
            $table->string('height')->nullable();
            $table->string('weight')->nullable();
            $table->string('blood_group')->nullable();

            // China Status
            $table->boolean('in_china')->default(false);
            $table->date('in_china_from')->nullable();
            $table->string('in_china_institute')->nullable();
            $table->boolean('studied_in_china')->default(false);
            $table->date('studied_in_china_from')->nullable();
            $table->string('studied_in_china_institute')->nullable();

            // Passport
            $table->string('passport_number')->nullable();
            $table->date('passport_expiry_date')->nullable();
            $table->date('passport_issue_date')->nullable();

            // Contact Details
            $table->string('street')->nullable();
            $table->string('city')->nullable();
            $table->string('country')->nullable();
            $table->string('zip_code')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable(); // Alternate email

            // JSON Columns for Complex Data
            $table->json('sponsor_info')->nullable();        // Section 1.2
            $table->json('parents_info')->nullable();        // Section 1.3
            $table->json('education_background')->nullable();// Section 1.4
            $table->json('work_experience')->nullable();     // Section 1.5
            $table->json('other_info')->nullable();          // Section 1.6 (English, CSCA)

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};