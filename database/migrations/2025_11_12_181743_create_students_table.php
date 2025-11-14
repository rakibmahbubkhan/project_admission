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
    $table->string('nationality')->nullable();
    $table->string('phone')->nullable();
    $table->date('dob')->nullable();
    $table->string('gender')->nullable();
    $table->text('address')->nullable();
    $table->timestamps();
});
    }

    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
