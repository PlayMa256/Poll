<?php

namespace Poll\Model;

use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    public function Resultados(){
        return $this->belongsToMany('Resultado');
    }
}
