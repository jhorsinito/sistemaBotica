(function(){
    var app = angular.module('clientes',[
        'ngRoute',
        'ngSanitize',
        'clientes.controllers',
        'crud.services',
        'routes',
        'ui.bootstrap'
    ]);
})();