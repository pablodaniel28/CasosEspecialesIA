<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UsuariosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('usuarios.index', compact('users')); // Pasar la variable a la vista
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
    public function show(User $usuarios)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $usuarios)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $usuarios)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Buscar al usuario por ID
        $user = User::find($id);

        if (!$user) {
            return redirect()->route('usuarios.index')->with('error', 'Usuario no encontrado.');
        }

        // Eliminar usuario
        $user->delete();

        // Redirigir con mensaje de éxito
        return redirect()->route('usuarios.index')->with('success', 'Usuario eliminado correctamente.');
    }

}
