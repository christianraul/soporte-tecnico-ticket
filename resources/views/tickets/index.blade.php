@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="text-institucional fw-bold">📋 Registro de Tickets</h3>
            <a href="{{ route('tickets.create') }}" class="btn btn-primary" style="font-family: "Google Sans", sans-serif; font-weight: 600;">
             Nuevo Ingreso
            </a>
        </div>

        @if (session('success'))
            <div class="alert alert-success border-0 shadow-sm mb-3">
                {{ session('success') }}
            </div>
        @endif

        <div class="card shadow-sm border-0">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="text-white" style="background-color: #0000a5;">
                            <tr>
                                <th class="ps-4">Código</th>
                                <th>Fecha de Recepción</th>
                                <th>Cliente</th>
                                <th>Equipo</th>
                                <th>Estado</th>
                                <th>Hora de Entrega</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tickets as $ticket)
                                <tr class="align-middle">
                                    <td class="ps-4 fw-bold text-institucional">{{ $ticket->codigo_ticket }}</td>
                                    <td>{{ $ticket->created_at->format('d/m/Y h:i A') }}</td>
                                    <td>
                                        <div class="fw-bold">{{ $ticket->equipo->cliente->nombre }}</div>
                                        <small class="text-muted">{{ $ticket->equipo->cliente->telefono }}</small>
                                    </td>
                                    <td>{{ $ticket->equipo->marca }} - {{ $ticket->equipo->modelo }}</td>
                                    <td>
                                        @php
                                            $colores = [
                                                'recibido' => 'bg-secondary', // Gris
                                                'en revision' => 'bg-warning text-dark', // Amarillo
                                                'reparado' => 'bg-success', // Verde
                                                'entregado' => 'bg-primary', // Azul
                                                'cancelado' => 'bg-danger', // Rojo
                                            ];
                                            // Si el estado no existe en el mapa, usamos bg-info por defecto
                                            $colorClase = $colores[$ticket->estado] ?? 'bg-info';
                                        @endphp

                                        <span class="badge rounded-pill {{ $colorClase }}">
                                            {{ ucfirst($ticket->estado) }}
                                        </span>

                                    </td>
                                    <td>
                                        <span>
                                            {{ $ticket->fecha_entrega_estimada->format('d/m/Y H:i') }}
                                            {{-- {{ $ticket->fecha_entrega_estimada ? $ticket->fecha_entrega_estimada->format('d/m/Y g:i A') : 'No asignada' }} --}}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center align-items-center gap-1">
                                            <!-- Enlace Ver Detalle -->
                                            <a href="{{ route('tickets.show', $ticket->id) }}"
                                                class="btn btn-sm btn-outline-secondary" title="Ver Detalle">
                                                <i class="bi bi-eye-fill"></i>
                                            </a>

                                            <!-- Enlace Editar -->
                                            <a href="{{ route('tickets.edit', $ticket->id) }}"
                                                class="btn btn-sm btn-outline-warning" title="Editar">
                                                <i class="bi bi-pencil-fill"></i>
                                            </a>

                                            <!-- Formulario Eliminar -->
                                            <form action="{{ route('tickets.destroy', $ticket->id) }}" method="POST"
                                                onsubmit="return confirm('¿Estás seguro de eliminar este ticket?')"
                                                class="m-0">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger"
                                                    title="Eliminar">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>


                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer bg-white py-3">
                {{ $tickets->links() }}
            </div>
        </div>
    </div>
@endsection
