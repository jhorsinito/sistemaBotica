(function(){
    var app = angular.module('tiendas',[
        'ngRoute',
        'ngSanitize',
        'tiendas.controllers',
        'crud.services',
        'routes',
        'ui.bootstrap'
    ]);
})();