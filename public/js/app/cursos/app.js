(function(){
    var app = angular.module('cursos',[
        'ngRoute',
        //'btford.socket-io',
        'ngSanitize',
        'cursos.controllers',
        'crud.services',
        'routes',
        'ui.bootstrap'
    ]);
})();