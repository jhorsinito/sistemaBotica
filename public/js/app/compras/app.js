(function(){
    var app = angular.module('compras',[
        'ngRoute',
        'ngSanitize',
        'compras.controllers',
        'crud.services',
        'routes',
        'ui.bootstrap'
    ]);
})();