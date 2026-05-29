<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tickets', function (Blueprint $table) {
            // AGREGA ->change() al final para modificarla, no crearla
            $table->timestamp('fecha_entrega_estimada')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('tickets', function (Blueprint $table) {
            // Por si haces rollback, vuelve a dejarla como estaba antes
            $table->date('fecha_entrega_estimada')->nullable()->change();
        });
    }
};