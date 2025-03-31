<?php

namespace App\Http\Controllers;

use App\Models\director;
use App\Models\carrera;
use Illuminate\Http\Request;

class DirectorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $directores = director::all();
        $carreras = carrera::all();
        return view('pages/director/index',compact('directores', 'carreras'));
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
        $request->validate([
            'nombre' => 'required|string|max:255',
            'codigo' => 'required|integer',
            'celular' => 'required|integer',
            'carrera_id' => 'required|exists:carreras,id',
        ]);

        Director::create([
            'nombre' => $request->nombre,
            'codigo' => $request->codigo,
            'celular' => $request->celular,
            'carrera_id' => $request->carrera_id,
        ]);

        return redirect()->back()->with('success', 'Director registrado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(director $director)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(director $director)
    {
        $carreras = Carrera::all();
        return view('pages/director/editar', compact('director', 'carreras'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, director $director)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'codigo' => 'required|integer',
            'celular' => 'required|integer',
            'carrera_id' => 'required|exists:carreras,id',
        ]);

        $director->update([
            'nombre' => $request->nombre,
            'codigo' => $request->codigo,
            'celular' => $request->celular,
            'carrera_id' => $request->carrera_id,
        ]);

        return redirect()->route('director.index')->with('success', 'Director actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(director $director)
    {
           // Eliminar la carrera
           $director->delete();

           // Redirigir al index con mensaje de éxito
           return redirect()->route('director.index')->with('success', 'Director eliminado correctamente.');
    }
}
