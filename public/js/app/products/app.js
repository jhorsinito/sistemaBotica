(function(){
    var app = angular.module('products',[
        'ngRoute',
        'btford.socket-io',
        'ngSanitize',
        'products.controllers',
        'crud.services',
        'routes',
        'ui.bootstrap',
        'ngProgress'
    ]);
    app.run(function($rootScope,ngProgressFactory) {
        var progressbar = ngProgressFactory.createInstance();
        $rootScope.$on('$routeChangeStart', function(ev,data) {
            progressbar.start();
        });
        $rootScope.$on('$routeChangeSuccess', function(ev,data) {
            progressbar.complete();
        });
    });
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
    app.value('trouble', {});
})(window.angular);
