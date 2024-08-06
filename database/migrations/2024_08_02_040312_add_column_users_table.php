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
            $table->string('emp_id')->unique()->after('id')->nullable();
            $table->string('username')->unique()->after('emp_id')->nullable();
            $table->boolean('active')->default(true);
            $table->boolean('officer')->default(false);
            $table->boolean('production')->default(false);
            $table->boolean('coor')->default(false);
            $table->boolean('spv')->default(false);
            $table->boolean('pm')->default(false);
            $table->boolean('producer')->default(false);
            $table->boolean('hod')->default(false);
            $table->boolean('gm')->default(false);
            $table->boolean('admin')->default(false);
            $table->boolean('superadmin')->default(false);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('emp_id');
            $table->dropColumn('username');
            $table->dropColumn('active');
            $table->dropColumn('officer');
            $table->dropColumn('production');
            $table->dropColumn('coor');
            $table->dropColumn('spv');
            $table->dropColumn('pm');
            $table->dropColumn('producer');
            $table->dropColumn('hod');
            $table->dropColumn('gm');
            $table->dropColumn('admin');
            $table->dropColumn('superadmin');
        });
    }
};
