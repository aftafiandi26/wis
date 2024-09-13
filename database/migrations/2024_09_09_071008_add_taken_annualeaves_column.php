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
        Schema::table('annualeaves', function (Blueprint $table) {
            $table->integer('takenAnnual')->default(0)->after('annual');
            $table->integer('takenExdo')->default(0)->after('exdo');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('annualeaves', function (Blueprint $table) {
            $table->dropColumn('takenAnnual');
            $table->dropColumn('takenExdo');
        });
    }
};
