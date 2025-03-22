<?php

namespace App\Http\Controllers;

use App\Models\Atleta;
use App\Models\Competencia;
use App\Models\ResultadoAtletaCompetencia;
use Illuminate\Http\Request;

class CompetenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        $competencias = Competencia::all();
        return view('competencia.index', compact('competencias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       return view('competencia.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        Competencia::create($request->all());

        return redirect()->route('competencia.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Competencia $competencium)
    {
        // Obtener todos los resultados de atletas para esta competencia
        $resultados = ResultadoAtletaCompetencia::where('competencia_id', $competencium->id)
            ->with('atleta')
            ->orderBy('puesto_atleta')
            ->orderBy('puntos_ipf', 'desc')
            ->get();

        return view('competencia.show', compact('competencium', 'resultados'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Competencia $competencium)
    {
        return view('competencia.edit', compact('competencium'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Competencia $competencium)
    {

        $competencium->update($request->all());

        return redirect()->route('competencia.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Competencia $competencium)
    {  
        $competencium->delete();
        
        return redirect()->route('competencia.index');
    }

}
