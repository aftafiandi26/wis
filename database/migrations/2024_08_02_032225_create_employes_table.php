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
        Schema::create('employes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->unique()->nullable();
            $table->integer('nik')->unique();
            $table->string('first_name');
            $table->string('last_name')->nullable();
            $table->string('gender');
            $table->tinyInteger('department_id')->default(0);
            $table->string('position');
            $table->string('emp_status')->nullable();
            $table->date('join_contract');
            $table->date('end_contract')->nullable();
            $table->date('bod');
            $table->string('pob')->nullable();
            $table->string('province')->nullable();
            $table->string('maiden')->nullable();
            $table->string('email')->nullable();
            $table->bigInteger('id_card')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->string('area')->nullable();
            $table->string('city')->nullable();
            $table->string('education')->nullable();
            $table->string('insitution')->nullable();
            $table->string('marital_status')->nullable();
            $table->string('npwp')->nullable();
            $table->string('kk')->nullable();
            $table->string('religion')->nullable();
            $table->string('bpjs_ketenagakerjaan')->nullable();
            $table->string('bpjs_kesehatan')->nullable();
            $table->json('project_id')->nullable();
            $table->boolean('active')->default(true);
            $table->string('profile_pic')->nullable();
            $table->timestamps();


            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employes');
    }
};
