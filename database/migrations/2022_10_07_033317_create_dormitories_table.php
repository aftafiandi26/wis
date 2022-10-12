<?php

use App\Models\employee;
use App\Models\User;
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
        Schema::create('dormitories', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(employee::class);
            $table->string('status');
            $table->string('room');
            $table->dateTime('in');
            $table->dateTime('out')->nullable();
            $table->boolean('active')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dormitories');
    }
};
