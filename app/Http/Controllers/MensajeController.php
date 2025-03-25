<?php

namespace App\Http\Controllers;

use App\Models\mensaje;
use Illuminate\Http\Request;

class MensajeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages/mensaje/index');
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
    public function show(mensaje $mensaje)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(mensaje $mensaje)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, mensaje $mensaje)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(mensaje $mensaje)
    {
        //
    }
}
