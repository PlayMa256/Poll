(function(){
    var app = angular.module('perguntas')
        .controller('PerguntaController',['$scope', '$http', '$resource', function($scope, $http, $resource){
            $scope.pergunta = {};
            $scope.perguntas = [];

            var recurseGET = $resource('/painel/perguntas/json');
            $scope.perguntas = recurseGET.query(function(dados){
                return dados;
            }, function(erro){
                console.log(erro);
            });
            $scope.$on('adicionadoPergunta', function(event, args){
                var lastIdInserted = $scope.perguntas[$scope.perguntas.length -1].id;
                var tempPerg = args;
                args.id = lastIdInserted;
                $scope.perguntas.push(args);

                $http.post("/painel/pergunta", args).then(function(response){

                }, function(response){
                    console.log('nao cadastrado');
                });
            });


        }]);
}());








