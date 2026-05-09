<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Cliente extends Model
{
    // Campos que se pueden llenar desde un formulario
    protected $fillable = [
        'nombre', 
        'documento_identidad', 
        'telefono', 
        'email', 
        'direccion'
    ];

    /**
     * Relación: Un cliente tiene muchos equipos.
     */
    public function equipos(): HasMany
    {
        return $this->hasMany(Equipo::class);
    }

    /**
     * Relación Pro: Obtener todos los tickets del cliente 
     * saltando directamente desde Cliente a Tickets.
     */
    public function tickets(): HasManyThrough
    {
        return $this->hasManyThrough(Ticket::class, Equipo::class);
    }
}
