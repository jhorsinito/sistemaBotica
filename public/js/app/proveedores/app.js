(function(){
    var app = angular.module('proveedores',[
        'ngRoute',
        'ngSanitize',
        'proveedores.controllers',
        'crud.services',
        'routes',
        'ui.bootstrap'
    ]);
})();