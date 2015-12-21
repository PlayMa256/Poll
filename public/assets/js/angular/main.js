(function(){
    var app = angular.module('perguntas', ['ngMaterial', 'ngMessages', 'ngResource'], function($interpolateProvider) {
        $interpolateProvider.startSymbol('<%');
        $interpolateProvider.endSymbol('%>');
    });
    var csrftoken =  (function() {
        // not need Jquery for doing that
        var metas = window.document.getElementsByTagName('meta');

        // finding one has csrf token
        for(var i=0 ; i < metas.length ; i++) {

            if ( metas[i].name === "csrf-token") {

                return  metas[i].content;
            }
        }

    })();
    app.constant('CSRF_TOKEN', csrftoken);
}());