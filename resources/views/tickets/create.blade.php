@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card shadow-sm border-0">
                    <!-- Encabezado con botón de regreso -->
                    <div class="card-header text-white p-3 d-flex justify-content-between align-items-center"
                        style="background-color: #0000a5;">
                        <h5 class="mb-0"><i class="fas fa-plus-circle"></i> Nuevo Ingreso de Equipo</h5>
                        <a href="{{ route('tickets.index') }}" class="btn btn-sm btn-light text-primary fw-bold">
                            <i class="fas fa-arrow-left"></i> Volver a la Lista
                        </a>
                    </div>

                    <div class="card-body p-4">
                        <!-- Mostrar alerta si hay errores generales (opcional) -->
                        @if ($errors->any())
                            <div class="alert alert-danger border-0 shadow-sm">
                                <strong>Corrija los siguientes errores para continuar.</strong>
                            </div>
                        @endif

                        <form action="{{ route('tickets.store') }}" method="POST">
                            @csrf

                            {{-- SECCIÓN CLIENTE --}}
                            <div class="row mb-4">
                                <div class="col-12">
                                    <h6 class="text-uppercase fw-bold mb-3" style="color: #0000a5;">1. Datos del Cliente
                                    </h6>
                                    <hr>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label fw-semibold">DNI / Documento</label>
                                    <input type="text" name="documento_identidad"
                                        value="{{ old('documento_identidad') }}"
                                        class="form-control border-primary-subtle @error('documento_identidad') is-invalid @enderror"
                                        required>
                                    @error('documento_identidad')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label fw-semibold">Nombre Completo</label>
                                    <input type="text" name="nombre" value="{{ old('nombre') }}"
                                        class="form-control @error('nombre') is-invalid @enderror" required>
                                    @error('nombre')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label fw-semibold">Teléfono</label>
                                    <input type="text" name="telefono" value="{{ old('telefono') }}"
                                        class="form-control @error('telefono') is-invalid @enderror" required>
                                    @error('telefono')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- SECCIÓN EQUIPO --}}
                            <div class="row mb-4">
                                <div class="col-12">
                                    <h6 class="text-uppercase fw-bold mb-3" style="color: #0000a5;">2. Información del
                                        Equipo</h6>
                                    <hr>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label class="form-label fw-semibold">Tipo</label>
                                    <select name="tipo_equipo"
                                        class="form-select @error('tipo_equipo') is-invalid @enderror">
                                        <option value="Laptop" {{ old('tipo_equipo') == 'Laptop' ? 'selected' : '' }}>Laptop
                                        </option>
                                        <option value="PC Escritorio"
                                            {{ old('tipo_equipo') == 'PC Escritorio' ? 'selected' : '' }}>PC Escritorio
                                        </option>
                                        <option value="Celular" {{ old('tipo_equipo') == 'Celular' ? 'selected' : '' }}>
                                            Celular</option>
                                        <option value="Impresora"
                                            {{ old('tipo_equipo') == 'Impresora' ? 'selected' : '' }}>Impresora</option>
                                    </select>
                                    @error('tipo_equipo')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label class="form-label fw-semibold">Marca</label>
                                    <input type="text" name="marca" value="{{ old('marca') }}"
                                        class="form-control @error('marca') is-invalid @enderror" required>
                                    @error('marca')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label class="form-label fw-semibold">Modelo</label>
                                    <input type="text" name="modelo" value="{{ old('modelo') }}"
                                        class="form-control @error('modelo') is-invalid @enderror" required>
                                    @error('modelo')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label class="form-label fw-semibold">N° de Serie</label>
                                    <input type="text" name="numero_serie" value="{{ old('numero_serie') }}"
                                        class="form-control @error('numero_serie') is-invalid @enderror">
                                    @error('numero_serie')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- SECCIÓN TICKET --}}
                            <div class="row mb-4">
                                <div class="col-12">
                                    <h6 class="text-uppercase fw-bold mb-3" style="color: #0000a5;">3. Detalles del Servicio
                                    </h6>
                                    <hr>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">Problema Reportado</label>
                                    <textarea name="problema_reportado" class="form-control @error('problema_reportado') is-invalid @enderror"
                                        rows="3" required>{{ old('problema_reportado') }}</textarea>
                                    @error('problema_reportado')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label class="form-label fw-semibold">Accesorios</label>
                                    <textarea name="accesorios" class="form-control @error('accesorios') is-invalid @enderror" rows="3"
                                        placeholder="Cargador, cables...">{{ old('accesorios') }}</textarea>
                                    @error('accesorios')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label class="form-label fw-semibold">Observaciones</label>
                                    <textarea name="observaciones" class="form-control @error('observaciones') is-invalid @enderror" rows="3"
                                        placeholder="Rayones, golpes...">{{ old('observaciones') }}</textarea>
                                    @error('observaciones')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- SECCIÓN FECHA --}}
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <h6 class="text-uppercase fw-bold mb-3" style="color: #0000a5;">4. Entrega Estimada
                                    </h6>
                                    <hr>
                                    <label class="form-label fw-bold">Fecha y Hora de Entrega</label>
                                    <input type="datetime-local" name="fecha_entrega_estimada" class="form-control"
                                        value="{{ old('fecha_entrega_estimada', isset($ticket) ? \Carbon\Carbon::parse($ticket->fecha_entrega_estimada)->format('Y-m-d\TH:i') : '') }}"
                                        required>
                                    @error('fecha_entrega_estimada')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="text-end border-top pt-4">
                                <button type="submit" class="btn btn text-white px-4 shadow-sm"
                                    style="background-color: #00a545;">
                                    REGISTRAR <i class="fas fa-print ms-2"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
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
