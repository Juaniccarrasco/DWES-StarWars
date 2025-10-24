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
        Schema::create('pilots', function (Blueprint $table) {
            $table->bigIncrements('id_pilot');
            $table->string('name_pilot');
            $table->integer('height')->nullable/*->change()*/; //Para lanzar una migracion de nuevo y que se cambie
            $table->date('birth_year')->nullable;
            $table->string('gender')->nullable;
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pilots');
    }
};
