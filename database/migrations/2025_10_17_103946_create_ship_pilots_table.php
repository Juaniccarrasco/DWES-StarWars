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
        Schema::create('ship_pilots', function (Blueprint $table) {
            $table->primary(['id_ship','id_pilot']);
            $table->unique(['id_ship','id_pilot']);
            $table->unsignedBigInteger('id_ship');
            $table->foreign('id_ship')
                ->references('id_ship')
                ->on('ships')
                ->onDelete('cascade');
            $table->unsignedBigInteger('id_pilot');
            $table->foreign('id_pilot')
                ->references('id_pilot')
                ->on('pilots')
                ->onDelete('cascade');
            $table->timestamps();
            $table->boolean('associated')->default(true);
            // Obtenemos el timestamp actualizado como string
            // $timestamp = Carbon::parse($registro->updated_at)->toDateTimeString();
            $table->string('unassigned')->nullable();
            $table->string('reassigned')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ship_pilots');
    }
};
