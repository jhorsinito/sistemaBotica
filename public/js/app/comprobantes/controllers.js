(function(){
    angular.module('comprobantes.controllers',[])
        .controller('ComprobanteController',['$scope', '$routeParams','$location','crudService' ,'$filter','$route','$log',
            function($scope, $routeParams,$location,crudService,$filter,$route,$log){
                $scope.comprobantes = [];
                $scope.comprobante = {};
                $scope.errors = null;
                $scope.success;
                $scope.query = '';

                $scope.toggle = function () {
                    $scope.show = !$scope.show;
                };

                $scope.pageChanged = function() {
                    if ($scope.query.length > 0) {
                        crudService.search('comprobantes',$scope.query,$scope.currentPage).then(function (data){
                        $scope.comprobantes = data.data;
                    });
                    }else{
                        crudService.paginate('comprobantes',$scope.currentPage).then(function (data) {
                            $scope.comprobantes = data.data;
                        });
                    }
                };


                var id = $routeParams.id;

                if(id)
                {
                    crudService.byId(id,'comprobantes').then(function (data) {
                        $scope.comprobante = data;
                    });
                }else{
                    crudService.paginate('comprobantes',1).then(function (data) {
                        $scope.comprobantes = data.data;
                        $scope.maxSize = 5;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                        $scope.itemsperPage = 15;

                    });
                }


                $scope.searchComprobante = function(){
                if ($scope.query.length > 0) {
                    crudService.search('comprobantes',$scope.query,1).then(function (data){
                        $scope.comprobantes = data.data;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                    });
                }else{
                    crudService.paginate('comprobantes',1).then(function (data) {
                        $scope.comprobantes = data.data;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                    });
                }
                    
                };
                 $scope.validanomComprobante=function(texto){
                
                   if(texto!=undefined){
                        crudService.validar('comprobantes',texto).then(function (data){
                        $scope.comprobante = data;
                        if($scope.comprobante!=null){
                           alert("Usted no puede crear dos Comprobantes con el mismo nombre");
                           $scope.comprobante.nombreComprobante=''; 
                           $scope.comprobante.descripcion=''; 
                        }
                    });
                    }
               }

                $scope.createComprobante = function(){
                    //$scope.atribut.estado = 1;
                    if ($scope.comprobanteCreateForm.$valid) {
                        crudService.create($scope.comprobante, 'comprobantes').then(function (data) {
                          
                            if (data['estado'] == true) {
                                $scope.success = data['nombres'];
                                alert('grabado correctamente');
                                $location.path('/comprobantes');

                            } else {
                                $scope.errors = data;

                            }
                        });
                    }
                }


                $scope.editComprobante= function(row){
                    $location.path('/comprobantes/edit/'+row.id);
                };

                $scope.updateComprobante = function(){

                    if ($scope.comprobanteEditForm.$valid) {
                        crudService.update($scope.comprobante,'comprobantes').then(function(data)
                        {
                            if(data['estado'] == true){
                                $scope.success = data['nombres'];
                                alert('editado correctamente');
                                $location.path('/comprobantes');
                            }else{
                                $scope.errors =data;
                            }
                        });
                    }
                };

                $scope.deleteComprobante = function(row){
                    $scope.comprobante = row;
                }

                $scope.cancelComprobante = function(){
                    $scope.comprobante = {};
                }

                $scope.destroyComprobante = function(){
                    crudService.destroy($scope.comprobante,'comprobantes').then(function(data)
                    {
                        if(data['estado'] == true){
                            $scope.success = data['nombre'];
                            $scope.comprobante = {};
                            //alert('hola');
                            $route.reload();

                        }else{
                            $scope.errors = data;
                        }
                    });
                }
            }]);
})();