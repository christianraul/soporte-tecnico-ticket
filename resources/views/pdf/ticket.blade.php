<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Ticket {{ $ticket->codigo_ticket }}</title>
    <style>
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            font-size: 12px;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .ticket {
            width: 100%;
            max-width: 280px; /* Aprox 80mm */
            margin: auto;
        }
        .header {
            text-align: center;
            margin-bottom: 10px;
            border-bottom: 1px dashed #000;
            padding-bottom: 10px;
        }
        .section-title {
            font-weight: bold;
            text-transform: uppercase;
            font-size: 10px;
            margin-top: 10px;
            background: #eee;
            padding: 2px;
        }
        .info-row {
            margin: 5px 0;
        }
        .label { font-weight: bold; }
        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 10px;
            border-top: 1px dashed #000;
            padding-top: 10px;
        }
        .qr {
            margin: 10px 0;
            font-size: 9px;
        }
        .title-datos{
            text-align: center;
            font-size: 8px;


        }
    </style>
</head>
<body>
    <div class="ticket">
        <div class="header">
            <img src="{{ public_path('img/soporte-tecnico-2.png') }}" width="50" height="50" alt="Logo" style="padding: 5px">
            <h2 style="margin:0;">INTEGRAL PRO</h2>
            <p style="margin:0;">RUC: 10253624510</p>
            <p style="margin:0;">Dirección: Jirón Lima N° 159</p>
            <h2 style="margin:5px 0;">SOPORTE TÉCNICO</h2>
            <p style="margin:5px 0;">{{ $ticket->codigo_ticket }}</p>
            <p style="margin:0;">Fecha: {{ $ticket->created_at->format('d/m/Y H:i') }}</p>
        </div>

        <div class="section-title">Datos del Cliente</div>
        <div class="info-row"><span class="label">Nombre:</span> {{ $ticket->equipo->cliente->nombre }}</div>
        <div class="info-row"><span class="label">Teléfono:</span> {{ $ticket->equipo->cliente->telefono }}</div>

        <div class="section-title">Datos del Equipo</div>
        <div class="info-row"><span class="label">Equipo:</span> {{ $ticket->equipo->tipo_equipo }}</div>
        <div class="info-row"><span class="label">Marca/Mod:</span> {{ $ticket->equipo->marca }} {{ $ticket->equipo->modelo }}</div>
        <div class="info-row"><span class="label">S/N:</span> {{ $ticket->equipo->numero_serie ?? 'N/A' }}</div>

        <div class="section-title">Detalle del Ingreso</div>
        <div class="info-row"><span class="label">Problema:</span><br> {{ $ticket->problema_reportado }}</div>
        <div class="info-row"><span class="label">Accesorios:</span> {{ $ticket->accesorios ?? 'Ninguno' }}</div>
        <div class="info-row"><span class="label">Obs:</span> {{ $ticket->observaciones ?? 'Sin observaciones' }}</div>

        <div class="section-title">Detalle del Egreso</div>
        <div class="info-row"><span class="label">Fecha/Entrega:</span> {{ $ticket->fecha_entrega_estimada->format('d/m/Y H:i') }}</div>

        <div class="footer">
            {{-- <p><strong>Estado: {{ strtoupper($ticket->estado) }}</strong></p> --}}
            <p>Gracias por su confianza.<br>Conserve este ticket para retirar su equipo.</p>
            {{-- <div class="qr">
                --- Firma Cliente ---
                <br><br><br>
                _______________________
            </div> --}}
        </div>
    </div>
</body>
</html>