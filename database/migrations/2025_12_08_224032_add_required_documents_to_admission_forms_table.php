<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('admission_forms', function (Blueprint $table) {
            $table->json('required_documents')->nullable()->after('description'); 
        });
    }

    public function down()
    {
        Schema::table('admission_forms', function (Blueprint $table) {
            $table->dropColumn('required_documents');
        });
    }
};