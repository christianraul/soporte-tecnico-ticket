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
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 100);
            $table->string('documento_identidad', 20)->unique()->nullable();
            $table->string('telefono', 20);
            $table->string('email', 100)->nullable();
            $table->text('direccion')->nullable();
            $table->timestamps(); // Crea created_at y updated_at
        });
        Schema::create('equipos', function (Blueprint $table) {
            $table->id();
            // Relación con cliente usando la convención de Laravel
            $table->foreignId('cliente_id')
                ->constrained('clientes')
                ->onDelete('cascade'); // Si se borra el cliente, se borran sus equipos

            $table->string('tipo_equipo', 50); // Laptop, Celular, etc.
            $table->string('marca', 50);
            $table->string('modelo', 50);
            $table->string('numero_serie', 100)->nullable();
            $table->timestamps();
        });
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            // Relación con equipo
            $table->foreignId('equipo_id')
                ->constrained('equipos')
                ->onDelete('cascade');

            // Código personalizado para el ticket (ej: TKT-0001)
            $table->string('codigo_ticket', 20)->unique()->nullable();

            $table->text('problema_reportado');
            $table->text('accesorios')->nullable();
            $table->text('observaciones')->nullable();

            // Usamos string para el estado con un valor por defecto
            $table->string('estado', 20)->default('recibido');

            // Opcional: Fecha estimada para que aparezca en el comprobante
            $table->date('fecha_entrega_estimada')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sistema_soporte_tables');
    }
};
