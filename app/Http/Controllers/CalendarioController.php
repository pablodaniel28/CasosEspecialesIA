<?php

namespace App\Http\Controllers;

use App\Models\calendario;
use Illuminate\Http\Request;

class CalendarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages/calendario/index');
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
    public function show(calendario $calendario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(calendario $calendario)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, calendario $calendario)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(calendario $calendario)
    {
        //
    }
}
