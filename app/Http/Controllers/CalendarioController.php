<?php

namespace App\Http\Controllers;

use App\Models\calendario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CalendarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Obtener el ID de la carrera del usuario autenticado
        $carreraId = auth()->user()->carrera_id;
        // Filtrar solo los calendarios de esa carrera
        $calendarios = Calendario::where('carrera_id', $carreraId)->get();

        return view('pages.calendario.index', compact('calendarios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(calendario $calendario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(calendario $calendario)
    {
        return view('pages.calendario.edit', compact('calendario'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Calendario $calendario)
    {
        $request->validate([
            'evento' => 'required|string|max:255',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
            'carrera_id' => 'required|exists:carreras,id',
        ]);

        $calendario->update($request->only('evento', 'fecha_inicio', 'fecha_fin', 'carrera_id'));

        return redirect()->route('calendario.index')->with('success', 'Calendario actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(calendario $calendario)
    {
        //
    }
}
