<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
	{{-- <link rel="stylesheet" href="{{asset('css/bootstrap-toggle.min.css')}}" >
	 {{----}}{{--<link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}" >--}}
	<script type="text/javascript" src="{{URL::asset('assets/js/jquery-2.1.4.min.js')}}"></script>
	<script type="text/javascript" src="{{URL::asset('assets/js/bootstrap.min.js')}}"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	<link rel="stylesheet" href="{{ URL::asset('assets/css/data_tables.css') }}">
	<link rel="stylesheet" href="{{ URL::asset('assets/css/poll.css') }}">
	<style>
		.row-centered {
		    text-align:center;
		}
		.col-centered {
		    display:inline-block;
		    float:none;
		    /* reset the text-align */
		    text-align:left;
		    /* inline-block space fix */
		    margin-right:-4px;
		}
	</style>
</head>
<body>
	{{--sessao para os erros--}}
	@if(Session::has('sucesso'))
			<div class="alert alert-sucess center">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				{{ $sucesso}}
			</div>
	@endif
	@if(!$errors->isEmpty())
	<div class="alert alert-danger alertaModal">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		@foreach($errors->all() as $erro)
			<p style="font-weight: bold;">{{$erro}}</p>
		@endforeach
	</div>
	@endif

	{{--{{$errors->erro->first('perg24')}}--}}


	<div class="container">
		@foreach($dados['ticket'] as $dado)	
		<div id="infos">
			<div class="row">
				<div class="col-md-12">
					<h1><a href="http://localhost/glpi/front/ticket.form.php?id={{ $dado->id }}">Chamado {{ $dado->id }}</a></h1>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<strong>T&eacute;cnico(s):  </strong> 
					{{$dados['tecnicos']}}
				</div>
			</div>	
		</div>
		@endforeach
		
	<form action="/pesquisa/cadastrar/{{$dados['id']}}" id="formulario" method="post" class="">
		{{-- iterar por essa div --}}
		<div class="pergunta">
			<div class="row">
				<div class="col-md-12">
					<h1>Avalia&ccedil;&atilde;o</h1>	
				</div>
				
			</div>
		@foreach($dados['perguntas'] as $pergunta)
			<div class="row">
				<div class="col-md-6">
					{{$pergunta->titulo}}
				</div>
				<div class="col-md-6 pull-right">
					@for($i=0;$i<9;$i++)
						<label class="radio-inline"><input type="radio" value="{{$i}}" name="perg{{$pergunta->id}}" />{{$i}}</label>
					@endfor
				</div>
			</div>			
		@endforeach
		</div>
		<div class="comentario">
			<div class="row">
				<div class="col-md-12">
					<h1>Comentários</h1>
					
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<textarea class="form-control" name="comentario" id="" cols="30" rows="10">{{\Illuminate\Support\Facades\Input::old('comentario')}}</textarea>
				</div>
			</div>
			<div class="row row-centered">
				<div class="col-md-4 col-centered text-center">
					<div class="form-group form-inline" style="margin-top:10px;">
						<label class="control-label">Classifica&ccedil;&atilde;o</span>
						<select name="classificacao" class="form-control" id="">
							<option value="" selected="selected">Selecione um tipo</option>
							<option value="elogio">Elogio</option>
							<option value="sugestao">Sugest&atilde;o</option>
							<option value="reclamacao">Reclama&ccedil;&atilde;o</option>
						</select>		
					</div>
					
				</div>
			</div>
			<div class="row row-centered">
				<div class="col-md-12 text-center">
					<input type="hidden" name="_token" value="{{ Session::token() }}">
					<input type="submit" class="btn btn-primary" style="max-width:100px;margin-top:10px;" value="Teste" />
				</div>
			</div>
		</div>	
	</div>
</body>
</html>