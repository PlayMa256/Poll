(function(){
    var app = angular.module('perguntas')
        .controller('PerguntaController',['$scope', '$http', '$resource', '$rootScope', function($scope, $http, $resource, $rootScope){
            $scope.pergunta = {};
            $scope.perguntas = [];


            var recurseGET = $resource('/painel/perguntas/json');
            recurseGET.query(function(dados){
                $scope.perguntas = dados;
                var k = 0;
                for(k=0;k<$scope.perguntas.length;k++){
                    $scope.perguntas[k].status = ($scope.perguntas[k].status == 1) ? true : false;
                }
                console.log($scope.perguntas);

            }, function(erro){
                console.log(erro);
            });

            $scope.$on('adicionadoPergunta', function(event, args){
                var lastIdInserted = $scope.perguntas[$scope.perguntas.length -1].id;
                var tempPerg = args;
                args.id = lastIdInserted;
                if(args.status == 1){
                    args.status = true;
                }else{
                    args.status = false;
                }
                $scope.perguntas.push(args);

                var resourcePost = $resource('/painel/pergunta');

                resourcePost.save(args, function(response){
                    $rootScope.$broadcast('statusPostPergunta', "Adicionado com Sucesso");
                });
            });


        }]);
}());








