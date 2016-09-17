(function(){
    var app = angular.module('almacenes',[
        'ngRoute',
        'ngSanitize',
        'almacenes.controllers',
        'crud.services',
        'routes',
        'ui.bootstrap'
    ]);
})();