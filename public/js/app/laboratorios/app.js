(function(){
    var app = angular.module('laboratorios',[
        'ngRoute',
        //'btford.socket-io',
        'ngSanitize',
        'laboratorios.controllers',
        'crud.services',
        'routes',
        'ui.bootstrap'
    ]);
})();