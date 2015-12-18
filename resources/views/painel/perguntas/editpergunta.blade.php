@extends('painel.master')
@section('title')
    Editar Pergunta
@stop
@section('conteudo')
    {!!  Form::model($pergunta, ['route' => ['pergunta.editar', $pergunta->id], 'method' => 'put'])!!}
        <div class="form-group">
            {!!Form::label('titulo', 'Titulo', array('class' => ''))!!}
            {!! Form::text('titulo', Input::old('titulo')) !!}
        </div>
        <div class="form-group">
            @if($pergunta->status == 1)
                {!!Form::label('status', 'Ativado', array('class' => ''))!!}
                <input type="radio" name="status" value="1" checked />

                {!!Form::label('status', 'Desativado', array('class' => ''))!!}
                <input type="radio" name="status" value="0"/>
            @elseif($pergunta->status == 0)
                {!!Form::label('status', 'Ativado', array('class' => ''))!!}
                {!! Form::checkbox('status[]', 1, false) !!}

                {!!Form::label('status', 'Desativado', array('class' => ''))!!}
                {!! Form::checkbox('status[]', 0, true) !!}
            @endif
        </div>
    {!!Form::submit('Editar')!!}
    {!! Form::close() !!}
@stop