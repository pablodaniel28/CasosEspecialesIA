<?php

namespace App\Http\Controllers;

use App\Models\proceso;
use App\Models\solicitud;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProcesoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index()
    {
        $user = Auth::user();
        $solicitudes = Solicitud::where('user_id', $user->id)->get();

        return view('pages.proceso.index', compact('solicitudes'));
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
    public function show(proceso $proceso)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(proceso $proceso)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, proceso $proceso)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(proceso $proceso)
    {
        //
    }
}
