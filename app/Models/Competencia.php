<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Competencia extends Model
{
    protected $fillable = [
        'nombre_competencia',  
        'federacion', 
        'fecha', 
        'lugar_competencia', 
    ];
    
    public function resultado_atleta_competencias()
    {
        return $this->hasMany(ResultadoAtletaCompetencia::class, 'competencia_id');
    }
}
