(function(){
    var app = angular.module('orderPurchases',[
        'ngRoute',
        'btford.socket-io',
        'ngSanitize',
        'orderPurchases.controllers',
        'crudPurchases.services',
        'routes',
        'ui.bootstrap',
        'xeditable'
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
})();
