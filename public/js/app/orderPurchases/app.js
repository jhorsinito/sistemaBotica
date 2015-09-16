(function(){
    var app = angular.module('orderPurchases',[
        'ngRoute',
        'btford.socket-io',
        'ngSanitize',
        'orderPurchases.controllers',
        'crudPurchases.services',
        'routes',
        'ui.bootstrap'
    ]);
    app.directive('stringToNumber', function() {
  return {
    require: 'ngModel',
    link: function(scope, element, attrs, ngModel) {
      ngModel.$parsers.push(function(value) {
        return '' + value;
      });
      ngModel.$formatters.push(function(value) {
        return parseFloat(value, 10);
      });
    }
  };
});
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
