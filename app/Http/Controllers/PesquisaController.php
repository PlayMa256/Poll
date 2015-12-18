<?php

namespace Poll\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Input;
use Poll\Http\Requests;
use Poll\Http\Controllers\Controller;

use Poll\Model\Pergunta;
use Poll\Model\Pesquisa;
use Poll\Model\glpi_tickets;
use DB;
use Poll\Model\Resultado;
use Validator;

class PesquisaController extends Controller
{
    public function index($id)
    {
        if($this->ticketsJaCadastrado($id)) {
            $mensagem = "Pergunta já respondida";
            return view('erros')->with('pau', $mensagem);
        }
//        }else if(!$this->isFechado($id)){
//            $mensagem = "Ticket não está fechado ainda";
//          return view('erros')->with('pau', $mensagem);
//        }

        $ticket = DB::connection('mysql2')->table('glpi_tickets')->where('id', '=', $id)->get();
        Pesquisa::create(['pesquisa' => $id]);

        $perguntasAtivas = DB::table('perguntas')->where('status', '=', 1)->get();
        $tecnicos = DB::connection('mysql2')->table('glpi_users')->select('name')->whereIn('id', function($query) use($id){
            $query->select('users_id')->from('glpi_tickets_users')->where('type', '=', 2)->where('tickets_id', '=', $id);
        })->get();

        $tecnicosName = array();
        foreach($tecnicos as $tecnico){
            array_push($tecnicosName, $tecnico->name);
        }
        $var = implode(", ", array_values($tecnicosName));

        $dados = array(
            'ticket' => $ticket,
            'perguntas' => $perguntasAtivas,
            'tecnicos' => $var,
            'id' => $id
        );
        return view('pesquisaMain')->with('dados', $dados);
    }

    public function store(Request $request, $id)
    {
        $perguntas = $this->perguntaAtivas();
        $regrasCampos = array();
        $mensagensValidacao = array();
        foreach($perguntas as $pergunta){
            $mensagensValidacao['perg'.$pergunta->id.'.required'] = "A pergunta \"$pergunta->titulo\" deve ser preenchida";
            $regrasCampos['perg'.$pergunta->id] = "required";
        }

        $validator = Validator::make($request->all(), $regrasCampos, $mensagensValidacao);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }
        //cadastrar no banco
        $idsAtivos = DB::table('perguntas')->select('id')->where('status', '=', 1)->get();
        $ticket = $id;
        $comentario = $request->input('comentario');
        $classificacao = $request->input('classificacao');


        foreach($idsAtivos as $idPergunta){
            $idPerg = $idPergunta->id;
            $perg = 'perg'.$idPerg;
            $respostaPerg = $request->input($perg);
            Resultado::create([
                'id_pesquisa' => $id,
                'comentario' => $comentario,
                'classificacao' => $classificacao,
                'id_pergunta' => $idPerg,
                'resposta' => $respostaPerg,
                'referencia' => date('m-Y')
            ]);
        }
        $mensagem = "Pesquisa realizada com sucesso, Obrigado.";
        //dar load em outra view senao ele vai acusar que está respondida já.
        return redirect()->back()->with('sucesso', $mensagem);
    }
    public function perguntaAtivas(){
            return $perguntasAtivas = DB::table('perguntas')->where('status', '=', 1)->get();
    }
    public function ticketsJaCadastrado($id){
        $count = DB::table('resultados')->select('id')->where('id_pesquisa', '=', $id)->count();
        if($count > 0){
            return true;
        }
        return false;
    }
    public function isFechado($id){
        $resultado = DB::connection('mysql2')->table('glpi_tickets')->select('id')->where('status', '<>', '6')->where('id', '=', $id)->count();
        if($resultado == 0){
            return false;
        }
        return true;
    }
}
