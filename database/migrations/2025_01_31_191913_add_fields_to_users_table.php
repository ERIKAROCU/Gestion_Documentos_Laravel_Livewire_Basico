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
        Schema::table('users', function (Blueprint $table) {
            $table->string('dni', 20)->unique()->after('email'); // DNI único
            $table->string('cargo', 100)->nullable()->after('dni'); // Cargo del usuario
            $table->string('role', 50)->default('user')->after('cargo'); // Rol del usuario
            $table->boolean('is_active')->default(true)->after('role'); // Estado del usuario (activo/inactivo)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['dni', 'cargo', 'role', 'is_active']);
        });
    }
};
