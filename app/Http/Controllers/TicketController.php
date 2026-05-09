<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Equipo;
use App\Models\Ticket;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class TicketController extends Controller
{
    public function index()
    {
        $tickets = Ticket::with(['equipo.cliente'])
            ->latest()
            ->paginate(10);

        return view('tickets.index', compact('tickets'));
    }

    public function create()
    {
        return view('tickets.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'documento_identidad' => 'required|string|max:20',
            'nombre' => 'required|string|max:100',
            'telefono' => 'required|string|max:20',
            'tipo_equipo' => 'required|string',
            'marca' => 'required|string',
            'modelo' => 'required|string',
            'problema_reportado' => 'required|string',
            'fecha_entrega_estimada' => 'required|after:now',
        ], [
            'fecha_entrega_estimada.after' => 'La fecha de entrega debe ser posterior a la actual.',
            'required' => 'El campo :attribute es obligatorio.'
        ]);

        return DB::transaction(function () use ($request) {
            // CORRECCIÓN: updateOrCreate asegura que si el cliente existe, actualiza sus datos
            $cliente = Cliente::updateOrCreate(
                ['documento_identidad' => $request->documento_identidad],
                ['nombre' => $request->nombre, 'telefono' => $request->telefono]
            );

            $equipo = $cliente->equipos()->create($request->only(['tipo_equipo', 'marca', 'modelo', 'numero_serie']));

            $ticket = $equipo->tickets()->create([
                'codigo_ticket' => 'TKT-' . strtoupper(bin2hex(random_bytes(3))), // Código más limpio
                'problema_reportado' => $request->problema_reportado,
                'accesorios' => $request->accesorios,
                'observaciones' => $request->observaciones,
                'fecha_entrega_estimada' => $request->fecha_entrega_estimada,
                'estado' => 'recibido'
            ]);

            return redirect()->route('tickets.index')->with('success', 'Ticket creado correctamente.');
        });
    }

    public function show($id)
    {
        $ticket = Ticket::with(['equipo.cliente'])->findOrFail($id);
        return view('tickets.show', compact('ticket'));
    }

    public function edit($id)
    {
        $ticket = Ticket::with('equipo.cliente')->findOrFail($id);
        return view('tickets.edit', compact('ticket'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'documento_identidad' => 'required|string|max:20',
            'telefono' => 'required|string|max:20',
            'estado' => 'required',
            'fecha_entrega_estimada' => 'required',
        ]);

        $ticket = Ticket::findOrFail($id);
        
        // CORRECCIÓN: Buscamos y actualizamos al cliente directamente
        $cliente = $ticket->equipo->cliente;
        $cliente->update([
            'nombre' => $request->nombre,
            'documento_identidad' => $request->documento_identidad,
            'telefono' => $request->telefono
        ]);

        // Actualizamos el ticket
        $ticket->update([
            'estado' => $request->estado,
            'fecha_entrega_estimada' => $request->fecha_entrega_estimada,
            'problema_reportado' => $request->problema_reportado ?? $ticket->problema_reportado,
            'accesorios' => $request->accesorios ?? $ticket->accesorios,
            'observaciones' => $request->observaciones ?? $ticket->observaciones,
        ]);

        return redirect()->route('tickets.index')->with('success', '¡Registro actualizado correctamente!');
    }

    public function downloadPdf($id)
    {
        $ticket = Ticket::with(['equipo.cliente'])->findOrFail($id);

        $pdf = Pdf::loadView('pdf.ticket', compact('ticket'))
            ->setPaper([0, 0, 226.77, 600], 'portrait'); 

        return $pdf->stream("ticket_{$ticket->codigo_ticket}.pdf");
    }

    public function destroy($id)
    {
        $ticket = Ticket::findOrFail($id);
        $ticket->delete();

        return redirect()->route('tickets.index')->with('success', 'Ticket eliminado correctamente');
    }
}