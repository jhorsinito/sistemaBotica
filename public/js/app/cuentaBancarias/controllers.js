(function(){
    angular.module('cuentaBancarias.controllers',[])
        .controller('CuentaBancariaController',['$scope', '$routeParams','$location','crudService' ,'$filter','$route','$log',
            function($scope, $routeParams,$location,crudService,$filter,$route,$log){
                $scope.cuentaBancarias = [];
                $scope.cuentaBancaria = {};
                $scope.bancos = {};
                $scope.errors = null;
                $scope.success;
                $scope.query = '';

                $scope.toggle = function () {
                    $scope.show = !$scope.show; 
                };

                $scope.pageChanged = function() {
                    if ($scope.query.length > 0) {
                        crudService.search('cuentaBancarias',$scope.query,$scope.currentPage).then(function (data){
                        $scope.cuentaBancarias = data.data;
                    });
                    }else{
                        crudService.paginate('cuentaBancarias',$scope.currentPage).then(function (data) {
                            $scope.cuentaBancarias = data.data;
                        });
                    }
                };


                var id = $routeParams.id;

                if(id)
                {
                    crudService.byId(id,'cuentaBancarias').then(function (data) {
                        $scope.cuentaBancaria = data;
                    });
                    crudService.all('cargarBancos').then(function (data) {
                        $scope.bancos = data;
                    });
                }else{
                    crudService.paginate('cuentaBancarias',1).then(function (data) {
                        $scope.cuentaBancarias = data.data;
                        $scope.maxSize = 5;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                        $scope.itemsperPage = 15;

                    });
                    crudService.all('cargarBancos').then(function (data) {
                        $scope.bancos = data;
                    });
                }

                

                $scope.searchCuentaBancaria= function(){
                if ($scope.query.length > 0) {
                    crudService.search('cuentaBancarias',$scope.query,1).then(function (data){
                        $scope.cuentaBancarias = data.data;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                    });
                }else{
                    crudService.paginate('cuentaBancarias',1).then(function (data) {
                        $scope.cuentaBancarias = data.data;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                    });
                }
                    
                };

                $scope.createCuentaBancaria = function(){
                    //$scope.atribut.estado = 1;
                    $log.log($scope.cuentaBancaria);
                    if ($scope.cuentaBancariaCreateForm.$valid) {
                        if($scope.cuentaBancaria.banco_id!=undefined){
                            crudService.create($scope.cuentaBancaria, 'cuentaBancarias').then(function (data) {
                          
                                if (data['estado'] == true) {
                                    $scope.success = data['nombres'];
                                    alert('grabado correctamente');
                                    $location.path('/cuentaBancarias');

                                } else {
                                    $scope.errors = data;

                                }
                            });
                        }else{
                            alert("Selecione Banco");
                        }
                    }
                }


                $scope.editCuentaBancaria = function(row){
                    $location.path('/cuentaBancarias/edit/'+row.id);
                };

                $scope.updateCuentaBancaria = function(){

                    if ($scope.cuentaBancariaEditForm.$valid) {
                        if($scope.cuentaBancaria.banco_id!=undefined){
                            crudService.update($scope.cuentaBancaria,'cuentaBancarias').then(function(data)
                            {
                                if(data['estado'] == true){
                                    $scope.success = data['nombres'];
                                    alert('editado correctamente');
                                    $location.path('/cuentaBancarias');
                                }else{
                                    $scope.errors =data;
                                }
                            });
                        }else{
                            alert("Selecione Banco");
                        }
                    }
                };

                $scope.deleteCuentaBancaria= function(row){
                    
                    $scope.cuentaBancaria = row;
                }

                $scope.cancelCuentaBancaria = function(){
                    $scope.cuentaBancaria = {};
                }

                $scope.destroyCuentaBancaria = function(){
                    crudService.destroy($scope.cuentaBancaria,'cuentaBancarias').then(function(data)
                    {
                        if(data['estado'] == true){
                            $scope.success = data['nombre'];
                            $scope.cuentaBancaria = {};
                            //alert('hola');
                            $route.reload();

                        }else{
                            $scope.errors = data;
                        }
                    });
                }
            }]);
})();
