(function(){
    var app = angular.module('purchases',[
        'ngRoute',
        'btford.socket-io',
        'ngSanitize',
        'purchases.controllers',
        'crudPurchases.services',
        'routes',
        'ui.bootstrap'
    ]);
})();
