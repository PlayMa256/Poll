(function(){
    var app = angular.module('perguntas');
    app.controller("dialogController", ['$scope', '$mdDialog','$mdMedia', '$http',function($scope, $mdDialog, $mdMedia){
        $scope.status = '  ';
        $scope.customFullscreen = $mdMedia('xs') || $mdMedia('sm');

        $scope.showAdvanced = function(ev) {
            var useFullScreen = ($mdMedia('sm') || $mdMedia('xs'))  && $scope.customFullscreen;

            $mdDialog.show({
                    controller: dialogController,
                    scope: $scope,
                    template: '<md-dialog aria-label="Mango (Fruit)"  ng-cloak>'+
                    '<form name="myForm" ng-submit="submit()">'+
                    '    <md-toolbar>'+
                    '    <div class="md-toolbar-tools">'+
                    '    <h2>Cadastrar nova pergunta</h2>'+
                    '<span flex></span>'+
                    '<md-button class="md-icon-button" ng-click="cancel()">'+
                    '   <md-icon class="glyphicon glyphicon-remove" aria-label="Close dialog"></md-icon>'+
                    '   </md-button>'+
                    '   </div>'+
                    '   </md-toolbar>'+
                    '   <md-dialog-content>'+
                    '  <div class="md-dialog-content">'+
                    '  <md-input-container>'+
                    '   <label>T&iacute;tulo</label>'+
                    '<input type="text" ng-model="pergunta.titulo" />'+
                    ' </md-input-container>'+
                    ' <md-radio-group  ng-model="pergunta.status">'+
                    ' <md-radio-button value="1">Ativado</md-radio-button>'+
                    ' <md-radio-button value="0">Desativado</md-radio-button>'+
                    ' </md-radio-group>'+
                    '  <span ng-show="formulario.$submitted && formulario.status.$error.required" class="form-control alert-danger">'+
                    '   Titulo obrigatório'+
                    '</span>'+
                    '<button type="submit">Submitar</button>'+
                    '</div>'+
                    '</md-dialog-content>'+
                    '</form>'+
                    '</md-dialog>',
                    parent: angular.element(document.body),
                    targetEvent: ev,
                    clickOutsideToClose:true,
                    fullscreen: useFullScreen
                });
        };
    }]);

    //apartir daqui que é pra fazer a edicao do codigo para conseguir mexer dentro do form do dialog.
    function dialogController($scope, $mdDialog,$rootScope) {
        //funcoes de controle do dialog.
        $scope.hide = function() {
            $mdDialog.hide();
        };
        $scope.cancel = function() {
            $mdDialog.cancel();
        };

        $scope.answer = function(answer) {
            $mdDialog.hide(answer);
        };

        $scope.pergunta = {};
        //enviando essas infos para o controller de perguntas, assim ele pode tratar melhor.
        $scope.submit = function(){
            $rootScope.$broadcast('adicionadoPergunta', $scope.pergunta);
        };

    }
}())