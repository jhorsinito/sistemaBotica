(function(){
    var app = angular.module('employees',[
        'ngRoute',
        'btford.socket-io',
        'ngSanitize',
        'employees.controllers',
        'crud.services',
        'routes',
        'ui.bootstrap'
    ]);
})();