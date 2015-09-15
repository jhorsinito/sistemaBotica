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
  app.directive('ngEnter', function () {
    return function (scope, element, attrs) {
        element.bind("keydown keypress", function (event) {
            if(event.which === 13) {
                scope.$apply(function (){
                    scope.$eval(attrs.ngEnter);
                });
 
                event.preventDefault();
            }
        });
    };
});
})();
