@extends('painel.master')
@section('conteudo')
    <h1>Gerenciamento de Perguntas</h1>
    @if(Session::has('success'))
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
                <td><a href="/painel/pergunta/<%perg.id%>/editar/"><% perg.titulo %></a></td>
                <td><md-switch ng-model="perg.status" class="md-primary" ng-change="onChange(perg.id)"></md-switch></td>
                <td><a href="/painel/pergunta/<% perg.id %>/remover" class="glyphicon glyphicon-trash "></a></td>
            </tr>
            </tbody>
        </table>
    @stop
@section('title')
    Gerenciar Perguntas
@stop
