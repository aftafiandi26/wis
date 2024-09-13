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
        Schema::create('exdoleaves', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employes_id');
            $table->bigInteger('nik');
            $table->date('date');
            $table->integer('amount')->default(0);
            $table->date('expired')->nullable();
            $table->longText('note')->nullable();
            $table->unsignedBigInteger('make_it');
            $table->timestamps();

            $table->foreign('employes_id')->references('id')->on('employes');
            $table->foreign('make_it')->references('id')->on('employes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exdoleaves');
    }
};
