<?php

namespace App\Http\Controllers;

use App\Models\especiales;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class EspecialesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function boleta($registro)
    {
        try {
            $token = config('services.uagrm.token');
            $baseUrl = config('services.uagrm.base_url');

            // Paso 1: Obtener las materias del estudiante
            $response = Http::withToken($token)->get("$baseUrl/students/boleta/$registro");

            if (!$response->successful()) {
                return redirect()->back()->with('error', 'No se pudo obtener la boleta del sistema externo. Código: ' . $response->status());
            }

            $data = $response->json(); // array de materias

            // Paso 2: Por cada materia, obtener el horario del grupo y sigla
            foreach ($data as &$item) {
                $team = $item['team']['name'];
                $sigla = $item['team']['subject']['sigla'];

                $horarioResponse = Http::withToken($token)->get("$baseUrl/team/$team/subject/$sigla/horario");

                if ($horarioResponse->successful()) {
                    $item['horario'] = $horarioResponse->json(); // Agrega el array de horarios
                } else {
                    $item['horario'] = []; // En caso de fallo, vacío
                }
            }

            return view('pages.especiales.boleta', compact('data', 'registro'));
        } catch (\Throwable $e) {
            Log::error('Error al obtener boleta: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Ocurrió un error inesperado al generar la boleta.');
        }
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
    public function show(especiales $especiales)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(especiales $especiales)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, especiales $especiales)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(especiales $especiales)
    {
        //
    }
}
