(function(){
    var app = angular.module('bancos',[
        'ngRoute',
        //'btford.socket-io',
        'ngSanitize',
        'bancos.controllers',
        'crud.services',
        'routes',
        'ui.bootstrap'
    ]);
})();