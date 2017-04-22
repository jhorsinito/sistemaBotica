(function(){
    angular.module('tipoProductos.controllers',[])
        .controller('TipoProductoController',['$scope', '$routeParams','$location','crudService' ,'$filter','$route','$log',
            function($scope, $routeParams,$location,crudService,$filter,$route,$log){
                $scope.tipoProductos = [];
                $scope.tipoProducto = {};
                $scope.errors = null;
                $scope.success;
                $scope.query = '';

                $scope.toggle = function () { 
                    $scope.show = !$scope.show; 
                };

                $scope.pageChanged = function() {
                    if ($scope.query.length > 0) {
                        crudService.search('tipoProductos',$scope.query,$scope.currentPage).then(function (data){
                        $scope.tipoProductos = data.data;
                    });
                    }else{
                        crudService.paginate('tipoProductos',$scope.currentPage).then(function (data) {
                            $scope.tipoProductos = data.data;
                            
                        });
                    }
                };


                var id = $routeParams.id;

                if(id)
                {
                    crudService.byId(id,'tipoProductos').then(function (data) {
                        $scope.tipoProducto = data;
                    });

                }else{
                    crudService.paginate('tipoProductos',1).then(function (data) {
                        $scope.tipoProductos = data.data;
                        $scope.maxSize = 5;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                        $scope.itemsperPage = 15;
                        $log.log($scope.tipoProductos);
                    });
                    
                }

                

                $scope.searchTipoProducto= function(){
                if ($scope.query.length > 0) {
                    crudService.search('tipoProductos',$scope.query,1).then(function (data){
                        $scope.tipoProductos = data.data;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                    });
                }else{
                    crudService.paginate('tipoProductos',1).then(function (data) {
                        $scope.tipoProductos = data.data;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                    });
                }
                    
                };



                $scope.validanomTipoProducto=function(texto){
                
                   if(texto!=undefined){
                        crudService.validar('tipoProductos',texto).then(function (data){
                        $scope.tipoProducto = data;
                        if($scope.tipoProducto!=null){
                           alert("Usted no puede crear dos Tipos de Productos con el mismo nombre");
                           $scope.tipoProducto.nombre=''; 
                           $scope.tipoProducto.descripcion=''; 
                        }
                    });
                    }
               }
                $scope.createTipoProducto= function(){
                    //$scope.atribut.estado = 1;
                 
                    if ($scope.tipoProductoCreateForm.$valid) {
                        $scope.tipoProducto
                        crudService.create($scope.tipoProducto, 'tipoProductos').then(function (data) {
                          
                            if (data['estado'] == true) {
                                $scope.success = data['nombres'];
                                alert('grabado correctamente');
                                $location.path('/tipoProductos');

                            } else {
                                $scope.errors = data;

                            }
                        });
                    }
                }


                $scope.editTipoProducto= function(row){
                    $location.path('/tipoProductos/edit/'+row.id);
                };

                $scope.updateTipoProducto = function(){

                    if ($scope.tipoProductoEditForm.$valid) {
                        crudService.update($scope.tipoProducto,'tipoProductos').then(function(data)
                        {
                            if(data['estado'] == true){
                                $scope.success = data['nombres'];
                                alert('editado correctamente');
                                $location.path('/tipoProductos');
                            }else{
                                $scope.errors =data;
                            }
                        });
                    }
                };

                $scope.deleteTipoProducto= function(row){
                    
                    $scope.tipoProducto = row;
                }

                $scope.cancelTipoProducto = function(){
                    $scope.tipoProducto = {};
                }

                $scope.destroyTipoProducto = function(){
                    crudService.destroy($scope.tipoProducto,'tipoProductos').then(function(data)
                    {
                        if(data['estado'] == true){
                            $scope.success = data['nombre'];
                            $scope.tipoProducto = {};
                            //alert('hola');
                            $route.reload();

                        }else{
                            $scope.errors = data;
                        }
                    });
                }
            }]);
})();