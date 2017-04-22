(function(){
    angular.module('proveedores.controllers',[])
        .controller('ProveedorController',['$scope', '$routeParams','$location','crudService' ,'$filter','$route','$log',
            function($scope, $routeParams,$location,crudService,$filter,$route,$log){
                $scope.proveedores = [];
                $scope.proveedor = {};
                $scope.errors = null;
                $scope.success;
                $scope.query = '';
                $scope.tipoDocumentos={};
                //$scope.tipoDocumentos.id = '1';
                $scope.tipoDocumentos.nombreDocumento = true;

                $scope.toggle = function () {
                    $scope.show = !$scope.show; 
                };

                $scope.pageChanged = function() {
                    if ($scope.query.length > 0) {
                        crudService.search('proveedores',$scope.query,$scope.currentPage).then(function (data){
                        $scope.proveedores = data.data;
                    });
                    }else{
                        crudService.paginate('proveedores',$scope.currentPage).then(function (data) {
                            $scope.proveedores = data.data;
                        });
                    }
                };


                var id = $routeParams.id;

                if(id)
                {
                    crudService.byId(id,'proveedores').then(function (data) {
                        $scope.proveedor = data;
                    });

                }else{
                    crudService.paginate('proveedores',1).then(function (data) {
                        $scope.proveedores = data.data;
                        $scope.maxSize = 5;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                        $scope.itemsperPage = 15;
                        $log.log($scope.proveedores);
                        });
                    
                    crudService.all('tipoDocumentosAll',1).then(function (data) {
                        $scope.tipoDocumentos=data;
                        $log.log($scope.tipoDocumentos);
                    });
                }

                

                $scope.searchProveedor= function(){
                if ($scope.query.length > 0) {
                    crudService.search('proveedores',$scope.query,1).then(function (data){
                        $scope.proveedores = data.data;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                    });
                }else{
                    crudService.paginate('proveedores',1).then(function (data) {
                        $scope.proveedores = data.data;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                    });
                }
                    
                };

                $scope.createProveedor= function(){
                 
                    if ($scope.proveedorCreateForm.$valid) {
                        $scope.proveedor
                        crudService.create($scope.proveedor, 'proveedores').then(function (data) {
                          
                            if (data['estado'] == true) {
                                $scope.success = data['nombres'];
                                alert('grabado correctamente');
                                $location.path('/proveedores');

                            } else {
                                $scope.errors = data;

                            }
                        });
                    }
                }


                $scope.editProveedor= function(row){
                    $location.path('/proveedores/edit/'+row.id);
                };

                $scope.updateProveedor = function(){

                    if ($scope.ProveedorEditForm.$valid) {
                        crudService.update($scope.proveedor,'proveedores').then(function(data)
                        {
                            if(data['estado'] == true){
                                $scope.success = data['nombreProveedor'];
                                alert('editado correctamente');
                                $location.path('/proveedores');
                            }else{
                                $scope.errors =data;
                            }
                        });
                    }
                };

                $scope.deleteProveedor= function(row){
                    
                    $scope.proveedor = row;
                }

                $scope.cancelProveedor = function(){
                    $scope.proveedor = {};
                }

                $scope.destroyProveedor = function(){
                    crudService.destroy($scope.proveedor,'proveedores').then(function(data)
                    {
                        if(data['estado'] == true){
                            $scope.success = data['nombreProveedor'];
                            $scope.proveedor = {};
                            $route.reload();

                        }else{
                            $scope.errors = data;
                        }
                    });
                }
            }]);
})();