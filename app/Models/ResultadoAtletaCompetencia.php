<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Atleta;

class ResultadoAtletaCompetencia extends Model
{
    
    protected $fillable = [
        'atleta_id', 
        'competencia_id',
        'puesto_atleta', 
        'federacion_atleta', 
        'edad_atleta', 
        'equipamiento', 
        'peso_corporal', 
        'categoria_peso', 
        'categoria_edad', 
        'tipo_competencia', 
        'squat_1', 
        'squat_2', 
        'squat_3',
        'squat_1_no_valido',
        'squat_2_no_valido',
        'squat_3_no_valido',
        'bench_press_1', 
        'bench_press_2', 
        'bench_press_3',
        'bench_press_1_no_valido',
        'bench_press_2_no_valido',
        'bench_press_3_no_valido',
        'deadlift_1', 
        'deadlift_2', 
        'deadlift_3',
        'deadlift_1_no_valido',
        'deadlift_2_no_valido',
        'deadlift_3_no_valido',
        'total', 
        'puntos_ipf', 
        'puntos_dots',
    ];

    protected $casts = [
        'squat_1_no_valido' => 'boolean',
        'squat_2_no_valido' => 'boolean',
        'squat_3_no_valido' => 'boolean',
        'bench_press_1_no_valido' => 'boolean',
        'bench_press_2_no_valido' => 'boolean',
        'bench_press_3_no_valido' => 'boolean',
        'deadlift_1_no_valido' => 'boolean',
        'deadlift_2_no_valido' => 'boolean',
        'deadlift_3_no_valido' => 'boolean',
    ];

    public function competencia(){
        return $this->belongsTo(Competencia::class, 'competencia_id');
    }
    public function atleta()
    {
        return $this->belongsTo(Atleta::class,'atleta_id');
    }
    public function levantamientos_validos(){

        if ($this->squat_1_no_valido == true and $this->squat_1 > 0){
            $this->squat_1 = -$this->squat_1;
        }
        if ($this->squat_2_no_valido == true and $this->squat_2 > 0){
            $this->squat_2 = -$this->squat_2;
        }
        if ($this->squat_3_no_valido == true and $this->squat_3 > 0){
            $this->squat_3 = -$this->squat_3;
        }
        if ($this->bench_press_1_no_valido == true and $this->bench_press_1 > 0){
            $this->bench_press_1 = -$this->bench_press_1;
        }
        if ($this->bench_press_2_no_valido == true and $this->bench_press_2 > 0){
            $this->bench_press_2 = -$this->bench_press_2;
        }
        if ($this->bench_press_3_no_valido == true and $this->bench_press_3 > 0){
            $this->bench_press_3 = -$this->bench_press_3;
        }
        if ($this->deadlift_1_no_valido == true and $this->deadlift_1 > 0){
            $this->deadlift_1 = -$this->deadlift_1;
        }
        if ($this->deadlift_2_no_valido == true and $this->deadlift_2 > 0){
            $this->deadlift_2 = -$this->deadlift_2;
        }
        if ($this->deadlift_3_no_valido == true and $this->deadlift_3 > 0){
            $this->deadlift_3 = -$this->deadlift_3;
        }
    }

    public function calcularTotal(){
        $squat = max($this->squat_1, $this->squat_2, $this->squat_3);
        $bench_press = max($this->bench_press_1, $this->bench_press_2, $this->bench_press_3);
        $deadlift = max($this->deadlift_1, $this->deadlift_2, $this->deadlift_3);
        if ($squat < 0){
            $squat = 0;
        };
        if ($bench_press < 0){
            $bench_press = 0;
        };
        if ($deadlift < 0){
            $deadlift = 0;
        };
        return $squat + $bench_press + $deadlift;
    }
    public function categoriaEdad(){
        if ($this->edad_atleta < 20) {
            return 'teen <20';
        } elseif ($this->edad_atleta >= 20 && $this->edad_atleta <= 23) {
            return 'junior 20-23';
        } elseif ($this->edad_atleta >= 24 && $this->edad_atleta <= 34) {
            return 'senior 24-34';
        } elseif ($this->edad_atleta >= 35 && $this->edad_atleta <= 39) {
            return 'submaster 35-39';
        } elseif ($this->edad_atleta >= 40 && $this->edad_atleta <= 49) {
            return 'master 40-49';
        } elseif ($this->edad_atleta >= 50 && $this->edad_atleta <= 59) {
            return 'master 50-59';
        } elseif ($this->edad_atleta >= 60) {
            return 'master 60+';
        }
        
        // En caso de que la edad no caiga en ninguna categoría (no debería ocurrir ahora)
        return null;
    }
    public function categoriaPeso(){
        $peso = $this->peso_corporal;
        
        if ($peso <= 47) {
            return '-47kg';
        } elseif ($peso <= 52) {
            return '-52kg';
        } elseif ($peso <= 57) {
            return '-57kg';
        } elseif ($peso <= 59) {
            return '-59kg';
        } elseif ($peso <= 63) {
            return '-63kg';
        } elseif ($peso <= 69) {
            return '-69kg';
        } elseif ($peso <= 76) {
            return '-76kg';
        } elseif ($peso <= 83) {
            return '-83kg';
        } elseif ($peso <= 93) {
            return '-93kg';
        } elseif ($peso <= 105) {
            return '-105kg';
        } elseif ($peso <= 115) {
            return '-115kg';
        }
        
        // En caso de que el peso no caiga en ninguna categoría
        return null;
    }

     public function calcularPuntosIPF() {
        // Coeficientes IPF GL según equipamiento
        if ($this->equipamiento == 'Raw') {
            // RAW
            if ($this->atleta->sexo == 'masculino') {
                $a = 1119.72839;
                $b = 1025.18162;
                $c = 0.00921;
            } else {
                $a = 610.32796;
                $b = 1045.59282;
                $c = 0.03048;
            }
        } else {
            // Equipado
            if ($this->atleta->sexo == 'masculino') {
                $a = 1236.25115;
                $b = 1449.21864;
                $c = 0.01644;
            } else {
                $a = 758.63878;
                $b = 949.31382;
                $c = 0.02435;
            }
        }
        
        // Cálculo del Coeficiente IPF GL
        
        $coeficienteIPF = 100 / ($a - $b * exp(-$c * $this->peso_corporal));
        
        // Cálculo final de Puntos IPF GL
        $puntosIPF = $this->total * $coeficienteIPF;

        return round($puntosIPF, 2);
    }
    
    public function calcularPuntosDOTS() {
        // Coeficientes DOTS para hombres
        $coeficientesHombres = [
            'a' => 500,
            'b' => 0.000001093,
            'c' => 0.0007391293,
            'd' => -0.1918759221,
            'e' => 24.0900756,
            'f' => -307.75076
        ];
    
        // Coeficientes DOTS para mujeres
        $coeficientesMujeres = [
            'a' => 500,
            'b' => 0.0000010706,
            'c' => 0.0005158568,
            'd' => -0.1126655495,
            'e' => 13.6175032,
            'f' => -57.96288
        ];
    
        // Selección de coeficientes según el género
        $coeficientes = ($this->atleta->sexo == 'masculino') ? $coeficientesHombres : $coeficientesMujeres;
    
        $puntosDOTS = $this->total * ($coeficientes['a'] / ($coeficientes['b'] * pow($this->peso_corporal, 4) + $coeficientes['c'] * pow($this->peso_corporal, 3) + $coeficientes['d'] * pow($this->peso_corporal, 2) + $coeficientes['e'] * $this->peso_corporal + $coeficientes['f']));
        
        return round($puntosDOTS, 2);
    }
    
    
}
