(function(){
    var app = angular.module('purchases',[
        'ngRoute',
        'btford.socket-io',
        'ngSanitize',
        'purchases.controllers',
        'crudOPurchases.services',
        'routes',
        'ui.bootstrap'
    ]);
 
})();
