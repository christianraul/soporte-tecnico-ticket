<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ticket extends Model
{
    protected $fillable = [
        'equipo_id',
        'codigo_ticket',
        'problema_reportado',
        'accesorios',
        'observaciones',
        'estado',
        'fecha_entrega_estimada'
    ];
    protected $casts = [
        'fecha_entrega_estimada' => 'datetime',
    ];
    /**
     * Relación: Un ticket pertenece a un equipo específico.
     */
    public function equipo(): BelongsTo
    {
        return $this->belongsTo(Equipo::class);
    }

    /**
     * Método útil para obtener el cliente directamente desde el ticket
     * Uso: $ticket->cliente()
     */
    public function cliente()
    {
        return $this->equipo->cliente;
    }
}
