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
        Schema::create('planets', function (Blueprint $table) {
            $table->bigIncrements('id_planet');
            $table->primary('id_planet');
            $table->string('name_planet');
            $table->integer('population');
            $table->integer('climate');
            $table->integer('rotation_period');
            $table->unsignedBigInteger('id_ship');
            $table->foreign('id_ship')
                ->references('id_ship')
                ->on('ships')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('planets');
    }
};
