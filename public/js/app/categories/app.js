(function(){
    var app = angular.module('categories',[
        'ngRoute',
        'btford.socket-io',
        'ngSanitize',
        'categories.controllers',
        'crud.services',
        'routes',
        'ui.bootstrap'
    ]);
})();