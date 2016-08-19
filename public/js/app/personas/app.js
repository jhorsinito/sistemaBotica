 (function(){
    var app = angular.module('personas',[
        'ngRoute',
        //'btford.socket-io',
        'ngSanitize',
        'personas.controllers',
        'crud.services',
        'routes',
        'ui.bootstrap'
    ]);
})();