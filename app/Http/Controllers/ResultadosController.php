<?php

namespace Poll\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Poll\Http\Requests;
use Poll\Http\Controllers\Controller;
use Poll\Model\Pergunta;
use Poll\Model\Pesquisa;
use Poll\Model\Resultado;
class ResultadosController extends Controller
{
    public function index(){
        $pesquisas = Pesquisa::all();
        return view ('painel.resultados')->with('dados',$pesquisas);
    }
    public function show($id){
        $ticketId = Pesquisa::find($id)->pesquisa;
        $perguntasName = array();
        $results = array();
        $resultados = DB::table('resultados')->select('*')->where('id_pesquisa', '=', $ticketId)->get();
        foreach($resultados as $resultado){
            $perguntaID = $resultado->id_pergunta;
            $pergunta = Pergunta::find($perguntaID);
            $perguntaTitulo = $pergunta->titulo;
            $perguntasName[$perguntaID] = $perguntaTitulo;

            $results['id'] = $resultado->id;
            $results['id_pesquisa'] = $resultado->id_pesquisa;
            $results['comentario'] = $resultado->comentario;
            $results['classificacao'] = $resultado->classificacao;
            $results['respostas'] = array();
            $results['respostas'][$perguntaID] = $resultado->resposta;

        }
        $dados = array(
            'perguntasName' => $perguntasName,
            'resultados' => $results
        );

        return view('painel.resultados.show')->with('dados', $dados);
    }
}
