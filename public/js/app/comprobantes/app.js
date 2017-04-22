(function(){
    var app = angular.module('comprobantes',[
        'ngRoute',
        //'btford.socket-io',
        'ngSanitize',
        'comprobantes.controllers',
        'crud.services',
        'routes',
        'ui.bootstrap'
    ]);
})();