(function(){
    var app = angular.module('tipoProductos',[
        'ngRoute',
        'ngSanitize',
        'tipoProductos.controllers',
        'crud.services',
        'routes',
        'ui.bootstrap'
    ]);
})();