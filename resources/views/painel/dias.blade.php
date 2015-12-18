@extends('painel.master')
@section('title')
    Definir Dias
    @stop
@section('conteudo')
    <h3>Quantidade de dias Definidos: {{$dias}}</h3>
    <form action="/painel/dias" method="post">
        <label for="">
            <span>Definir dias: </span>
            <input type="text" name="dias" />
        </label>
        <input type="submit" value="Salvar" />
        <input type="hidden" value="{{ csrf_token()  }}" name="_token" />
    </form>
    @stop