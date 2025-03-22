<?php

namespace App\Http\Controllers;

use App\Models\Atleta;
use App\Models\ResultadoAtletaCompetencia;
use Illuminate\Http\Request;

class AtletaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $atletas=Atleta::orderBy('nombre')->get();
        return view('atleta.index',compact('atletas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('atleta.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Atleta::create($request->all());
        return redirect()->route('atleta.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Atleta $atletum)
    {
        $atleta = $atletum;
        $resultado_atleta_competencias = ResultadoAtletaCompetencia::where('atleta_id', $atleta->id)->get();

        // Consulta para el mejor record general (basado en puntos IPF)
        $records = Atleta::with(['resultado_atleta_competencias' => function($query) {
            $query->orderBy('puntos_ipf', 'desc')
                  ->with('competencia')
                  ->limit(1);
        }])
        ->select('atletas.id')
        ->join('resultado_atleta_competencias', 'atletas.id', '=', 'resultado_atleta_competencias.atleta_id')
        ->where('atletas.id', $atleta->id)
        ->groupBy('atletas.id')
        ->orderByRaw('MAX(resultado_atleta_competencias.total) DESC')
        ->get();

        // Obtener el mejor squat (máximo entre squat_1, squat_2 y squat_3)
        $bestSquat = ResultadoAtletaCompetencia::where('atleta_id', $atleta->id)
            ->with('competencia')
            ->get()
            ->map(function ($result) {
                // Calcular el máximo squat válido
                $validSquats = [];
                if (!$result->squat_1_no_valido && $result->squat_1) $validSquats[] = $result->squat_1;
                if (!$result->squat_2_no_valido && $result->squat_2) $validSquats[] = $result->squat_2;
                if (!$result->squat_3_no_valido && $result->squat_3) $validSquats[] = $result->squat_3;
                
                $result->max_squat = !empty($validSquats) ? max($validSquats) : null;
                return $result;
            })
            ->sortByDesc('max_squat')
            ->first();

        // Obtener el mejor bench press (máximo entre bench_press_1, bench_press_2 y bench_press_3)
        $bestBench = ResultadoAtletaCompetencia::where('atleta_id', $atleta->id)
            ->with('competencia')
            ->get()
            ->map(function ($result) {
                // Calcular el máximo bench press válido
                $validBenches = [];
                if (!$result->bench_press_1_no_valido && $result->bench_press_1) $validBenches[] = $result->bench_press_1;
                if (!$result->bench_press_2_no_valido && $result->bench_press_2) $validBenches[] = $result->bench_press_2;
                if (!$result->bench_press_3_no_valido && $result->bench_press_3) $validBenches[] = $result->bench_press_3;
                
                $result->max_bench = !empty($validBenches) ? max($validBenches) : null;
                return $result;
            })
            ->sortByDesc('max_bench')
            ->first();

        // Obtener el mejor deadlift (máximo entre deadlift_1, deadlift_2 y deadlift_3)
        $bestDeadlift = ResultadoAtletaCompetencia::where('atleta_id', $atleta->id)
            ->with('competencia')
            ->get()
            ->map(function ($result) {
                // Calcular el máximo deadlift válido
                $validDeadlifts = [];
                if (!$result->deadlift_1_no_valido && $result->deadlift_1) $validDeadlifts[] = $result->deadlift_1;
                if (!$result->deadlift_2_no_valido && $result->deadlift_2) $validDeadlifts[] = $result->deadlift_2;
                if (!$result->deadlift_3_no_valido && $result->deadlift_3) $validDeadlifts[] = $result->deadlift_3;
                
                $result->max_deadlift = !empty($validDeadlifts) ? max($validDeadlifts) : null;
                return $result;
            })
            ->sortByDesc('max_deadlift')
            ->first();
            
        // Obtener el mejor total con información de competencia
        $bestTotal = ResultadoAtletaCompetencia::where('atleta_id', $atleta->id)
            ->with('competencia')
            ->orderBy('total', 'desc')
            ->first();
            
        // Obtener el mejor IPF con información de competencia
        $bestIPF = ResultadoAtletaCompetencia::where('atleta_id', $atleta->id)
            ->with('competencia')
            ->orderBy('puntos_ipf', 'desc')
            ->first();
            
        // Obtener el mejor DOTS con información de competencia
        $bestDOTS = ResultadoAtletaCompetencia::where('atleta_id', $atleta->id)
            ->with('competencia')
            ->orderBy('puntos_dots', 'desc')
            ->first();
        
        return view('atleta.show', compact(
            'resultado_atleta_competencias', 
            'atleta',
            'records',
            'bestSquat',
            'bestBench',
            'bestDeadlift',
            'bestTotal',
            'bestIPF',
            'bestDOTS'
        ));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Atleta $atletum)
    {
        $atleta=$atletum;
        return view('atleta.edit',compact('atleta'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Atleta $atletum)
    {
        $atleta=$atletum;
        $atleta->update($request->all());
        return redirect()->route('atleta.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Atleta $atletum)
    {
        $atletum->delete();
        return redirect()->route('atleta.index');
    }
}
