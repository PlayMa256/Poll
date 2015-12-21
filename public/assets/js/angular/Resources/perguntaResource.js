(function(){
    var app = angular.module('perguntas')
        .factory('perguntaResource', function($resource){
            return $resource('/painel/pergunta/:id/editar/status', null, {
                'update' : {
                    method: 'PUT'
                }
            });
    });
}())