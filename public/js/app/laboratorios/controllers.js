(function(){
    angular.module('laboratorios.controllers',[])
        .controller('LaboratorioController',['$scope', '$routeParams','$location','crudService' ,'$filter','$route','$log',
            function($scope, $routeParams,$location,crudService,$filter,$route,$log){
                $scope.laboratorios = [];
                $scope.laboratorio = {};
                $scope.errors = null;
                $scope.success;
                $scope.query = '';

                $scope.toggle = function () {
                    $scope.show = !$scope.show;
                };

                $scope.pageChanged = function() {
                    if ($scope.query.length > 0) {
                        crudService.search('laboratorios',$scope.query,$scope.currentPage).then(function (data){
                        $scope.laboratorios = data.data;
                    });
                    }else{
                        crudService.paginate('laboratorios',$scope.currentPage).then(function (data) {
                            $scope.laboratorios = data.data;
                        });
                    }
                };


                var id = $routeParams.id;

                if(id)
                {
                    crudService.byId(id,'laboratorios').then(function (data) {
                        $scope.laboratorio = data;
                    });
                }else{
                    crudService.paginate('laboratorios',1).then(function (data) {
                        $scope.laboratorios = data.data;
                        $scope.maxSize = 5;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                        $scope.itemsperPage = 15;

                    });
                }


                $scope.searchLaboratorio = function(){
                if ($scope.query.length > 0) {
                    crudService.search('laboratorios',$scope.query,1).then(function (data){
                        $scope.laboratorios = data.data;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                    });
                }else{
                    crudService.paginate('laboratorios',1).then(function (data) {
                        $scope.laboratorios = data.data;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                    });
                }
                    
                };
                 $scope.validanomLaboratorio=function(texto){
                
                   if(texto!=undefined){
                        crudService.validar('laboratorios',texto).then(function (data){
                        $scope.laboratorio = data;
                        if($scope.laboratorio!=null){
                           alert("Usted no puede crear dos Laboratorios con el mismo nombre");
                           $scope.laboratorio.nombre=''; 
                           $scope.laboratorio.shortname=''; 
                        }
                    });
                    }
               }

                $scope.createLaboratorio = function(){
                    //$scope.atribut.estado = 1;
                    if ($scope.LaboratorioCreateForm.$valid) {
                        crudService.create($scope.laboratorio, 'laboratorios').then(function (data) {
                          
                            if (data['estado'] == true) {
                                $scope.success = data['nombres'];
                                alert('grabado correctamente');
                                $location.path('/laboratorios');

                            } else {
                                $scope.errors = data;

                            }
                        });
                    }
                }


                $scope.editLaboratorio = function(row){
                    $location.path('/laboratorios/edit/'+row.id);
                };

                $scope.updateLaboratorio = function(){

                    if ($scope.LaboratorioCreateForm.$valid) {
                        crudService.update($scope.laboratorio,'laboratorios').then(function(data)
                        {
                            if(data['estado'] == true){
                                $scope.success = data['nombres'];
                                alert('editado correctamente');
                                $location.path('/laboratorios');
                            }else{
                                $scope.errors =data;
                            }
                        });
                    }
                };

                $scope.deleteLaboratorio = function(row){
                    $scope.laboratorio = row;
                }

                $scope.cancelLaboratorio = function(){
                    $scope.laboratorio = {};
                }

                $scope.destroyLaboratorio = function(){
                    crudService.destroy($scope.laboratorio,'laboratorios').then(function(data)
                    {
                        if(data['estado'] == true){
                            $scope.success = data['nombre'];
                            $scope.laboratorio = {};
                            //alert('hola');
                            $route.reload();

                        }else{
                            $scope.errors = data;
                        }
                    });
                }
            }]);
})();