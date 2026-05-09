<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Equipo extends Model
{
    protected $fillable = [
        'cliente_id', 
        'tipo_equipo', 
        'marca', 
        'modelo', 
        'numero_serie'
    ];

    /**
     * Relación: Un equipo pertenece a un cliente.
     */
    public function cliente(): BelongsTo
    {
        return $this->belongsTo(Cliente::class);
    }

    /**
     * Relación: Un equipo puede tener muchos tickets (historial de ingresos).
     */
    public function tickets(): HasMany
    {
        return $this->hasMany(Ticket::class);
    }
}
