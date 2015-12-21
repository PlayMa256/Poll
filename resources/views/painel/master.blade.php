<!doctype html>
<html lang="pt_BR" ng-app="perguntas">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/css/bootstrap.min.css') }}">
    <script src="{{ URL::asset('assets/js/jquery-2.1.4.min.js')}}"></script>
    <script src="{{ URL::asset('assets/js/bootstrap.min.js')}}"></script>
    <script src="{{ URL::asset('assets/js/bootstrap-toggle.min.js')}}"></script>
    <script src="{{ URL::asset('assets/js/data_tables.js')}}"></script>
    <link rel="stylesheet" href="{{ URL::asset('assets/css/data_tables.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/css/bootstrap-toggle.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/css/painel.css') }}" />


    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular-animate.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular-aria.min.js"></script>
    <script src="https://cdn.gitcdn.xyz/cdn/angular/bower-material/v1.0.0/angular-material.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular-messages.min.js"></script>
    <script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/t-114/assets-cache.js"></script>



    




    <script src="{{ URL::asset('assets/js/angular/angularResources.js')}}"></script>
    <script src="{{ URL::asset('assets/js/angular/main.js')}}"></script>
    <script src="{{ URL::asset('assets/js/angular/perguntaController.js')}}"></script>
    <script src="{{ URL::asset('assets/js/angular/dialogController.js')}}"></script>
    <script src="{{ URL::asset('assets/js/angular/Resources/perguntaResource.js')}}"></script>

    <link rel="stylesheet" href="https://cdn.gitcdn.xyz/cdn/angular/bower-material/v1.0.0/angular-material.css">
    <style type="text/css">
        .dialogdemoBasicUsage #popupContainer {
            position: relative; }
        label{
            font-size:13px;
        }
        .md-button{
            min-height:20px;
            line-height:0;
        }

    </style>
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