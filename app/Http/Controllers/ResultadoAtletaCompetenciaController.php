<?php

namespace App\Http\Controllers;

use App\Models\ResultadoAtletaCompetencia;
use Illuminate\Http\Request;
use App\Models\Atleta;
use App\Models\Competencia;

class ResultadoAtletaCompetenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        $competencias=Competencia::orderBy('puntos_ipf')->get();
        $atleta=Atleta::all();
        return view('resultadoatletacompetencia.index',compact('competencias','atleta'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function create_parametrizada(Atleta $atleta)
    {

        $competencias = Competencia::orderBy('nombre_competencia')->get();
        return view('resultadoatletacompetencia.create', compact('atleta', 'competencias'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    public function store_parametrizada(Request $request, $atleta)
    {
        $atleta_encontrado = Atleta::find($atleta);
        $competencia_encontrada = Competencia::find($request->competencia_id);
        
        // Crear primero la competencia
        $resultado_atleta_competencia = new ResultadoAtletaCompetencia($request->all());
        $resultado_atleta_competencia->levantamientos_validos();
        $resultado_atleta_competencia->atleta_id = $atleta_encontrado->id;
        $resultado_atleta_competencia->competencia_id = $competencia_encontrada->id;
        $resultado_atleta_competencia->categoria_edad = $resultado_atleta_competencia->categoriaEdad();
        $resultado_atleta_competencia->total = $resultado_atleta_competencia->calcularTotal();
        $resultado_atleta_competencia->categoria_peso = $resultado_atleta_competencia->categoriaPeso();
        $resultado_atleta_competencia->puntos_ipf = $resultado_atleta_competencia->calcularPuntosIPF();
        $resultado_atleta_competencia->puntos_dots = $resultado_atleta_competencia->calcularPuntosDOTS();
        $resultado_atleta_competencia->save();
        
        return redirect()->route('atleta.show', $atleta);
    }
    /**
     * Display the specified resource.
     */
    public function show(ResultadoAtletaCompetencia $resultadoAtletaCompetencia)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($resultadoAtletaCompetencia)
    {
        // Si recibimos un ID en lugar del objeto, buscamos el modelo
    
        $resultadoAtletaCompetencia = ResultadoAtletaCompetencia::find($resultadoAtletaCompetencia);
        $resultado_atleta_competencias = $resultadoAtletaCompetencia;       
        $competencias = Competencia::orderBy('nombre_competencia')->get();
        $atleta = $resultadoAtletaCompetencia->atleta;

        return view('resultadoatletacompetencia.edit',compact('resultado_atleta_competencias','atleta', 'competencias'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$resultadoAtletaCompetencia)
    {
        $resultadoAtletaCompetencia = ResultadoAtletaCompetencia::find($resultadoAtletaCompetencia);
        $resultado_atleta_competencia = $resultadoAtletaCompetencia;   
        $resultado_atleta_competencia->fill($request->all()); 
        $resultado_atleta_competencia->levantamientos_validos();
        $resultado_atleta_competencia->categoria_edad = $resultado_atleta_competencia->categoriaEdad();
        $resultado_atleta_competencia->total = $resultado_atleta_competencia->calcularTotal();
        $resultado_atleta_competencia->categoria_peso = $resultado_atleta_competencia->categoriaPeso();
        $resultado_atleta_competencia->puntos_ipf = $resultado_atleta_competencia->calcularPuntosIPF();
        $resultado_atleta_competencia->puntos_dots = $resultado_atleta_competencia->calcularPuntosDOTS();
        $resultado_atleta_competencia->save();
        
        return redirect()->route('atleta.show', ['atletum' => $resultado_atleta_competencia->atleta_id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ResultadoAtletaCompetencia $resultadoAtletaCompetencia)
    {
        //
    }
    public function destroy_parametrizada(ResultadoAtletaCompetencia $resultadoAtletaCompetencia,$atleta)
    {
        $resultadoAtletaCompetencia->delete();
        return redirect()->route('atleta.show', $atleta);
    }
}
