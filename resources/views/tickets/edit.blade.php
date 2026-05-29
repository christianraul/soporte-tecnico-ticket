@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="card shadow border-0">
            <div class="card-header text-white d-flex justify-content-between align-items-center"
                style="background-color: #a50000;">
                <h5 class="mb-0">Editar Ticket: {{ $ticket->codigo_ticket }}</h5>
                <a href="{{ route('tickets.index') }}" class="btn btn-sm btn-light">Volver</a>
            </div>
            <div class="card-body">
                <form action="{{ route('tickets.update', $ticket->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- SECCIÓN: DATOS DEL CLIENTE -->
                    <h6 class="text-muted mb-3">Datos del Propietario</h6>
                    <div class="row mb-4">
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-bold">DNI</label>
                            <input type="text" name="documento_identidad"
                                value="{{ old('documento_identidad', $ticket->equipo->cliente->documento_identidad) }}"
                                class="form-control @error('documento_identidad') is-invalid @enderror">
                            @error('documento_identidad')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-bold">Nombre</label>
                            <input type="text" name="nombre"
                                value="{{ old('nombre', $ticket->equipo->cliente->nombre) }}"
                                class="form-control @error('nombre') is-invalid @enderror">
                            @error('nombre')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-bold">Teléfono</label>
                            <input type="text" name="telefono"
                                value="{{ old('telefono', $ticket->equipo->cliente->telefono) }}"
                                class="form-control @error('telefono') is-invalid @enderror">
                            @error('telefono')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <hr>

                    <!-- SECCIÓN: ESTADO Y FECHA -->
                    <h6 class="text-muted mb-3">Estado del Servicio</h6>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Estado del Equipo</label>
                            <select name="estado" class="form-select">
                                <option value="recibido" {{ $ticket->estado == 'recibido' ? 'selected' : '' }}>Recibido
                                </option>
                                <option value="en revision" {{ $ticket->estado == 'en revision' ? 'selected' : '' }}>En
                                    Revisión</option>
                                <option value="reparado" {{ $ticket->estado == 'reparado' ? 'selected' : '' }}>Reparado
                                </option>
                                <option value="entregado" {{ $ticket->estado == 'entregado' ? 'selected' : '' }}>Entregado
                                </option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Nueva Fecha/Hora de Entrega</label>
                            <input type="datetime-local" name="fecha_entrega_estimada"
                                value="{{ \Carbon\Carbon::parse($ticket->fecha_entrega_estimada)->format('Y-m-d\TH:i') }}"
                                class="form-control">
                            @error('fecha_entrega_estimada')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mt-4 text-end">
                        <button type="submit" class="btn text-white px-4" style="background-color: #0000a5;">
                            💾 Actualizar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
<script>
    document.addEventListener('DOMContentLoaded', function() {

        // --- 1. VALIDACIÓN DE SOLO NÚMEROS Y LONGITUD ---

        // Función genérica para restringir a solo números y limitar largo
        const validarSoloNumeros = (id, maxChars) => {
            const input = document.getElementsByName(id)[0];
            if (!input) return;

            input.addEventListener('input', function() {
                // Elimina cualquier carácter que no sea número
                this.value = this.value.replace(/[^0-9]/g, '');

                // Recorta si excede el máximo
                if (this.value.length > maxChars) {
                    this.value = this.value.slice(0, maxChars);
                }
            });
        };

        // Aplicar a DNI (8 dígitos) y Teléfono (9 dígitos)
        validarSoloNumeros('documento_identidad', 8);
        validarSoloNumeros('telefono', 9);


        // --- 2. TRANSFORMACIÓN DE TEXTO (CAPITALIZACIÓN) ---

        // Función para poner Mayúscula la primera letra de cada palabra (Nombres)
        const capitalizarNombres = (nombreCampo) => {
            const input = document.getElementsByName(nombreCampo)[0];
            if (!input) return;

            input.addEventListener('blur', function() {
                this.value = this.value.toLowerCase().replace(/\b\w/g, l => l.toUpperCase());
            });
        };

        // Función para poner Mayúscula solo la primera letra de la oración (Descripciones)
        const primeraMayusculaOraxion = (nombreCampo) => {
            const input = document.getElementsByName(nombreCampo)[0];
            if (!input) return;

            input.addEventListener('blur', function() {
                if (this.value.length > 0) {
                    this.value = this.value.charAt(0).toUpperCase() + this.value.slice(1);
                }
            });
        };

        // Aplicar transformaciones
        capitalizarNombres('nombre'); // Juan Perez Garcia
        primeraMayusculaOraxion('problema_reportado'); // La pantalla no enciende
        primeraMayusculaOraxion('accesorios'); // Cargador y funda
        primeraMayusculaOraxion('observaciones'); // Rayones leves en tapa
    });
</script>
