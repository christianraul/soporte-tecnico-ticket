<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
          // Verifica si la columna NO existe antes de crearla
        if (!Schema::hasColumn('tickets', 'fecha_entrega_estimada')) {
            Schema::table('tickets', function (Blueprint $table) {
                $table->timestamp('fecha_entrega_estimada')->nullable();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
          if (Schema::hasColumn('tickets', 'fecha_entrega_estimada')) {
            Schema::table('tickets', function (Blueprint $table) {
                $table->dropColumn('fecha_entrega_estimada');
            });
        }
    }
};
