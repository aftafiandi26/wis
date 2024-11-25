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
        Schema::create('leave_transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('employee_id');
            $table->unsignedBigInteger('leave_category_id');

            $table->tinyInteger('period');
            $table->date('start_leave');
            $table->date('end_leave');
            $table->date('back_work');
            $table->float('total_day');
            $table->float('entitlement');
            $table->float('pending');
            $table->float('taken');
            $table->float('remains');
            $table->boolean('formStat')->default(true);

            $table->unsignedBigInteger('spv_id')->nullable();
            $table->boolean('ap_spv')->default(false);
            $table->dateTime('date_spv')->nullable();

            $table->unsignedBigInteger('coor_id')->nullable();
            $table->boolean('ap_coor')->default(false);
            $table->dateTime('date_coor')->nullable();

            $table->unsignedBigInteger('pm_id')->nullable();
            $table->boolean('ap_pm')->default(false);
            $table->dateTime('date_pm')->nullable();

            $table->unsignedBigInteger('producer_id')->nullable();
            $table->boolean('ap_producer')->default(false);
            $table->dateTime('date_producer')->nullable();

            $table->unsignedBigInteger('hd_id')->nullable();
            $table->boolean('ap_hd')->default(false);
            $table->dateTime('date_hd')->nullable();

            $table->unsignedBigInteger('hr_id')->nullable();
            $table->boolean('ver_hr')->default(false);
            $table->dateTime('date_hr')->nullable();

            $table->unsignedBigInteger('hrd_id')->nullable();
            $table->boolean('ver_hrd')->default(false);
            $table->dateTime('date_hrd')->nullable();

            $table->unsignedBigInteger('gm_id')->nullable();
            $table->boolean('ap_gm')->default(false);
            $table->dateTime('date_gm')->nullable();


            $table->timestamps();

            $table->foreign('employee_id')->references('id')->on('employes');
            $table->foreign('user_id')->references('id')->on('employes');
            $table->foreign('spv_id')->references('id')->on('employes');
            $table->foreign('coor_id')->references('id')->on('employes');
            $table->foreign('pm_id')->references('id')->on('employes');
            $table->foreign('producer_id')->references('id')->on('employes');
            $table->foreign('hd_id')->references('id')->on('employes');
            $table->foreign('hr_id')->references('id')->on('employes');
            $table->foreign('hrd_id')->references('id')->on('employes');
            $table->foreign('gm_id')->references('id')->on('employes');
            $table->foreign('leave_category_id')->references('id')->on('leave_categories');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leave_transactions');
    }
};
