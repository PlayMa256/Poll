<?php

namespace Poll\Model;

use Illuminate\Database\Eloquent\Model;

class Pesquisa extends Model
{
    protected $fillable = array('pesquisa');
    public function Resultado(){
        return $this->belongsToMany('Poll\Model\Resultado');
    }

}