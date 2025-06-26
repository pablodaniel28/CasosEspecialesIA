<?php

namespace App\Http\Controllers;

use App\Models\AsistenteDato;
use App\Services\GeminiService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AsistenteController extends Controller
{
    public function index()
    {
        return view('pages/asistente/index');
    }

    private function obtenerPromptPorTipo(string $tipo): string
    {
        $ruta = resource_path('prompts/prompt-config.json');

        if (!file_exists($ruta)) {
            return "⚠️ Archivo de configuración no encontrado.";
        }

        $json = json_decode(file_get_contents($ruta), true);

        return $json[$tipo] ?? $json['general'];
    }

    private function detectarTipo(string $texto): string
    {
        $texto = strtolower($texto);

        return match (true) {
            str_contains($texto, 'daniel castedo') => 'daniel castedo', // en minúsculas
            str_contains($texto, 'casos especiales') || str_contains($texto, 'caso especial') => 'casos especiales',
            default => 'general',
        };
    }


    public function preguntar(Request $request, GeminiService $gemini)
    {
        $pregunta = strtolower($request->input('pregunta'));
        $ruta = resource_path('prompts/prompt-config.json');

        if (!file_exists($ruta)) {
            return response()->json(['respuesta' => '⚠️ No se encontró la configuración de prompts.']);
        }

        $json = json_decode(file_get_contents($ruta), true);

        // Autocorrector inteligente
        $tipoDetectado = 'general';
        foreach ($json['conocimientos']['autocorrector']['casos especiales'] as $error) {
            if (str_contains($pregunta, $error)) {
                $tipoDetectado = 'casos especiales';
                break;
            }
        }
        if (str_contains($pregunta, 'daniel castedo')) {
            $tipoDetectado = 'daniel castedo';
        }

        // Construir prompt unificado
        $prompt = $json['contexto_base'] . "\n\n";
        foreach (['casos especiales', 'daniel castedo', 'general', 'laura'] as $tema) {
            $prompt .= "📚 $tema:\n" . $json['conocimientos'][$tema] . "\n\n";
        }
        $prompt .= "Usuario: $pregunta";

        try {
            $respuesta = $gemini->responder($prompt);
            return response()->json(['respuesta' => $respuesta]);
        } catch (\Exception $e) {
            Log::error("Error consultando Gemini: " . $e->getMessage());
            return response()->json(['respuesta' => '⚠️ El asistente está ocupado en este momento. Intenta nuevamente en unos minutos.']);
        }
    }







    // Métodos REST vacíos del resource
    public function create() {}
    public function store(Request $request) {}
    public function show() {}
    public function edit() {}
    public function update(Request $request) {}
    public function destroy() {}
}
