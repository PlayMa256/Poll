<?php

namespace Poll\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Poll\Http\Requests;
use Poll\Http\Controllers\Controller;
use Poll\Model\Resultado;
use DB;

class PainelController extends Controller
{

    public function index()
    {
        return view('painel.home');
    }
    public function exportarGet(){
        return view ('painel.exportar');
    }
    public function exportarPost(){
        $table = Resultado::all();
        $header="id_ticket, comentario, classificacao, pergunta, resposta, data\n";
        $resultados = Resultado::all();
        $resultados = DB::table('resultados')->select('*')->get();

        $content = "";
        foreach($resultados as $resultado){
            $pesquisa2 = DB::table('perguntas')->select('titulo')->where('id', '=', $resultado->id_pergunta)->get();
            foreach($pesquisa2 as $pergunta){
                $content .= $resultado->id_pesquisa.",";
                $content .= $resultado->comentario.",";
                $content .= $resultado->classificacao.",";
                $content .= $pergunta->titulo.",";
                $content .= $resultado->resposta.",";
                $content .= date("d/m/Y", strtotime($resultado->created_at))."\n";
            }
        }

        $headers = array(
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="ExportFileName.csv"',
        );

        return Response::make(rtrim($content, "\n"), 200, $headers);
    }

    public function definirDiasGet(){
        $dias = Storage::get('dias.txt');
        return view ('painel.dias')->with('dias', $dias);
    }
    public function definirDiasPost(Request $request){
        $arquivoDelete = Storage::delete('dias.txt');
        $dias = $request->input('dias');
        $inserindo = Storage::put('dias.txt', $dias);
        $arquivo = Storage::disk('local')->has('dias.txt');
        return redirect()->route('dias.get');
    }
}
