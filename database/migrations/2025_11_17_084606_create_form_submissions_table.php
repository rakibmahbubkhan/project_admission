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

        $table->enum('status', ['pending', 'submitted', 'reviewed'])
              ->default('pending');

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
