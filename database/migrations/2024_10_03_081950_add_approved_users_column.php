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
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('need_spv')->default(true);
            $table->boolean('need_coor')->default(true);
            $table->boolean('need_pm')->default(true);
            $table->boolean('need_producer')->default(true);
            $table->boolean('need_hod')->default(true);
            $table->boolean('need_verify')->default(true);
            $table->boolean('need_gm')->default(false);
            $table->boolean('need_hr_manager')->default(true);

            $table->boolean('verify')->after('gm')->default(false);
            $table->boolean('confirmed')->after('verify')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('need_spv');
            $table->dropColumn('need_coor');
            $table->dropColumn('need_pm');
            $table->dropColumn('need_producer');
            $table->dropColumn('need_hod');
            $table->dropColumn('need_verify');
            $table->dropColumn('need_gm');
            $table->dropColumn('need_hr_manager');

            $table->dropColumn('verify')->after('gm');
            $table->dropColumn('confirmed')->after('verify');
        });
    }
};
