@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow-lg">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0">✅ ¡Ingreso Exitoso! Ticket: {{ $ticket->codigo_ticket }}</h5>
                </div>
                <div class="card-body p-4">
                    <div class="row mb-4">
                        <div class="col-sm-6">
                            <h6 class="text-muted">Cliente:</h6>
                            <p class="fw-bold">{{ $ticket->equipo->cliente->nombre }}</p>
                        </div>
                        <div class="col-sm-6 text-sm-end">
                            <h6 class="text-muted">Fecha de Recepción:</h6>
                            <p>{{ $ticket->created_at->format('d/m/Y H:i') }}</p>
                        </div>
                    </div>

                    <div class="alert alert-light border">
                        <h6><strong>Equipo:</strong> {{ $ticket->equipo->marca }} {{ $ticket->equipo->modelo }}</h6>
                        <p class="mb-0"><strong>Problema:</strong> {{ $ticket->problema_reportado }}</p>
                        <p class="mb-0"><strong>Fecha de Entrega:</strong> {{$ticket->fecha_entrega_estimada}}</p>
                    </div>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                        <a href="{{ route('tickets.index') }}" class="btn btn-outline-secondary">Volver</a>
                        <a href="{{ route('tickets.pdf', $ticket->id) }}" target="_blank" class="btn btn-primary">
                            🖨️ Imprimir Comprobante
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection