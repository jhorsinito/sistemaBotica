(function(){
    angular.module('tipoDocumentos.controllers',[])
        .controller('TipoDocumentoController',['$scope', '$routeParams','$location','crudService' ,'$filter','$route','$log',
            function($scope, $routeParams,$location,crudService,$filter,$route,$log){
                $scope.tipoDocumentos = [];
                $scope.tipoDocumento = {};
                $scope.errors = null;
                $scope.success;
                $scope.query = '';
                

                $scope.toggle = function () {
                    $scope.show = !$scope.show; 
                };

                $scope.pageChanged = function() {
                    if ($scope.query.length > 0) {
                        crudService.search('tipoDocumentos',$scope.query,$scope.currentPage).then(function (data){
                        $scope.tipoDocumentos = data.data;
                    });
                    }else{
                        crudService.paginate('tipoDocumentos',$scope.currentPage).then(function (data) {
                            $scope.tipoDocumentos = data.data;
                        });
                    }
                };


                var id = $routeParams.id;

                if(id)
                {
                    crudService.byId(id,'tipoDocumentos').then(function (data) {
                        $scope.tipoDocumento = data;
                    });
                }else{
                    crudService.paginate('tipoDocumentos',1).then(function (data) {
                        $scope.tipoDocumentos = data.data;
                        $scope.maxSize = 5;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                        $scope.itemsperPage = 15;

                    });
                }

                

                $scope.searchTipoDocumento= function(){
                if ($scope.query.length > 0) {
                    crudService.search('tipoDocumentos',$scope.query,1).then(function (data){
                        $scope.tipoDocumentos = data.data;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                    });
                }else{
                    crudService.paginate('tipoDocumentos',1).then(function (data) {
                        $scope.tipoDocumentos = data.data;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                    });
                }
                    
                };

                $scope.createTipoDocumento = function(){
                    //$scope.atribut.estado = 1;
                    if ($scope.tipoDocumentoCreateForm.$valid) {
                        crudService.create($scope.tipoDocumento, 'tipoDocumentos').then(function (data) {
                          
                            if (data['estado'] == true) {
                                $scope.success = data['nombres'];
                                alert('grabado correctamente');
                                $location.path('/tipoDocumentos');

                            } else {
                                $scope.errors = data;

                            }
                        });
                    }
                }


                $scope.editTipoDocumento= function(row){
                    $location.path('/tipoDocumentos/edit/'+row.id);
                };

                $scope.updateTipoDocumento = function(){

                    if ($scope.TipoDocumentoEditForm.$valid) {
                        crudService.update($scope.tipoDocumento,'tipoDocumentos').then(function(data)
                        {
                            if(data['estado'] == true){
                                $scope.success = data['nombres'];
                                alert('editado correctamente');
                                $location.path('/tipoDocumentos');
                            }else{
                                $scope.errors =data;
                            }
                        });
                    }
                };

                $scope.deleteTipoDocumento= function(row){
                    
                    $scope.tipoDocumento = row;
                }

                $scope.cancelTipoDocumento = function(){
                    $scope.tipoDocumento = {};
                }

                $scope.destroyTipoDocumento = function(){
                    crudService.destroy($scope.tipoDocumento,'tipoDocumentos').then(function(data)
                    {
                        if(data['estado'] == true){
                            $scope.success = data['nombre'];
                            $scope.tipoDocumento = {};
                            //alert('hola');
                            $route.reload();

                        }else{
                            $scope.errors = data;
                        }
                    });
                }
            }]);
})();