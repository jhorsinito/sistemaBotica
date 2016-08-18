(function(){
    var app = angular.module('profesiones',[
        'ngRoute',
        //'btford.socket-io',
        'ngSanitize',
        'profesiones.controllers',
        'crud.services',
        'routes',
        'ui.bootstrap'
    ]);
})();