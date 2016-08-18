(function(){
    angular.module('motivoVentas.controllers',[])
        .controller('MotivoVentaController',['$scope', '$routeParams','$location','crudService' ,'$filter','$route','$log',
            function($scope, $routeParams,$location,crudService,$filter,$route,$log){
                $scope.motivoVentas = [];
                $scope.motivoVenta = {};
                $scope.errors = null;
                $scope.success;
                $scope.query = '';

                $scope.toggle = function () {
                    $scope.show = !$scope.show; 
                };

                $scope.pageChanged = function() {
                    if ($scope.query.length > 0) {
                        crudService.search('motivoVentas',$scope.query,$scope.currentPage).then(function (data){
                        $scope.motivoVentas = data.data;
                    });
                    }else{
                        crudService.paginate('motivoVentas',$scope.currentPage).then(function (data) {
                            $scope.motivoVentas = data.data;
                        });
                    }
                };


                var id = $routeParams.id;

                if(id)
                {
                    crudService.byId(id,'motivoVentas').then(function (data) {
                        $scope.motivoVenta = data;
                    });
                }else{
                    crudService.paginate('motivoVentas',1).then(function (data) {
                        $scope.motivoVentas = data.data;
                        $scope.maxSize = 5;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                        $scope.itemsperPage = 15;

                    });
                }

                

                $scope.searchMotivoVenta= function(){
                if ($scope.query.length > 0) {
                    crudService.search('motivoVentas',$scope.query,1).then(function (data){
                        $scope.motivoVentas = data.data;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                    });
                }else{
                    crudService.paginate('motivoVentas',1).then(function (data) {
                        $scope.motivoVentas = data.data;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                    });
                }
                    
                };

                $scope.createMotivoVenta = function(){
                    //$scope.atribut.estado = 1;
                    if ($scope.motivoVentaCreateForm.$valid) {
                        crudService.create($scope.motivoVenta, 'motivoVentas').then(function (data) {
                          
                            if (data['estado'] == true) {
                                $scope.success = data['nombres'];
                                alert('grabado correctamente');
                                $location.path('/motivoVentas');

                            } else {
                                $scope.errors = data;

                            }
                        });
                    }
                }


                $scope.editMotivoVenta = function(row){
                    $location.path('/motivoVentas/edit/'+row.id);
                };

                $scope.updateMotivoVenta = function(){

                    if ($scope.motivoVentaEditForm.$valid) {
                        crudService.update($scope.motivoVenta,'motivoVentas').then(function(data)
                        {
                            if(data['estado'] == true){
                                $scope.success = data['nombres'];
                                alert('editado correctamente');
                                $location.path('/motivoVentas');
                            }else{
                                $scope.errors =data;
                            }
                        });
                    }
                };
                 $scope.validanomMotivoVenta=function(texto){
                   if(texto!=undefined){
                        crudService.validar('motivoVentas',texto).then(function (data){
                            if(data.codigo!=undefined){
                                alert("Codigo Ubigeo Registrado!!");
                                $scope.motivoVenta.codigo='';
                            }
                        });
                    }
               }
                $scope.deleteMotivoVenta= function(row){
                    
                    $scope.motivoVenta = row;
                }

                $scope.cancelMotivoVenta = function(){
                    $scope.motivoVenta = {};
                }

                $scope.destroyMotivoVenta = function(){
                    crudService.destroy($scope.motivoVenta,'motivoVentas').then(function(data)
                    {
                        if(data['estado'] == true){
                            $scope.success = data['nombre'];
                            $scope.motivoVenta = {};
                            //alert('hola');
                            $route.reload();

                        }else{
                            $scope.errors = data;
                        }
                    });
                }
            }]);
})();
