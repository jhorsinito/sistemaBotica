(function(){
    var app = angular.module('laboratorios',[
        'ngRoute',
        'ngSanitize',
        'laboratorios.controllers',
        'crud.services',
        'routes',
        'ui.bootstrap'
    ]);
})();