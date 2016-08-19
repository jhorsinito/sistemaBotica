 (function(){
    angular.module('personas.controllers',[])
        .controller('PersonaController',['$scope', '$routeParams','$location','crudService' ,'$filter','$route','$log',
            function($scope, $routeParams,$location,crudService,$filter,$route,$log){
                $scope.personas = [];
                $scope.persona = {};
                $scope.departamentos ={};
                $scope.depertamentoSelect;
                $scope.provincias ={};
                $scope.provinciaSelect;
                $scope.distritos ={};
                $scope.distritoSelect;
                $scope.errors = null;
                $scope.ubigeo ={};
                $scope.success;
                $scope.query = '';

                $scope.toggle = function () { 
                    $scope.show = !$scope.show; 
                };

                $scope.pageChanged = function() {
                    if ($scope.query.length > 0) {
                        crudService.search('personas',$scope.query,$scope.currentPage).then(function (data){
                        $scope.personas = data.data;
                    });
                    }else{
                        crudService.paginate('personas',$scope.currentPage).then(function (data) {
                            $scope.personas = data.data;
                        });
                    }
                };


                var id = $routeParams.id;

                if(id)
                {
                    crudService.byId(id,'personas').then(function (data) {
                        $scope.persona = data;
                        crudService.byId($scope.persona.ubigeo_id,'ubigeos').then(function (data) {
                            $scope.ubigeo = data;
                            crudService.all('ubigeoDepartamento').then(function(data){  
                                $scope.departamentos = data;
                                $scope.depertamentoSelect=$scope.ubigeo.departamento;
                            });
                            crudService.recuperarUnDato('ubigeoProvincia',$scope.ubigeo.departamento).then(function(data){  
                                $scope.provincias = data;
                                $scope.provinciaSelect=$scope.ubigeo.provincia;;
                            });
                            crudService.recuperarDosDato('ubigeoDistrito',$scope.ubigeo.departamento,$scope.ubigeo.provincia).then(function(data){  
                                $scope.distritos = data;
                                $scope.distritoSelect=$scope.ubigeo.id;
                            });
                        });
                    });
                    
                    

                }else{
                    crudService.paginate('personas',1).then(function (data) {
                        $scope.personas = data.data;
                        $scope.maxSize = 5;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                        $scope.itemsperPage = 15;

                    });

                    //-------------------------------------------------------------
                    
                    crudService.all('ubigeoDepartamento').then(function(data){  
                        $scope.departamentos = data;
                        //$scope.depertamentoSelect=data[0].departamento;
                    });
                    
                }

                

                $scope.searchAcreditadora = function(){
                if ($scope.query.length > 0) {
                    crudService.search('personas',$scope.query,1).then(function (data){
                        $scope.personas = data.data;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                    });
                }else{
                    crudService.paginate('personas',1).then(function (data) {
                        $scope.personas = data.data;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                    });
                }
                    
                };

                $scope.createAcreditadora = function(){
                    //$scope.atribut.estado = 1;
                    $log.log($scope.distritoSelect);
                    if ($scope.acreditadoraCreateForm.$valid) {
                        if($scope.distritoSelect!=null){
                            $scope.persona.ubigeo_id=$scope.distritoSelect;
                            crudService.create($scope.persona, 'personas').then(function (data) {
                          
                                if (data['estado'] == true) {
                                 $scope.success = data['nombres'];
                                    alert('grabado correctamente');
                                    $location.path('/personas');

                                } else {
                                    $scope.errors = data;

                                }
                            });
                        }else{
                            alert('Selecione Direcion Correctamente');
                        }
                    }
                }


                $scope.editAcreditadora = function(row){
                    $location.path('/personas/edit/'+row.id);
                };

                $scope.updateAcreditadora = function(){

                    if ($scope.acreditadoraEditForm.$valid) {
                        if($scope.distritoSelect!=null){
                            $scope.persona.ubigeo_id=$scope.distritoSelect;

                            crudService.update($scope.persona,'personas').then(function(data)
                            {
                                if(data['estado'] == true){
                                    $scope.success = data['nombres'];
                                    alert('editado correctamente');
                                    $location.path('/personas');
                                }else{
                                    $scope.errors =data;
                                }
                            });
                        }else{
                            alert('Selecione Direcion Correctamente');
                        }
                    }
                };

                $scope.deleteAcreditadora= function(row){
                    
                    $scope.persona = row;
                }

                $scope.cancelAcreditadora = function(){
                    $scope.persona = {};
                }

                $scope.destroyAcreditadora = function(){
                    crudService.destroy($scope.persona,'personas').then(function(data)
                    {
                        if(data['estado'] == true){
                            $scope.success = data['nombre'];
                            $scope.persona = {};
                            //alert('hola');
                            $route.reload();

                        }else{
                            $scope.errors = data;
                        }
                    });
                }
                $scope.cargarProvincia = function(){
                    $scope.provincias ={};
                    $scope.provinciaSelect=null;
                    $scope.distritoSelect=null;
                    crudService.recuperarUnDato('ubigeoProvincia',$scope.depertamentoSelect).then(function(data){  
                        $scope.provincias = data;
                        //$scope.provinciaSelect=data[0].provincia;
                    });
                }
                $scope.cargarDistrito = function(){
                    $scope.distritos ={};
                    $scope.distritoSelect=null;
                    crudService.recuperarDosDato('ubigeoDistrito',$scope.depertamentoSelect,$scope.provinciaSelect).then(function(data){  
                        $scope.distritos = data;
                        
                    });
                }


            }]);
})();
