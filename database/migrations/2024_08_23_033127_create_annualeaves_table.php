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
        Schema::create('annualeaves', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employes_id');
            $table->bigInteger('nik');
            $table->integer('totalAnnual')->default(0);
            $table->integer('totalExdo')->default(0);
            $table->integer('annual')->default(0);
            $table->integer('exdo')->default(0);

            $table->foreign('employes_id')->references('id')->on('employes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('annualeaves');
    }
};
