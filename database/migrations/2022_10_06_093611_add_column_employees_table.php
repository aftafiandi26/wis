<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->date('join_of_contract');
            $table->date('end_of_contract')->nullable();
            $table->string('nationality')->nullable();
            $table->string('province')->nullable();
            $table->string('city')->nullable();
            $table->longText('address')->nullable();
            $table->string('id_card')->nullable();
            $table->string('phone')->nullable();
            $table->string('education')->nullable();
            $table->string('maritial_status')->nullable();
            $table->string('npwp')->nullable();
            $table->string('maiden_name')->nullable();
            $table->string('kk')->nullable();
            $table->string('bpjs_ketenagakerjaan')->nullable();
            $table->string('bpjs_kesehatan')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->dropColumn('join_of_contract');
            $table->dropColumn('end_of_contract')->nullable();
            $table->dropColumn('nationality')->nullable();
            $table->dropColumn('province')->nullable();
            $table->dropColumn('city')->nullable();
            $table->dropColumn('address')->nullable();
            $table->dropColumn('id_card')->nullable();
            $table->dropColumn('phone')->nullable();
            $table->dropColumn('education')->nullable();
            $table->dropColumn('maritial_status')->nullable();
            $table->dropColumn('npwp')->nullable();
            $table->dropColumn('maiden_name')->nullable();
            $table->dropColumn('kk')->nullable();
            $table->dropColumn('bpjs_ketenagakerjaan')->nullable();
            $table->dropColumn('bpjs_kesehatan')->nullable();
        });
    }
};
