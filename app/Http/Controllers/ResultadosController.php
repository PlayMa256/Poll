<?php

namespace Poll\Http\Controllers;

use Illuminate\Http\Request;

use Poll\Http\Requests;
use Poll\Http\Controllers\Controller;
use Poll\Model\Resultado;
class ResultadosController extends Controller
{
    public function index(){
        $resultados = Resultado::all();
        return view ('painel.resultados')->with('dados',$resultados);
    }
    public function show($id){
        $resultadoEspecifico = Resultado::find($id);
        return view('resultados.show')->with('dados', $resultadoEspecifico);
    }
}
