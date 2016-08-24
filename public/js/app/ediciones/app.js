(function(){
    var app = angular.module('ediciones',[
        'ngRoute',
        //'btford.socket-io',
        'ngSanitize',
        'ediciones.controllers',
        'crud.services',
        'routes',
        'ui.bootstrap'
    ]);
})();