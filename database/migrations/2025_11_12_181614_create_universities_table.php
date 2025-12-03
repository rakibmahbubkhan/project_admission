<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('universities', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('country');
            $table->string('city');
            $table->string('currency', 10)->nullable();
            $table->string('type')->nullable();
            $table->string('logo')->nullable();
            $table->string('image')->nullable();
            $table->longText('content')->nullable();
            $table->integer('ranking')->nullable();
            $table->string('intake')->nullable();
            $table->date('deadline')->nullable();
            $table->longText('description')->nullable();
            $table->boolean('isActive')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('universities');
    }
};
