(function(){
    var pergunta = angular.module('perguntas');
    pergunta.service('PerguntasService', ['$http', function($http){
        var getAll = function(){
           $http.get('/painel/perguntas/json').then(function(response){
                return response.data;
            });
        }
        return {
          getAll: getAll
        };
    }]);
}())
