<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('leave_categories', function (Blueprint $table) {
            // $table->softDeletes();
            $table->tinyInteger('days')->after('name')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('leave_categories', function (Blueprint $table) {
            // $table->dropSoftDeletes();
            $table->dropColumn('days');
        });
    }
};
