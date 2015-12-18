@extends('painel.master')
@section('title')
    Gerenciar Respostas
@stop

@section('script')
<script>
    $(document).ready(function() {
        $('#minhatabela').DataTable({
            language: {
                url: '//cdn.datatables.net/plug-ins/1.10.10/i18n/Portuguese-Brasil.json'
            }
        });
    } );
</script>
@stop
@section('conteudo')
<h3>Consultar Resultados</h3>
    <table class="table table-striped" id="minhatabela">
        <thead>
            <th>Ticket</th>
            <th>A&ccedil;&atilde;o</th>
        </thead>
        @foreach($dados as $dado)
            <tr>
                <td>{{$dado->pesquisa}}</td>
                <td><a href="/painel/resultado/{{$dado->id}}"><span class="glyphicon glyphicon-search"></span></a></td>
            </tr>
        @endforeach
    </table>
@stop