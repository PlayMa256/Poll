@extends('painel.master')
@section('conteudo')
    <h1>Gerenciamento de Perguntas</h1>
    @if(Session::has('sucess'))
            <div class="alert alert-success">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <p>{{$success}}</p>
            </div>
    @endif

    <div ng-controller="dialogController" class="dialogdemoBasicUsage" id="popupContainer" ng-cloak="">
        <md-button class="md-primary md-raised" ng-click="showAdvanced($event)">
            <label>Adicionar Pergunta</label>
        </md-button>
    </div>

    <table class="table table-striped" ng-controller="PerguntaController">
        <thead>
            <th>T&iacute;tulo</th>
            <th>Status</th>
            <th>Acao</th>
        </thead>
        <tbody>
            <tr ng-repeat="perg in perguntas">
                <td><% perg.titulo %></td>
                <td><% status %></td>
                <td><a href="<% perg.id %>"><% perg.titulo %></a></td>
            </tr>
        </tbody>
    </table>

    {{--@if($dados->isEmpty())--}}
        {{--<h4>Não há nenhuma pergunta Cadastrada</h4>--}}
    {{--@else--}}
        {{--<table class="table table-striped">--}}
            {{--<thead>--}}

            {{--</thead>--}}
            {{--<tbody>--}}
                {{--@foreach($dados as $dado)--}}
                {{--<tr>--}}
                    {{--<td>{{$dado->id}}</td>--}}
                    {{--<td><a href="/painel/pergunta/{{$dado->id}}/editar">{{$dado->titulo}}</a></td>--}}
                    {{--<td>montar o switch</td>--}}
                    {{--<td><a href="/painel/pergunta/{{$dado->id}}/remover"><span class="glyphicon glyphicon-trash"></span></a></td>--}}
                {{--</tr>--}}
                {{--@endforeach--}}

            {{--</tbody>--}}
        {{--</table>--}}
    {{--@endif--}}
    @stop
@section('title')
    Gerenciar Perguntas
@stop
