(function(){
    var app = angular.module('tipoDocumentos',[
        'ngRoute',
        'ngSanitize',
        'tipoDocumentos.controllers',
        'crud.services',
        'routes',
        'ui.bootstrap'
    ]);
})();