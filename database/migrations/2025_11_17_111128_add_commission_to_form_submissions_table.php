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
    Schema::table('form_submissions', function (Blueprint $table) {
        $table->decimal('commission', 10, 2)->default(0)->after('status');
        $table->boolean('commission_paid')->default(false)->after('commission');
    });
}

public function down()
{
    Schema::table('form_submissions', function (Blueprint $table) {
        $table->dropColumn(['commission', 'commission_paid']);
    });
}

};
