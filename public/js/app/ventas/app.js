(function(){
    var app = angular.module('ventas',[
        'ngRoute',
        //'btford.socket-io',
        'ngSanitize',
        'ventas.controllers',
        'crud.services',
        'routes',
        'ui.bootstrap',
        'ngProgress',
        'ui.slider'
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
    angular.module('ui.bootstrap').controller('ModalInstanceCtrl', function ($scope, $modalInstance, crudService) {

        $scope.createTienda = function () {
            if ($scope.tiendaCreateForm.$valid) {
                var $btn = $('#btn_generateTienda').button('loading');
                crudService.create($scope.tienda, 'tiendas').then(function (data) {
                    if (data['estado'] == true) {
                        $scope.success = data['nombres'];
                        alert('grabado correctamente');
                        $modalInstance.dismiss('cancel');
                    } else {
                        $scope.errors = data;
                        $btn.button('reset');

                    }
                });
            }
        };

        $scope.cancelTienda = function () {
            $modalInstance.dismiss('cancel');
        };
    });
    
angular.module('ui.bootstrap').controller('ModalInstanceCtrl2', function ($scope, $modalInstance, crudService) {

        $scope.createComprobante = function () {
            if ($scope.comprobanteCreateForm.$valid) {
                var $btn = $('#btn_generateComprobante').button('loading');
                crudService.create($scope.comprobante, 'comprobantes').then(function (data) {

                    if (data['estado'] == true) {
                        $scope.success = data['nombres'];
                        alert('grabado correctamente');
                        $modalInstance.dismiss('cancel');
                        
                    } else {
                        $scope.errors = data;
                        $btn.button('reset');

                    }
                });
            }
        };

        $scope.cancelComprobante = function () {
            $modalInstance.dismiss('cancel');
        };

  });

angular.module('ui.bootstrap').controller('ModalInstanceCtrl3', function ($scope, $modalInstance, crudService) {

        $scope.createCliente = function () {
            if ($scope.clienteCreateForm.$valid) {
                var $btn = $('#btn_generateCliente').button('loading');
                crudService.create($scope.cliente, 'clientes').then(function (data) {

                    if (data['estado'] == true) {
                        $scope.success = data['nombres'];
                        alert('grabado correctamente');
                        $modalInstance.dismiss('cancel');
                        //$location.path('/types');

                    } else {
                        $scope.errors = data;
                        $btn.button('reset');

                    }
                });
            }
        };

        $scope.cancelCliente = function () {
            $modalInstance.dismiss('cancel');
        };
    });
           

   
})(window.angular);

    var app = angular.module('almacenes',[
        'ngRoute',
        'ngSanitize',
        'almacenes.controllers',
        'crud.services',
        'routes',
        'ui.bootstrap'
    ]);
})();
