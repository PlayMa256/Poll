<?php

namespace Poll\Model;

use Illuminate\Database\Eloquent\Model;

class Resultado extends Model
{
	protected $fillable = ['id_pesquisa', 'comentario', 'classificacao', 'id_pergunta', 'resposta', 'referencia'];
    public function Pesquisa(){
    	return $this->hasMany('Poll\Model\Pesquisa');
    }
    public function Pergunta (){
    	return $this->hasMany('Poll\Model\Pergunta');
    }
}
