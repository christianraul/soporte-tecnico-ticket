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
        Schema::table('tickets', function (Blueprint $table) {
            // Añadimos la columna de fecha y hora después del campo 'estado'
            $table->dateTime('fecha_entrega_estimada')->nullable()->after('estado');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tickets', function (Blueprint $table) {
            // Por si queremos deshacer el cambio, borramos la columna
            $table->dropColumn('fecha_entrega_estimada');
        });
    }
};
