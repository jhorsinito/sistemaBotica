(function(){
    var app = angular.module('motivoVentas',[
        'ngRoute',
        //'btford.socket-io',
        'ngSanitize',
        'motivoVentas.controllers',
        'crud.services',
        'routes',
        'ui.bootstrap'
    ]);
})();