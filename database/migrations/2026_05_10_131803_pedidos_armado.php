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
        Schema::create('pedidos_armado', function (Blueprint $table) {
            $table->id();
            $table->string('codigo_pedido')->unique(); // PED-001
            $table->foreignId('cliente_id')->constrained('clientes');

            // Datos del equipo a armar
            $table->text('componentes');
            $table->string('sistema_operativo'); // Windows 11, etc.
            $table->text('programas_adicionales')->nullable(); // Office, Adobe, etc.

            $table->text('notas_vendedor')->nullable();
            $table->enum('estado_armado', ['pendiente', 'en_proceso', 'completado'])->default('pendiente');

            // Enlace al ticket de soporte
            $table->foreignId('ticket_id')->nullable()->constrained('tickets')->onDelete('set null');
            $table->timestamps();
        });

        // Añadimos el campo origen a la tabla tickets para saber si es reparación o venta nueva
        Schema::table('tickets', function (Blueprint $table) {
            if (!Schema::hasColumn('tickets', 'origen')) {
                $table->string('origen', 20)->default('soporte'); // 'soporte' o 'venta'
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
