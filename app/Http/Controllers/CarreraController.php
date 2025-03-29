<?php

namespace App\Http\Controllers;

use App\Models\carrera;
use Illuminate\Http\Request;

class CarreraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $carreras = Carrera::all();

        return view('pages/carrera/index', compact('carreras'));
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
        // Validar los datos
        $request->validate([
            'nombre' => 'required|string|max:255',
            'codigo' => 'required|string|max:100|unique:carreras,codigo',
        ]);

        // Crear y guardar la carrera
        $carrera = new Carrera();
        $carrera->nombre = $request->input('nombre');
        $carrera->codigo = $request->input('codigo');
        $carrera->save();

        // Redirigir o responder con éxito
        return redirect()->back()->with('success', 'Carrera guardada correctamente.');
    }


    /**
     * Display the specified resource.
     */
    public function show(carrera $carrera)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Carrera $carrera)
    {
        return view('pages/carrera/editar', compact('carrera'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Carrera $carrera)
    {
        // Validar los datos
        $request->validate([
            'nombre' => 'required|string|max:255',
            'codigo' => 'required|string|max:100|unique:carreras,codigo,' . $carrera->id,
        ]);

        // Actualizar la carrera
        $carrera->update([
            'nombre' => $request->input('nombre'),
            'codigo' => $request->input('codigo'),
        ]);

        // Redirigir con mensaje de éxito
        return redirect()->route('carrera.index')->with('success', 'Carrera actualizada correctamente.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Carrera $carrera)
    {
        // Eliminar la carrera
        $carrera->delete();

        // Redirigir al index con mensaje de éxito
        return redirect()->route('carrera.index')->with('success', 'Carrera eliminada correctamente.');
    }

}
