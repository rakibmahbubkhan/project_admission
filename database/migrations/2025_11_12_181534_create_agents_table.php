<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('agents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->enum('type', ['company', 'individual']);

            // Common fields
            $table->string('profile_image')->nullable();
            $table->string('company')->nullable();
            $table->string('nationality')->nullable();
            $table->text('introduction')->nullable();
            $table->string('whatsapp_number')->nullable();
            $table->string('website')->nullable();
            $table->boolean('terms_accepted')->default(false);

            // Company fields
            $table->date('establishment_date')->nullable();
            $table->integer('num_offices')->nullable();
            $table->integer('num_employees')->nullable();
            $table->integer('num_schools_in_cooperation')->nullable();
            $table->integer('num_students_last_year')->nullable();
            $table->string('trade_license')->nullable();

            // Individual fields
            $table->string('full_name')->nullable();
            $table->integer('age')->nullable();
            $table->string('highest_diploma')->nullable();
            $table->string('graduate_institution')->nullable();
            $table->string('occupation')->nullable();
            $table->string('passport_identity')->nullable();
            $table->string('main_student_nationality')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('agents');
    }
};
