<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->string('numero_documento')->unique();
            $table->dateTime('fecha_ingreso');
            $table->string('origen_oficina');
            $table->string('titulo');
            $table->integer('numero_folios');
            $table->text('detalles');
            $table->string('derivado_oficina')->nullable();
            $table->dateTime('fecha_salida')->nullable();
            $table->foreignId('trabajador_id')->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
