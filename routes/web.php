<?php


use App\Http\Controllers\TicketController;
use Illuminate\Support\Facades\Route;

// Ruta para ver el formulario de ingreso
Route::get('/tickets/crear', [TicketController::class, 'create'])->name('tickets.create');

// Ruta para procesar el formulario y guardar
Route::post('/tickets', [TicketController::class, 'store'])->name('tickets.store');

// Ruta para ver el ticket generado (y luego imprimirlo)
Route::get('/tickets/{id}', [TicketController::class, 'show'])->name('tickets.show');

// Ruta para generar el PDF (usando la librería DomPDF)
Route::get('/tickets/{id}/pdf', [TicketController::class, 'downloadPdf'])->name('tickets.pdf');

Route::get('/tickets', [TicketController::class, 'index'])->name('tickets.index');

Route::delete('/tickets/{id}', [TicketController::class, 'destroy'])->name('tickets.destroy');

// La ruta de editar la definiremos cuando crees el formulario de edición
Route::get('/tickets/{id}/edit', [TicketController::class, 'edit'])->name('tickets.edit');

// Ruta para procesar la actualización de los datos (la que te faltaba)
Route::put('/tickets/{id}', [TicketController::class, 'update'])->name('tickets.update');