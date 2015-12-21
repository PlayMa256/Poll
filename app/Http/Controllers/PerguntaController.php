<?php

namespace Poll\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Input;
use Poll\Http\Requests;
use Poll\Http\Controllers\Controller;
use Poll\Model\Pergunta;

class PerguntaController extends Controller
{
    //funcao especifica para retornar o token
    public function token(){
        return csrf_token();
    }
    public function perguntasGet(){
        return view ('painel.perguntas');
    }
    public function perguntasJson(){
        $perguntas = Pergunta::all();
        return response()->json($perguntas);
    }

    public function show($id)
    {
        $pergunta = Pergunta::find($id);
        return view('perguntas.show')->with('conteudo', $pergunta);
    }

    public function store(Request $request){
        Pergunta::create($request->all());
        return response()->json(array("created" => 'true'), 200);

    }

    public function create()
    {
        return view('perguntas.criarPergunta');
    }

    //metodo para realizar o put do update.
    public function editar(Request $request, $id)
    {
        $pergunta = Pergunta::find($id);
        $edicao = $pergunta->fill($request->all())->save();
        if($edicao){
            $mensagem = "Pergunta Editada com sucesso";
            return redirect()->route('perguntas.main')->with('sucess', $mensagem);
        }else {
            $mensagem = "Problema ao Editar pergunta";
            return redirect()->route('perguntas.main')->with('erro', $mensagem);
        }
    }

    public function editarStatus($id){
        $pergunta = Pergunta::find($id);
        $pergunta->status = !$pergunta->status;
        $pergunta->save();
        return response()->json("ok");
    }

    //chamada apenas para a view.
    public function edit($id)
    {
        $pergunta = Pergunta::find($id);
        return view('painel.perguntas.editpergunta')->with('pergunta', $pergunta);
    }

    public function destroy($id)
    {
        $pergunta = Pergunta::find($id);
        $pergunta->delete();
        $mensagem = "Pergunta apagada com sucesso";
        return redirect('/painel/perguntas')->with('success', $mensagem);
    }
}
