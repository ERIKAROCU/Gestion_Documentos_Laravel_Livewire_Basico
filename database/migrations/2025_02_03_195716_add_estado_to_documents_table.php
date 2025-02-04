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
        Schema::table('documents', function (Blueprint $table) {
            // Agregar columna 'estado' con valores predefinidos
            $table->enum('estado', ['recibido', 'emitido', 'vencido'])->default('Recibido')->after('trabajador_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('documents', function (Blueprint $table) {
            // Eliminar la columna 'estado' si es necesario revertir la migración
            $table->dropColumn('estado');
        });
    }
};
