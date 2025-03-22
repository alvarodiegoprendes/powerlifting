<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Atleta extends Model
{
    public function competencias(){
        return $this->hasMany(Competencia::class);
    }
    public function resultado_atleta_competencias(){
        return $this->hasMany(ResultadoAtletaCompetencia::class);
    }
    protected $fillable=['nombre','pais','sexo','fecha_nacimiento','altura'];
}
