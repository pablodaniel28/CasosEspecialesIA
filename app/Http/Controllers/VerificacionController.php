<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\verificacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class VerificacionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages/verificacion/index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages/verificacion/registrar');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'registro' => 'required|digits:9',
            'password' => 'required|string|min:6|max:12',
        ]);

        $reg = $request->input('registro');
        $password = $request->input('password');
        $url = "https://caja.uagrm.edu.bo/listado.aspx?idper={$reg}&tipoper=1&sem=&anio=";

        try {
            $response = Http::get($url);

            if ($response->successful()) {
                if (strpos($response->body(), 'NO EXISTE PERSONA') !== false) {
                    return redirect()->route('verificar.index')->with('error', 'La persona con el registro proporcionado no existe');
                } else {
                    $nombre = $this->extractNombreFromHtml($response->body());

                    if (!$nombre) {
                        return redirect()->route('verificar.index')->with('error', 'No se pudo obtener el nombre de la persona');
                    }

                    // Buscar usuario en la base de datos
                    $user = User::where('registro', $reg)->first();

                    if ($user) {
                        // Verificar la contraseña antes de iniciar sesión
                        if (!Hash::check($password, $user->password)) {
                            return redirect()->route('verificacion.create')->with('error', 'Contraseña incorrecta');
                        }
                    } else {
                        // Si el usuario no existe, crearlo con la contraseña ingresada
                        $user = new User();
                        $user->registro = $reg;
                        $user->password = Hash::make($password); // Encriptar el password
                        $user->name = $nombre;
                        $user->save();
                    }

                    // Iniciar sesión en Laravel
                    Auth::login($user);
                    return redirect()->route('dashboard')->with('success', 'Inicio de sesión exitoso');
                }
            } else {
                return redirect()->route('verificacion.create')->with('error', 'Error: No se pudo conectar al servidor');
            }
        } catch (\Exception $e) {
            return redirect()->route('verificacion.create')->with('error', 'Error de conexión');
        }
    }

    // Function to extract nombre from HTML using regex or DOM parsing
    private function extractNombreFromHtml($html)
    {
        // Example regex pattern to match the Nombre line in the HTML
        preg_match('/<span id="lNombre".*?>(.*?)<\/span>/', $html, $matches);

        if (isset($matches[1])) {
            return trim($matches[1]);
        }

        return null;
    }

    /**
     * Display the specified resource.
     */
    public function show(verificacion $verificacion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(verificacion $verificacion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, verificacion $verificacion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(verificacion $verificacion)
    {
        //
    }
}
