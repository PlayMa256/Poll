<!doctype html>
<html lang="pt_BR" ng-app="perguntas">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script src="/node_modules/jquery/dist/jquery.min.js"></script>
    <script src="/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="{{ URL::asset('assets/js/data_tables.js')}}"></script>
    <script src="/node_modules/angular/angular.min.js"></script>
    <script src="/node_modules/angular-animate/angular-animate.min.js"></script>
    <script src="/node_modules/angular-aria/angular-aria.min.js"></script>
    <script src="/node_modules/angular-material/angular-material.min.js"></script>
    <script src="/node_modules/angular-messages/angular-messages.min.js"></script>
    {{--//verificar se é mesmo necessario.--}}
    <script src="{{URL::asset('assets/js/assets-cache.js')}}"></script>

    {{--Dependencias do sistema--}}
    <script src="{{ URL::asset('assets/js/angular/angularResources.js')}}"></script>
    <script src="{{ URL::asset('assets/js/angular/main.js')}}"></script>
    <script src="{{ URL::asset('assets/js/angular/perguntaController.js')}}"></script>
    <script src="{{ URL::asset('assets/js/angular/dialogController.js')}}"></script>
    <script src="{{ URL::asset('assets/js/angular/Resources/perguntaResource.js')}}"></script>

    {{--Stylesheets--}}
    <link rel="stylesheet" href="/node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/node_modules/angular-material/angular-material.min.css" />
    <link rel="stylesheet" href="{{ URL::asset('assets/css/data_tables.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/css/painel.css') }}" />

    @yield('script')

</head>
<body>
<div class="navbar navbar-default">
    <div class="container-fluid">
        <a href="#" class="navbar-brand">Usina Ester</a>
        <ul class="nav navbar-nav">
            <li><a href="/painel/perguntas">Perguntas</a></li>
            <li>
                <a href="/painel/respostas">Respostas</a>
            </li>
            <li><a href="/painel/exportar">Exportar Dados</a></li>
            <li><a href="/painel/dias">Definir dias</a></li>
        </ul>
    </div>
</div>
<div class="content-fluid conteudo">
    @yield('conteudo')
</div>
</body>
</html>