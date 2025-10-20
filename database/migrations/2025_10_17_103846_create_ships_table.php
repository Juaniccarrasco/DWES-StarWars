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
        Schema::create('ships', function (Blueprint $table) {
            $table->bigIncrements('id_ship');
            $table->string('name_ship');
            $table->string('model');
            $table->string('class');
            $table->integer('tripulation');
            $table->integer('passengers');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ships');
    }
};
