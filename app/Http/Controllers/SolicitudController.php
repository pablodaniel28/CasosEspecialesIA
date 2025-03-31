<?php

namespace App\Http\Controllers;

use App\Models\carrera;
use App\Models\materia;
use App\Models\solicitud;
use App\Models\User;
use Illuminate\Http\Request;

class SolicitudController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $carreras = carrera::all();
        return view('pages/solicitud/index',compact('carreras'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $carreras = carrera::all();
        $solicitudes = solicitud::all();
        return view('pages/solicitud/lista',compact('carreras', 'solicitudes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // Validación
            $request->validate([
                'carrera' => 'required|exists:carreras,id',
                'materias' => 'required|array|min:1',
                'materias.*' => 'required|string',
                'grupos.*' => 'required|string',
                'siglas.*' => 'required|string',
            ]);

            // Crear la solicitud
            $solicitud = Solicitud::create([
                'codigo' => rand(10000, 99999),
                'nombre' => 'activado',
                'gestion' => now()->year,
                'estado' => 'pendiente',
                'user_id' => auth()->id(),
                'carrera_id' => $request->carrera,
            ]);

            // Registrar materias asociadas
            foreach ($request->materias as $index => $materiaNombre) {
                Materia::create([
                    'nombre' => $materiaNombre,
                    'grupo' => $request->grupos[$index],
                    'sigla' => $request->siglas[$index],
                    'solicitud_id' => $solicitud->id,
                ]);
            }

            return redirect()->route('solicitud.index')->with('success', 'Solicitud registrada correctamente.');

        } catch (\Throwable $e) {
            return redirect()->back()
            ->with('error', 'Ocurrió un error al registrar la solicitud: ' . $e->getMessage())
            ->withInput();
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(solicitud $solicitud)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(solicitud $solicitud)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, solicitud $solicitud)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(solicitud $solicitud)
    {
        //
    }
}
