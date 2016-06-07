(function(){
    angular.module('categories.controllers',[])
        .controller('CategoryController',['$scope', '$routeParams','$location','crudService','socketService' ,'$filter','$route','$log',
            function($scope, $routeParams,$location,crudService,socket,$filter,$route,$log){
                $scope.categories = [];
                $scope.category = {};
                $scope.errors = null;
                $scope.success;
                $scope.query = '';

                $scope.toggle = function () {
                    $scope.show = !$scope.show;
                };

                $scope.pageChanged = function() {
                    if ($scope.query.length > 0) {
                        crudService.search('categories',$scope.query,$scope.currentPage).then(function (data){
                        $scope.categories = data.data;
                    });
                    }else{
                        crudService.paginate('categories',$scope.currentPage).then(function (data) {
                            $scope.categories = data.data;
                        });
                    }
                };


                var id = $routeParams.id;

                if(id)
                {
                    crudService.byId(id,'categories').then(function (data) {
                        $scope.category = data;
                    });
                }else{
                    crudService.paginate('categories',1).then(function (data) {
                        $scope.categories = data.data;
                        $scope.maxSize = 5;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                        $scope.itemsperPage = 15;

                    });
                }

                socket.on('category.update', function (data) {
                    $scope.categories=JSON.parse(data);
                });

                $scope.searchCategory = function(){
                if ($scope.query.length > 0) {
                    crudService.search('categories',$scope.query,1).then(function (data){
                        $scope.categories = data.data;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                    });
                }else{
                    crudService.paginate('categories',1).then(function (data) {
                        $scope.categories = data.data;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                    });
                }
                    
                };

                $scope.createCategory = function(){
                    //$scope.atribut.estado = 1;
                    if ($scope.categoryCreateForm.$valid) {
                        crudService.create($scope.category, 'categories').then(function (data) {
                          
                            if (data['estado'] == true) {
                                $scope.success = data['nombres'];
                                alert('grabado correctamente');
                                $location.path('/categories');

                            } else {
                                $scope.errors = data;

                            }
                        });
                    }
                }


                $scope.editCategory = function(row){
                    $location.path('/categories/edit/'+row.id);
                };

                $scope.updateCategory = function(){

                    if ($scope.categoryCreateForm.$valid) {
                        crudService.update($scope.category,'categories').then(function(data)
                        {
                            if(data['estado'] == true){
                                $scope.success = data['nombres'];
                                alert('editado correctamente');
                                $location.path('/categories');
                            }else{
                                $scope.errors =data;
                            }
                        });
                    }
                };
                 $scope.validanomCategory=function(texto){
                 alert("hola");
                   if(texto!=undefined){
                        crudService.validar('categories',texto).then(function (data){
                        $scope.category = data;
                        alert($scope.category);
                        if(data!=null){
                           alert("Usted no puede crear dos Marcas con el mismo nombre");
                           $scope.category.nombre=''; 
                           $scope.category.shortname=''; 
                        }
                    });
                    }
               }
                $scope.deleteCategory = function(row){
                    
                    $scope.category = row;
                }

                $scope.cancelCategory = function(){
                    $scope.category = {};
                }

                $scope.destroyCategory = function(){
                    crudService.destroy($scope.category,'categories').then(function(data)
                    {
                        if(data['estado'] == true){
                            $scope.success = data['nombre'];
                            $scope.category = {};
                            //alert('hola');
                            $route.reload();

                        }else{
                            $scope.errors = data;
                        }
                    });
                }
            }]);
})();
