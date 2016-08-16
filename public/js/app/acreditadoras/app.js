 (function(){
    var app = angular.module('acreditadoras',[
        'ngRoute',
        //'btford.socket-io',
        'ngSanitize',
        'acreditadoras.controllers',
        'crud.services',
        'routes',
        'ui.bootstrap'
    ]);
})();