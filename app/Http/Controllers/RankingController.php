<?php

namespace App\Http\Controllers;

use App\Models\Atleta;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;

class RankingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request['search']; 
        $sexo = $request['sexo'];
        
        // Consulta base
        $query = Atleta::with(['resultado_atleta_competencias' => function($query) {
            $query->orderBy('puntos_ipf', 'desc')
                  ->with('competencia')
                  ->limit(1);
        }])
        ->select('atletas.*')
        ->join('resultado_atleta_competencias', 'atletas.id', '=', 'resultado_atleta_competencias.atleta_id')
        ->groupBy('atletas.id');
        
        // Aplicar filtro de búsqueda por nombre si existe
        if ($search) {
            $query->whereRaw('LOWER(atletas.nombre) LIKE ?', ['%' . strtolower($search) . '%']);
        }
        
        // Aplicar filtro por sexo si existe
        if ($sexo) {
            $query->where('atletas.sexo', $sexo);
        }
        
        // Ordenar resultados
        $ranking = $query->orderByRaw('MAX(resultado_atleta_competencias.total) DESC')->get();

        return view('ranking.index', compact('ranking', 'search', 'sexo'));
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
