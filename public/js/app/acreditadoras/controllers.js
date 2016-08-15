 (function(){
    angular.module('acreditadoras.controllers',[])
        .controller('AcreditadoraController',['$scope', '$routeParams','$location','crudService' ,'$filter','$route','$log',
            function($scope, $routeParams,$location,crudService,$filter,$route,$log){
                $scope.acreditadoras = [];
                $scope.acreditadora = {};
                $scope.errors = null;
                $scope.success;
                $scope.query = '';

                $scope.toggle = function () {
                    $scope.show = !$scope.show; 
                };

                $scope.pageChanged = function() {
                    if ($scope.query.length > 0) {
                        crudService.search('acreditadoras',$scope.query,$scope.currentPage).then(function (data){
                        $scope.acreditadoras = data.data;
                    });
                    }else{
                        crudService.paginate('acreditadoras',$scope.currentPage).then(function (data) {
                            $scope.acreditadoras = data.data;
                        });
                    }
                };


                var id = $routeParams.id;

                if(id)
                {
                    crudService.byId(id,'acreditadoras').then(function (data) {
                        $scope.acreditadora = data;
                    });
                }else{
                    crudService.paginate('acreditadoras',1).then(function (data) {
                        $scope.acreditadoras = data.data;
                        $scope.maxSize = 5;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                        $scope.itemsperPage = 15;

                    });
                }

                

                $scope.searchAcreditadora = function(){
                if ($scope.query.length > 0) {
                    crudService.search('acreditadoras',$scope.query,1).then(function (data){
                        $scope.acreditadoras = data.data;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                    });
                }else{
                    crudService.paginate('acreditadoras',1).then(function (data) {
                        $scope.acreditadoras = data.data;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                    });
                }
                    
                };

                $scope.createAcreditadora = function(){
                    //$scope.atribut.estado = 1;
                    if ($scope.ubigeoCreateForm.$valid) {
                        crudService.create($scope.acreditadora, 'acreditadoras').then(function (data) {
                          
                            if (data['estado'] == true) {
                                $scope.success = data['nombres'];
                                alert('grabado correctamente');
                                $location.path('/acreditadoras');

                            } else {
                                $scope.errors = data;

                            }
                        });
                    }
                }


                $scope.editAcreditadora = function(row){
                    $location.path('/acreditadoras/edit/'+row.id);
                };

                $scope.updateAcreditadora = function(){

                    if ($scope.ubigeoCreateForm.$valid) {
                        crudService.update($scope.acreditadora,'acreditadoras').then(function(data)
                        {
                            if(data['estado'] == true){
                                $scope.success = data['nombres'];
                                alert('editado correctamente');
                                $location.path('/acreditadoras');
                            }else{
                                $scope.errors =data;
                            }
                        });
                    }
                };

                $scope.deleteAcreditadora= function(row){
                    
                    $scope.acreditadora = row;
                }

                $scope.cancelAcreditadora = function(){
                    $scope.acreditadora = {};
                }

                $scope.destroyAcreditadora = function(){
                    crudService.destroy($scope.acreditadora,'acreditadoras').then(function(data)
                    {
                        if(data['estado'] == true){
                            $scope.success = data['nombre'];
                            $scope.acreditadora = {};
                            //alert('hola');
                            $route.reload();

                        }else{
                            $scope.errors = data;
                        }
                    });
                }
            }]);
})();
