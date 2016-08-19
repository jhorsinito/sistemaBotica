(function(){
    var app = angular.module('medioPublicitarios',[
        'ngRoute',
        //'btford.socket-io',
        'ngSanitize',
        'medioPublicitarios.controllers',
        'crud.services',
        'routes',
        'ui.bootstrap'
    ]);
})();