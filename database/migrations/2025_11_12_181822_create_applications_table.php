<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
{
    Schema::create('applications', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('student_id');
        $table->unsignedBigInteger('admission_form_id');
        $table->unsignedBigInteger('agent_id')->nullable();
        $table->json('form_data'); // stores submitted form fields
        $table->enum('status', ['pending','approved','rejected'])->default('pending');
        $table->timestamps();

        $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
        $table->foreign('admission_form_id')->references('id')->on('admission_forms')->onDelete('cascade');
        $table->foreign('agent_id')->references('id')->on('users')->onDelete('set null');
    });
}


    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};

