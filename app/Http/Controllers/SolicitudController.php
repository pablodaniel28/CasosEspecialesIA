<?php

namespace App\Http\Controllers;

use App\Models\Carrera;
use App\Models\Materia;
use App\Models\Solicitud;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

use App\Models\Calendario;

class SolicitudController extends Controller
{
    /**
     * Listado de solicitudes para la carrera del usuario autenticado.
     */
    public function index()
    {
        // Obtén el usuario autenticado y su carrera
        $usuario = auth()->user();
        $carrera = $usuario->carrera;
        $carreraUsuario = auth()->user()->carrera;

        // Busca el evento específico de la carrera
        $evento = Calendario::where([
            ['carrera_id', $carrera->id],
            ['evento', 'Solicitudes de Casos Especiales'],
        ])->first();

        // ¿Está dentro del periodo permitido?
        $hoy = now()->toDateString();
        $fechaInicio = \Carbon\Carbon::parse($evento->fecha_inicio)->toDateString();
        $fechaFin = \Carbon\Carbon::parse($evento->fecha_fin)->toDateString();

        $disponible = $evento && ($hoy >= $fechaInicio && $hoy <= $fechaFin);
        // Retorna la vista correspondiente
        if (!$disponible) {
            return view('pages.solicitud.nodisponible', compact('evento'));
        }

        return view('pages.solicitud.index', compact('carreraUsuario'));
    }

    /**
     * Marcar solicitud como aprobada.
     */
    public function aprobar($id)
    {
        return $this->cambiarEstado($id, 'Aprobado', 'Solicitud aprobada correctamente.');
    }

    /**
     * Marcar solicitud como pendiente.
     */
    public function pendiente($id)
    {
        return $this->cambiarEstado($id, 'Pendiente', 'Solicitud marcada como pendiente.');
    }

    /**
     * Marcar solicitud como observada.
     */
    public function observar($id)
    {
        return $this->cambiarEstado($id, 'Observado', 'Solicitud observada correctamente.');
    }

    /**
     * Cambia el estado de la solicitud.
     */
    protected function cambiarEstado($id, $estado, $mensaje)
    {
        $solicitud = Solicitud::findOrFail($id);
        $solicitud->estado = $estado;
        $solicitud->save();

        return redirect()->back()->with('success', $mensaje);
    }

    /**
     * Muestra el formulario de lista de solicitudes.
     */
    public function create()
    {
        $carreras = Carrera::all();
        $solicitudes = Solicitud::all();
        return view('pages.solicitud.lista', compact('carreras', 'solicitudes'));
    }

    /**
     * Verifica materia, grupo y sigla contra el listado de materias válidas.
     * Si el grupo y la sigla coinciden pero el nombre no, sugiere el nombre correcto.
     */
    private function verificarMateriaGrupoSigla($nombreMateria, $grupo, $sigla, $materiasValidas)
    {
        // Normalizar entradas
        $nombreMateria = strtolower(trim($nombreMateria));
        $grupo         = strtolower(trim($grupo));
        $sigla         = strtolower(trim($sigla));

        // 1. Verificación exacta
        foreach ($materiasValidas as $item) {
            if (
                strtolower($item['subjectName']) === $nombreMateria &&
                strtolower($item['teamName']) === $grupo &&
                strtolower($item['subjectSigla']) === $sigla
            ) {
                return ['valido' => true, 'error' => null, 'sugerencia' => null];
            }
        }

        // 2. Verificación: grupo y sigla existen juntos, pero nombre de materia está mal
        foreach ($materiasValidas as $item) {
            if (
                strtolower($item['teamName']) === $grupo &&
                strtolower($item['subjectSigla']) === $sigla
            ) {
                // ¡Encontrado! Sugiere el nombre correcto
                return [
                    'valido' => false,
                    'error' => "El nombre de la materia no coincide.",
                    'sugerencia' => "Para el grupo <b>{$grupo}</b> y sigla <b>{$sigla}</b>, el nombre correcto es: <b>{$item['subjectName']}</b>."
                ];
            }
        }

        // 3. Si no existe ninguna coincidencia
        return [
            'valido' => false,
            'error' => "No existe ninguna materia con ese grupo y sigla en tu carrera.",
            'sugerencia' => null
        ];
    }

    /**
     * Registra una solicitud nueva validando materias contra la API.
     */
    public function store(Request $request)
    {
        $request->validate([
            'carrera'      => 'required|exists:carreras,id',
            'materias'     => 'required|array|min:1',
            'materias.*'   => 'required|string',
            'grupos.*'     => 'required|string',
            'siglas.*'     => 'required|string',
        ]);

        $carrera_id = $request->carrera;
        $materias   = $request->materias;
        $grupos     = $request->grupos;
        $siglas     = $request->siglas;

        // Configuración API
        $token   = config('services.uagrm.token');
        $baseUrl = rtrim(config('services.uagrm.base_url'), '/');

        try {
            $response = \Illuminate\Support\Facades\Http::withToken($token)
                ->acceptJson()
                ->get("$baseUrl/obtenergrupocarrera/$carrera_id");
        } catch (\Exception $e) {
            return back()->with('error', 'No se pudo conectar con el servidor de materias.')->withInput();
        }

        if (!$response->successful() || empty($response->json())) {
            return back()->with('error', 'No se pudo validar las materias con la carrera.')->withInput();
        }

        $materiasValidas = $response->json();
        $errores = [];
        $sugerencias = [];

        foreach ($materias as $i => $nombreMateria) {
            $sigla = $siglas[$i] ?? null;
            $grupo = $grupos[$i] ?? null;

            $verificacion = $this->verificarMateriaGrupoSigla($nombreMateria, $grupo, $sigla, $materiasValidas);

            if (!$verificacion['valido']) {
                if ($verificacion['sugerencia']) {
                    $errores[] = "La materia '{$nombreMateria}' no coincide. {$verificacion['sugerencia']}";
                } else {
                    $errores[] = "La materia '{$nombreMateria}' con grupo '{$grupo}' y sigla '{$sigla}' no existe en tu carrera.";
                }
            }
        }

        if ($errores) {
            return back()->with('error', implode('<br>', $errores))->withInput();
        }

        // Crear la solicitud
        $solicitud = \App\Models\Solicitud::create([
            'codigo'      => rand(10000, 99999),
            'nombre'      => 'activado',
            'gestion'     => now()->year,
            'estado'      => 'pendiente',
            'user_id'     => auth()->id(),
            'carrera_id'  => $carrera_id,
        ]);

        // Registrar materias asociadas EN MAYÚSCULA
        foreach ($materias as $i => $nombreMateria) {
            \App\Models\Materia::create([
                'nombre'        => mb_strtoupper($nombreMateria, 'UTF-8'),
                'grupo'         => mb_strtoupper($grupos[$i], 'UTF-8'),
                'sigla'         => mb_strtoupper($siglas[$i], 'UTF-8'),
                'solicitud_id'  => $solicitud->id,
            ]);
        }

        return redirect()->route('solicitud.index')->with('success', 'Solicitud registrada correctamente.');
    }

    // Métodos show, edit, update, destroy pueden implementarse según necesidad
    public function show(Solicitud $solicitud) {}
    public function edit(Solicitud $solicitud) {}
    public function update(Request $request, Solicitud $solicitud) {}
    public function destroy(Solicitud $solicitud) {}
}
