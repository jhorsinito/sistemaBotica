(function(){
    angular.module('ediciones.controllers',[])
        .controller('EdicionController',['$scope', '$routeParams','$location','crudService' ,'$filter','$route','$log',
            function($scope, $routeParams,$location,crudService,$filter,$route,$log){
                $scope.ediciones = [];
                $scope.edicion = {};
                $scope.errors = null;
                $scope.success;
                $scope.query = '';

                $scope.toggle = function () {
                    $scope.show = !$scope.show; 
                };

                $scope.pageChanged = function() {
                    if ($scope.query.length > 0) {
                        crudService.search('ediciones',$scope.query,$scope.currentPage).then(function (data){
                        $scope.ediciones = data.data;
                    });
                    }else{
                        crudService.paginate('ediciones',$scope.currentPage).then(function (data) {
                            $scope.ediciones = data.data;
                        });
                    }
                };


                var id = $routeParams.id;

                if(id)
                {
                    crudService.byId(id,'ediciones').then(function (data) {
                        $scope.edicion = data;

                        if($scope.edicion != null) {
                            if ($scope.edicion.fechaRegistro.length > 0) {
                                $scope.edicion.fechaRegistro = new Date($scope.edicion.fechaRegistro);
                            }
                        }
                    });
                }else{
                    crudService.paginate('ediciones',1).then(function (data) {
                        $scope.ediciones = data.data;
                        $scope.maxSize = 5;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                        $scope.itemsperPage = 15;

                    });
                }

                

                $scope.searchCurso= function(){
                if ($scope.query.length > 0) {
                    crudService.search('ediciones',$scope.query,1).then(function (data){
                        $scope.ediciones = data.data;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                    });
                }else{
                    crudService.paginate('ediciones',1).then(function (data) {
                        $scope.ediciones = data.data;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                    });
                }
                    
                };

                $scope.createEdicion = function(){
                    //$scope.atribut.estado = 1;
                    if ($scope.cursoCreateForm.$valid) {
                        if($scope.edicion.fechaRegistro!=null){
                            crudService.create($scope.edicion, 'ediciones').then(function (data) {
                          
                                if (data['estado'] == true) {
                                    $scope.success = data['nombres'];
                                    alert('Grabado correctamente');
                                    $location.path('/ediciones');

                                } else {
                                    $scope.errors = data;

                                }
                            });
                        }else{
                            alert('Selecione Fecha');  
                        }
                    }
                }


                $scope.editEdicion = function(row){
                    $location.path('/ediciones/edit/'+row.id);
                };

                $scope.updateEdicion = function(){

                    if ($scope.cursoEditForm.$valid) {
                        if($scope.edicion.fechaRegistro!=null){
                            crudService.update($scope.edicion,'ediciones').then(function(data)
                            {
                                if(data['estado'] == true){
                                    $scope.success = data['nombres'];
                                    alert('editado correctamente');
                                    $location.path('/ediciones');
                                }else{
                                    $scope.errors =data;
                                }
                            });
                        }else{
                            alert('Selecione Fecha');  
                        }
                    }
                };

                $scope.deleteEdicion= function(row){
                    
                    $scope.edicion = row;
                }

                $scope.cancelEdicion = function(){
                    $scope.edicion = {};
                }

                $scope.destroyEdicion = function(){
                    crudService.destroy($scope.edicion,'ediciones').then(function(data)
                    {
                        if(data['estado'] == true){
                            $scope.success = data['nombre'];
                            $scope.edicion = {};
                            //alert('hola');
                            $route.reload();

                        }else{
                            $scope.errors = data;
                        }
                    });
                }
            }]);
})();
