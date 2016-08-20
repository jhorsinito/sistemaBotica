 (function(){
    var app = angular.module('cuentaBancarias',[
        'ngRoute',
        //'btford.socket-io',
        'ngSanitize',
        'cuentaBancarias.controllers',
        'crud.services',
        'routes',
        'ui.bootstrap'
    ]);
})();