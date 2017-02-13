(function(){
    angular.module('almacenes.controllers',[])
        .controller('AlmacenController',['$scope', '$routeParams','$location','crudService' ,'$filter','$route','$log',
            function($scope, $routeParams,$location,crudService,$filter,$route,$log){
                $scope.almacenes = [];
                $scope.almacen = {};
                $scope.errors = null;
                $scope.success;
                $scope.query = '';
                $scope.tiendas={};

                $scope.toggle = function () { 
                    $scope.show = !$scope.show; 
                };

                $scope.pageChanged = function() {
                    if ($scope.query.length > 0) {
                        crudService.search('almacenes',$scope.query,$scope.currentPage).then(function (data){
                        $scope.almacenes = data.data;
                    });
                    }else{
                        crudService.paginate('almacenes',$scope.currentPage).then(function (data) {
                            $scope.almacenes = data.data;
                            
                        });
                    }
                };


                var id = $routeParams.id;

                if(id)
                {
                    crudService.byId(id,'almacenes').then(function (data) {
                        $scope.almacen = data;
                    });

                }else{
                    crudService.paginate('almacenes',1).then(function (data) {
                        $scope.almacenes = data.data;
                        $scope.maxSize = 5;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                        $scope.itemsperPage = 15;
                        $log.log($scope.almacenes);
                    });
                    crudService.all('tiendasAll',1).then(function (data) {
                        $scope.tiendas=data;
                        $log.log($scope.tiendas);
                    });
                }

                

                $scope.searchAlmacen= function(){
                if ($scope.query.length > 0) {
                    crudService.search('almacenes',$scope.query,1).then(function (data){
                        $scope.almacenes = data.data;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                    });
                }else{
                    crudService.paginate('almacenes',1).then(function (data) {
                        $scope.almacenes = data.data;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                    });
                }
                    
                };



                $scope.validanomMarca=function(texto){
                
                   if(texto!=undefined){
                        crudService.validar('almacenes',texto).then(function (data){
                        $scope.almacen = data;
                        if($scope.almacen!=null){
                           alert("Usted no puede crear dos Marcas con el mismo nombre");
                           $scope.almacen.nombre=''; 
                           $scope.almacen.descripcion=''; 
                        }
                    });
                    }
               }
                $scope.createAlmacen= function(){
                    //$scope.atribut.estado = 1;
                 
                    if ($scope.almacenCreateForm.$valid) {
                        $scope.almacen
                        crudService.create($scope.almacen, 'almacenes').then(function (data) {
                          
                            if (data['estado'] == true) {
                                $scope.success = data['nombres'];
                                alert('grabado correctamente');
                                $location.path('/almacenes');

                            } else {
                                $scope.errors = data;

                            }
                        });
                    }
                }


                $scope.editAlmacen= function(row){
                    $location.path('/almacenes/edit/'+row.id);
                };

                $scope.updateAlmacen = function(){

                    if ($scope.AlmacenEditForm.$valid) {
                        crudService.update($scope.almacen,'almacenes').then(function(data)
                        {
                            if(data['estado'] == true){
                                $scope.success = data['nombres'];
                                alert('editado correctamente');
                                $location.path('/almacenes');
                            }else{
                                $scope.errors =data;
                            }
                        });
                    }
                };

                $scope.deleteAlmacen= function(row){
                    
                    $scope.almacen = row;
                }

                $scope.cancelAlmacen = function(){
                    $scope.almacen = {};
                }

                $scope.destroyAlmacen = function(){
                    crudService.destroy($scope.almacen,'almacenes').then(function(data)
                    {
                        if(data['estado'] == true){
                            $scope.success = data['nombre'];
                            $scope.almacen = {};
                            //alert('hola');
                            $route.reload();

                        }else{
                            $scope.errors = data;
                        }
                    });
                }
            }]);
})();