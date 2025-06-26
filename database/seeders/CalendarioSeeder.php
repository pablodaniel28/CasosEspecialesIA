<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Calendario; // Modelo correctamente nombrado

class CalendarioSeeder extends Seeder
{
    public function run(): void
    {
        $eventos = [
            [
                'evento' => 'Solicitudes de Casos Especiales',
                'fecha_inicio' => '2025-06-19',
                'fecha_fin' => '2025-06-22',
                'carrera_id' => 1,
            ],
            [
                'evento' => 'Aprobacion de Casos Especiales',
                'fecha_inicio' => '2025-06-19',
                'fecha_fin' => '2025-06-22',
                'carrera_id' => 1,
            ],
            [
                'evento' => 'Ejecucion de Casos Especiales',
                'fecha_inicio' => '2025-06-22',
                'fecha_fin' => '2025-06-25',
                'carrera_id' => 1,
            ],
        ];

        foreach ($eventos as $evento) {
            Calendario::create($evento);
        }
    }
}
