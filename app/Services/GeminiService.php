<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GeminiService
{
    protected $endpoint = "https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent";

   public function responder($mensajeUsuario)
{
    $apiKey = env('GEMINI_API_KEY');

    try {
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->post($this->endpoint . "?key=" . $apiKey, [
            'contents' => [
                [
                    'parts' => [
                        ['text' => $mensajeUsuario]
                    ]
                ]
            ]
        ]);

        // Si la respuesta no es correcta, lanzar excepción genérica
        if (!$response->ok()) {
            throw new \Exception("Respuesta inválida de Gemini.");
        }

        return $response->json()['candidates'][0]['content']['parts'][0]['text'];

    } catch (\Exception $e) {
        // Logear el error exacto solo en backend
        Log::error("GeminiService error: " . $e->getMessage());

        // Devolver una respuesta genérica
        return "⚠️ El asistente está ocupado en este momento. Intenta nuevamente en unos minutos.";
    }
}

}
