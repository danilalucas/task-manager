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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('description')->nullable();
            $table->string('tumb')->nullable();
            $table->date('deadline')->nullable();
            $table->unsignedBigInteger('group_id')->nullable();
            $table->unsignedBigInteger('priority_id')->nullable();
            $table->unsignedBigInteger('responsible_id')->nullable();
            $table->boolean('filed')->default(false);
            $table->timestamps();

            $table->foreign('group_id')->references('id')
                  ->on('groups')->nullOnDelete();
            $table->foreign('priority_id')->references('id')
                  ->on('priorities')->nullOnDelete();
            $table->foreign('responsible_id')->references('id')
                  ->on('responsibles')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
};
