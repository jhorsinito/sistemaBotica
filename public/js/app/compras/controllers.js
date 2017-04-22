(function(){
    angular.module('compras.controllers',[])
        .controller('CompraController',['$scope', '$routeParams','$location','crudService' ,'$filter','$route','$log',
            function($scope, $routeParams,$location,crudService,$filter,$route,$log){
                $scope.compras = [];
                $scope.compra = {};
                $scope.errors = null;
                $scope.success;
                $scope.query = '';
                $scope.proveedores={};
                $scope.users={};
                $scope.metodoPagos={};
                $scope.comprobantes={};
                $scope.compra.estado = true;
           
                $scope.toggle = function () { 
                    $scope.show = !$scope.show; 
                };

                $scope.pageChanged = function() {
                    if ($scope.query.length > 0) {
                        crudService.search('compras',$scope.query,$scope.currentPage).then(function (data){
                        $scope.compras = data.data;
                    });
                    }else{
                        crudService.paginate('compras',$scope.currentPage).then(function (data) {
                            $scope.compras = data.data;
                            
                        });
                    }
                };


                var id = $routeParams.id;

                if(id)
                {
                    crudService.byId(id,'compras').then(function (data) {
                        $scope.compra = data;
                    });

                }else{
                    crudService.paginate('compras',1).then(function (data) {
                        $scope.compras = data.data;
                        $scope.maxSize = 5;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                        $scope.itemsperPage = 15;
                        $log.log($scope.compras);
                    });
                    crudService.all('proveedoresAll',1).then(function (data) {
                        $scope.proveedores=data;
                        $log.log($scope.proveedores);
                    });

                    crudService.all('usersAll',1).then(function (data) {
                        $scope.users=data;
                        $log.log($scope.users);
                    });
                    crudService.all('metodoPagosAll',1).then(function (data) {
                        $scope.metodoPagos=data;
                        $log.log($scope.metodoPagos);
                    });
                    crudService.all('comprobantesAll',1).then(function (data) {
                        $scope.comprobantes=data;
                        $log.log($scope.comprobantes);
                    });
                   
                }

                

                $scope.searchCompra= function(){
                if ($scope.query.length > 0) {
                    crudService.search('compras',$scope.query,1).then(function (data){
                        $scope.compras = data.data;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                    });
                }else{
                    crudService.paginate('compras',1).then(function (data) {
                        $scope.compras = data.data;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                    });
                }
                    
                };

                $scope.disableCompra = function(row){
                crudService.byforeingKey('compras','disablecompra',row.CompId).then(function(data)
                    {
                        if(data['estado'] == true){
                            $route.reload();
                        }else{
                            alert('No se pudo cambiar el estado');
                        }
                    });
                }   

                $scope.validanomCompra=function(texto){
                
                   if(texto!=undefined){
                        crudService.validar('compras',texto).then(function (data){
                        $scope.compra = data;
                        if($scope.compra!=null){
                           alert("Usted no puede crear dos Compras con el mismo nombre");
                           $scope.compra.nombre=''; 
                           $scope.compra.descripcion=''; 
                        }
                    });
                    }
               }
                $scope.createCompra= function(){
                    //$scope.atribut.estado = 1;
                 
                    if ($scope.compraCreateForm.$valid) {
                        $scope.compra
                        crudService.create($scope.compra, 'compras').then(function (data) {
                          
                            if (data['estado'] == true) {
                                $scope.success = data['nombres'];
                                alert('grabado correctamente');
                                $location.path('/compras');

                            } else {
                                $scope.errors = data;

                            }
                        });
                    }
                }


                $scope.editCompra= function(row){
                    $location.path('/compras/edit/'+row.id);
                };

                $scope.updateCompra= function(){

                    if ($scope.compraEditForm.$valid) {
                        crudService.update($scope.compra,'compras').then(function(data)
                        {
                            if(data['estado'] == true){
                                $scope.success = data['proveedor_id'];
                                alert('editado correctamente');
                                $location.path('/compras');
                            }else{
                                $scope.errors =data;
                            }
                        });
                    }
                };

                $scope.deleteCompra= function(row){
                    
                    $scope.compra = row;
                }

                $scope.cancelCompra = function(){
                    $scope.compra = {};
                }

                $scope.destroyCompra = function(){
                    crudService.destroy($scope.compra,'compras').then(function(data)
                    {
                        if(data['estado'] == true){
                            $scope.success = data['nombre'];
                            $scope.compra = {};
                            //alert('hola');
                            $route.reload();

                        }else{
                            $scope.errors = data;
                        }
                    });
                }
            }]);
})();