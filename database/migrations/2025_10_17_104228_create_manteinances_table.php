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
        Schema::create('manteinances', function (Blueprint $table) {
            $table->bigIncrements('id_maintenance');
            $table->primary('id_maintenance');
            $table->unsignedBigInteger('id_ship');
            $table->foreign('id_ship')
                ->references('id_ship')
                ->on('ships')
                ->onDelete('cascade');
            $table->text('description')->nullable();
            $table->integer('cost');
            $table->date('date');
            //esto genera un fallo, porque al crear una espera de la otra (updated_at)
            //y solo se ve si 'error' => $e->getMessage() en el catch
            //$table->timestamp('created_at')/*->nullable*/;
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('manteinances');
    }
};
