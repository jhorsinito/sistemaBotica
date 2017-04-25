(function(){
    angular.module('clientes.controllers',[])
        .controller('ClienteController',['$scope', '$routeParams','$location','crudService' ,'$filter','$route','$log',
            function($scope, $routeParams,$location,crudService,$filter,$route,$log){
                $scope.clientes = [];
                $scope.cliente = {};
                $scope.errors = null;
                $scope.success;
                $scope.query = '';

                $scope.toggle = function () {
                    $scope.show = !$scope.show;
                };

                $scope.pageChanged = function() {
                    if ($scope.query.length > 0) {
                        crudService.search('clientes',$scope.query,$scope.currentPage).then(function (data){
                        $scope.clientes = data.data;
                    });
                    }else{
                        crudService.paginate('clientes',$scope.currentPage).then(function (data) {
                            $scope.clientes = data.data;
                        });
                    }
                };


                var id = $routeParams.id;

                if(id)
                {
                    crudService.byId(id,'clientes').then(function (data) {
                        $scope.brand = data;
                    });
                }else{
                    crudService.paginate('clientes',1).then(function (data) {
                        $scope.clientes = data.data;
                        $scope.maxSize = 5;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                        $scope.itemsperPage = 15;

                    });
                }


                $scope.searchBrand = function(){
                if ($scope.query.length > 0) {
                    crudService.search('clientes',$scope.query,1).then(function (data){
                        $scope.clientes = data.data;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                    });
                }else{
                    crudService.paginate('clientes',1).then(function (data) {
                        $scope.clientes = data.data;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                    });
                }
                    
                };
                 $scope.validanomCliente=function(texto){
                
                   if(texto!=undefined){
                        crudService.validar('clientes',texto).then(function (data){
                        $scope.cliente = data;
                        if($scope.cliente!=null){
                           alert("Usted no puede crear dos Clientes con el mismo nombre");
                           $scope.cliente.nombre=''; 
                           $scope.cliente.shortname=''; 
                        }
                    });
                    }
               }

                $scope.createCliente = function(){
                    //$scope.atribut.estado = 1;
                    if ($scope.clienteCreateForm.$valid) {
                        crudService.create($scope.cliente, 'clientes').then(function (data) {
                          
                            if (data['estado'] == true) {
                                $scope.success = data['nombres'];
                                alert('grabado correctamente');
                                $location.path('/clientes');

                            } else {
                                $scope.errors = data;

                            }
                        });
                    }
                }


                $scope.editCliente = function(row){
                    $location.path('/clientes/edit/'+row.id);
                };

                $scope.updateCliente = function(){

                    if ($scope.ClienteEditForm.$valid) {

                    if ($scope.clienteCreateForm.$valid) {
                        crudService.update($scope.cliente,'clientes').then(function(data)
                        {
                            if(data['estado'] == true){
                                $scope.success = data['nombres'];
                                alert('editado correctamente');
                                $location.path('/clientes');
                            }else{
                                $scope.errors =data;
                            }
                        });
                    }
                };

                $scope.deleteCliente = function(row){
                    $scope.cliente = row;
                }

                $scope.cancelCliente = function(){
                    $scope.cliente = {};
                }

                $scope.destroyCliente = function(){
                    crudService.destroy($scope.cliente,'clientes').then(function(data)
                    {
                        if(data['estado'] == true){
                            $scope.success = data['nombre'];
                            $scope.cliente = {};
                            //alert('hola');
                            $route.reload();

                        }else{
                            $scope.errors = data;
                        }
                    });
                }
            }]);
})();

})();
