<?php

use App\Models\employee;
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
        Schema::create('project_users', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(employee::class);
            $table->tinyInteger('proejct_1')->nullable();
            $table->tinyInteger('proejct_2')->nullable();
            $table->tinyInteger('proejct_3')->nullable();
            $table->tinyInteger('proejct_4')->nullable();
            $table->tinyInteger('proejct_5')->nullable();
            $table->tinyInteger('proejct_6')->nullable();
            $table->tinyInteger('proejct_7')->nullable();
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
        Schema::dropIfExists('project_users');
    }
};
