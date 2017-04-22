(function(){
    angular.module('cajas.controllers',[])
        .controller('CajaController',['$scope', '$routeParams','$location','crudService' ,'$filter','$route','$log',
            function($scope, $routeParams,$location,crudService,$filter,$route,$log){
                
$scope.caja = {};
$scope.cajas = {};
$scope.errors = null;
$scope.success;
$scope.query = '';
$scope.tiendas = {};
$scope.almacenes = {};
$scope.caja.estado2 = true;
            

                $scope.toggle = function () {
                    $scope.show = !$scope.show;
                };

                $scope.pageChanged = function() {
                    if ($scope.query.length > 0) {
                        crudService.search('cajas',$scope.query,$scope.currentPage).then(function (data){
                        $scope.cajas = data.data;
                    });
                    }else{
                        crudService.paginate('cajas',$scope.currentPage).then(function (data) {
                            $scope.cajas = data.data;
                        });
                    }
                };


                var id = $routeParams.id;

                   if(id)
                {
                    crudService.byId(id,'cajas').then(function (data) {
                        $scope.caja = data;
                    });
                }

                if(id)
                {
                    if($location.path() == '/cajas/edit/'+$routeParams.id) {
                             crudService.paginate('cajas',1).then(function (data) {
                          $scope.cajas = data.data;

                             $scope.cajas = data.data;
                             $scope.maxSize = 5;
                             $scope.totalItems = data.total;
                             $scope.currentPage = data.current_page;
                             $scope.itemsperPage = 15;
                                });
                       
                        crudService.select('cajas', 'tiendas').then(function (data) {
                            $scope.tiendas = data;
                        });
                        crudService.select('cajas', 'almacenes').then(function (data) {
                            $scope.almacenes = data;
                        });
                    };

                }else{
                    crudService.paginate('cajas',1).then(function (data) {
                        $scope.cajas = data.data;
                        $scope.maxSize = 5;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                        $scope.itemsperPage = 15;

                   });

                    } 

                    if($location.path() == '/cajas/create') {
                        crudService.paginate('cajas',1).then(function (data) {
                        $scope.cajas = data.data;
                        });
                        crudService.select('cajas', 'tiendas').then(function (data) {
                            $scope.tiendas = data;
                        });

                        crudService.select('cajas', 'almacenes').then(function (data) {
                            $scope.almacenes = data;
                        });

                    }


                $scope.searchCaja = function(){
                if ($scope.query.length > 0) {
                    crudService.search('cajas',$scope.query,1).then(function (data){
                        $scope.cajas = data.data;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                    });
                }else{
                    crudService.paginate('cajas',1).then(function (data) {
                        $scope.cajas = data.data;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                    });
                }
                    
                };
                 $scope.validanomCaja=function(texto){
                
                   if(texto!=undefined){
                        crudService.validar('cajas',texto).then(function (data){
                        $scope.caja = data;
                        if($scope.caja!=null){
                           alert("Usted no puede crear dos Cajas con el mismo nombre");
                           $scope.caja.nombreCaja=''; 
                           $scope.caja.descripcion=''; 
                        }
                    });
                    }
               }

                $scope.createCaja = function(){
                
                    if ($scope.cajaCreateForm.$valid) {
                        crudService.create($scope.caja, 'cajas').then(function (data) {
                          
                            if (data['estado'] == true) {
                                $scope.success = data['nombres'];
                                alert('Caja Grabado Correctamente');
                                $location.path('/cajas');

                            } else {
                                $scope.errors = data;

                            }
                        });
                    }
                }

                $scope.editCaja= function(row){
                    $location.path('/cajas/edit/'+row.id);
                };

                $scope.updateCaja = function(){

                    if ($scope.cajaEditForm.$valid) {
                        crudService.update($scope.caja,'cajas').then(function(data)
                        {
                            if(data['estado'] == true){
                                $scope.success = data['nombres'];
                                alert('Caja Editada Correctamente');
                                $location.path('/cajas');
                            }else{
                                $scope.errors =data;
                            }
                        });
                    }
                };

                $scope.deleteCaja = function(row){
                    $scope.caja = row;
                }

                $scope.cancelCaja = function(){
                    $scope.caja = {};
                }

                $scope.destroyCaja = function(){
                    crudService.destroy($scope.caja,'cajas').then(function(data)
                    {
                        if(data['estado'] == true){
                            $scope.success = data['nombre'];
                            $scope.caja = {};
                            $route.reload();

                        }else{
                            $scope.errors = data;
                        }
                    });
                }
            }]);
})();