(function(){
    angular.module('metodoPagos.controllers',[])
        .controller('MetodoPagoController',['$scope', '$routeParams','$location','crudService' ,'$filter','$route','$log',
            function($scope, $routeParams,$location,crudService,$filter,$route,$log){
                $scope.metodoPagos = [];
                $scope.metodoPago = {};
                $scope.errors = null;
                $scope.success;
                $scope.query = '';
                

                $scope.toggle = function () {
                    $scope.show = !$scope.show; 
                };

                $scope.pageChanged = function() {
                    if ($scope.query.length > 0) {
                        crudService.search('metodoPagos',$scope.query,$scope.currentPage).then(function (data){
                        $scope.metodoPagos = data.data;
                    });
                    }else{
                        crudService.paginate('metodoPagos',$scope.currentPage).then(function (data) {
                            $scope.metodoPagos = data.data;
                        });
                    }
                };


                var id = $routeParams.id;

                if(id)
                {
                    crudService.byId(id,'metodoPagos').then(function (data) {
                        $scope.metodoPago = data;
                    });
                }else{
                    crudService.paginate('metodoPagos',1).then(function (data) {
                        $scope.metodoPagos = data.data;
                        $scope.maxSize = 5;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                        $scope.itemsperPage = 15;

                    });
                }

                

                $scope.searchMetodoPago= function(){
                if ($scope.query.length > 0) {
                    crudService.search('metodoPagos',$scope.query,1).then(function (data){
                        $scope.metodoPagos = data.data;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                    });
                }else{
                    crudService.paginate('metodoPagos',1).then(function (data) {
                        $scope.metodoPagos = data.data;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                    });
                }
                    
                };

                $scope.createMetodoPago = function(){
                    if ($scope.metodoPagoCreateForm.$valid) {
                        crudService.create($scope.metodoPago, 'metodoPagos').then(function (data) {
                          
                            if (data['estado'] == true) {
                                $scope.success = data['nombres'];
                                alert('grabado correctamente');
                                $location.path('/metodoPagos');

                            } else {
                                $scope.errors = data;

                            }
                        });
                    }
                }


                $scope.editMetodoPago= function(row){
                    $location.path('/metodoPagos/edit/'+row.id);
                };

                $scope.updateMetodoPago = function(){

                    if ($scope.metodoPagoEditForm.$valid) {
                        crudService.update($scope.metodoPago,'metodoPagos').then(function(data)
                        {
                            if(data['estado'] == true){
                                $scope.success = data['nombres'];
                                alert('editado correctamente');
                                $location.path('/metodoPagos');
                            }else{
                                $scope.errors =data;
                            }
                        });
                    }
                };

                $scope.deleteMetodoPago= function(row){
                    
                    $scope.metodoPago = row;
                }

                $scope.cancelMetodoPago = function(){
                    $scope.metodoPago = {};
                }

                $scope.destroyMetodoPago = function(){
                    crudService.destroy($scope.metodoPago,'metodoPagos').then(function(data)
                    {
                        if(data['estado'] == true){
                            $scope.success = data['nombre'];
                            $scope.metodoPago = {};
                            //alert('hola');
                            $route.reload();

                        }else{
                            $scope.errors = data;
                        }
                    });
                }
            }]);
})();