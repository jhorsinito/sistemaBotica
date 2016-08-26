(function(){
    angular.module('tiendas.controllers',[])
        .controller('TiendaController',['$scope', '$routeParams','$location','crudService' ,'$filter','$route','$log',
            function($scope, $routeParams,$location,crudService,$filter,$route,$log){
                $scope.tiendas = [];
                $scope.tienda = {};
                $scope.errors = null;
                $scope.success;
                $scope.query = '';

                $scope.toggle = function () {
                    $scope.show = !$scope.show; 
                };

                $scope.pageChanged = function() {
                    if ($scope.query.length > 0) {
                        crudService.search('tiendas',$scope.query,$scope.currentPage).then(function (data){
                        $scope.tiendas = data.data;
                    });
                    }else{
                        crudService.paginate('tiendas',$scope.currentPage).then(function (data) {
                            $scope.tiendas = data.data;
                        });
                    }
                };


                var id = $routeParams.id;

                if(id)
                {
                    crudService.byId(id,'tiendas').then(function (data) {
                        $scope.tienda = data;
                    });
                }else{
                    crudService.paginate('tiendas',1).then(function (data) {
                        $scope.tiendas = data.data;
                        $scope.maxSize = 5;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                        $scope.itemsperPage = 15;

                    });
                }

                

                $scope.searchTienda= function(){
                if ($scope.query.length > 0) {
                    crudService.search('tiendas',$scope.query,1).then(function (data){
                        $scope.tiendas = data.data;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                    });
                }else{
                    crudService.paginate('tiendas',1).then(function (data) {
                        $scope.tiendas = data.data;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                    });
                }
                    
                };

                $scope.createTienda = function(){
                    //$scope.atribut.estado = 1;
                    if ($scope.tiendaCreateForm.$valid) {
                        crudService.create($scope.tienda, 'tiendas').then(function (data) {
                          
                            if (data['estado'] == true) {
                                $scope.success = data['nombres'];
                                alert('grabado correctamente');
                                $location.path('/tiendas');

                            } else {
                                $scope.errors = data;

                            }
                        });
                    }
                }


                $scope.editTienda= function(row){
                    $location.path('/tiendas/edit/'+row.id);
                };

                $scope.updateTienda = function(){

                    if ($scope.TiendaEditForm.$valid) {
                        crudService.update($scope.tienda,'tiendas').then(function(data)
                        {
                            if(data['estado'] == true){
                                $scope.success = data['nombres'];
                                alert('editado correctamente');
                                $location.path('/tiendas');
                            }else{
                                $scope.errors =data;
                            }
                        });
                    }
                };

                $scope.deleteTienda= function(row){
                    
                    $scope.tienda = row;
                }

                $scope.cancelTienda = function(){
                    $scope.tienda = {};
                }

                $scope.destroyTienda = function(){
                    crudService.destroy($scope.tienda,'tiendas').then(function(data)
                    {
                        if(data['estado'] == true){
                            $scope.success = data['nombre'];
                            $scope.tienda = {};
                            //alert('hola');
                            $route.reload();

                        }else{
                            $scope.errors = data;
                        }
                    });
                }
            }]);
})();