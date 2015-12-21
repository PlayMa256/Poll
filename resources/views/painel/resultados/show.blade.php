@extends ('painel.master')
@section('conteudo')
    <table class="table table-stripped">
        <thead>
            <tr>
                <th>Numero do Ticket</th>
                @foreach($dados['perguntasName'] as $pergunta)
                    <th>{{$pergunta}}</th>
                @endforeach
                <th>Comentario</th>
                <th>Classifica&ccedil;&atilde;o</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                    <td>{{$dados['resultados']['id_pesquisa']}}</td>
                    <td>{{$dados['resultados']['comentario']}}</td>
                    <td>{{$dados['resultados']['classificacao']}}</td>
                    @foreach($dados['resultados']['respostas'] as $resposta)
                            <td>{{$resposta}}</td>
                        @endforeach
            </tr>
        </tbody>
    </table>
@stop
@section('title')
    Ver Resultado
@stop