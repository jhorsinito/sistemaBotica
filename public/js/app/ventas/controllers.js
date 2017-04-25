(function(){
    angular.module('ventas.controllers',[])
        .controller('VentaController',['$scope', '$routeParams','$location','crudService' ,'$filter','$route','$log','ngProgressFactory','$rootScope','trouble','$window','$modal',
            function($scope, $routeParams,$location,crudService,$filter,$route,$log,ngProgressFactory,$rootScope,trouble,$window,$modal){
                $scope.progressbar = ngProgressFactory.createInstance();

$scope.ventas = [];
$scope.venta = {};
$scope.vventa = {};
$scope.errors;
$scope.success;
$scope.query = ''; 
$scope.tiendas = {};
$scope.clientes = {};
$scope.comprobantes = {};

$scope.venta.estado = true;
$scope.venta.estado2 = true;

            $scope.addTienda = function (size) {

               var modalInstance = $modal.open({
                animation: false,
                 templateUrl: 'myModalContent.html',
                 controller: 'ModalInstanceCtrl',
                    size: 'sm',
                    });

            modalInstance.result.then(function (selectedItem) {
                     
                }, function () {
             crudService.select('ventas', 'tiendas').then(function (data) {
                    $scope.tiendas = data;
                        });

                    });
                };

             $scope.addComprobante = function (size) {

                    var modalInstance = $modal.open({
                        animation: false,
                        templateUrl: 'myModalContent2.html',
                        controller: 'ModalInstanceCtrl2',
                        size: 'sm',   
                    });
                    modalInstance.result.then(function (selectedItem) {
                    }, function () {
                        crudService.select('ventas', 'comprobantes').then(function (data) {
                            $scope.comprobantes = data;
                        });

                    });
                };

                  $scope.addCliente = function (size) {

                    var modalInstance = $modal.open({
                        animation: false,
                        templateUrl: 'myModalContent3.html',
                        controller: 'ModalInstanceCtrl3',
                        size: 'sm',   
                    });
                    modalInstance.result.then(function (selectedItem) {
                    }, function () {
                        crudService.select('ventas', 'clientes').then(function (data) {
                            $scope.clientes = data;
                        });

                    });
                };

                $scope.toggle = function () {
                    $scope.show = !$scope.show;
    angular.module('almacenes.controllers',[])
        .controller('AlmacenController',['$scope', '$routeParams','$location','crudService' ,'$filter','$route','$log',
            function($scope, $routeParams,$location,crudService,$filter,$route,$log){
                $scope.almacenes = [];
                $scope.almacen = {};
                $scope.errors = null;
                $scope.success;
                $scope.query = '';
                $scope.tiendas={};

                $scope.toggle = function () { 
                    $scope.show = !$scope.show; 
                };

                $scope.pageChanged = function() {
                    if ($scope.query.length > 0) {
                        crudService.search('ventas',$scope.query,$scope.currentPage).then(function (data){
                        $scope.ventas = data.data;
                    });
                    }else{
                        crudService.paginate('ventas',$scope.currentPage).then(function (data) {
                            $scope.ventas = data.data;

                        crudService.search('almacenes',$scope.query,$scope.currentPage).then(function (data){
                        $scope.almacenes = data.data;
                    });
                    }else{
                        crudService.paginate('almacenes',$scope.currentPage).then(function (data) {
                            $scope.almacenes = data.data;
                            
                        });
                    }
                };

                var id = $routeParams.id;

                   if(id)
                {
                    crudService.byId(id,'ventas').then(function (data) {
                        $scope.venta = data;
                    });
                }

                if(id)
                {
                    if($location.path() == '/ventas/edit/'+$routeParams.id) {
                             crudService.paginate('ventas',1).then(function (data) {
                          $scope.ventas = data.data;

                             $scope.ventas = data.data;
                             $scope.maxSize = 5;
                             $scope.totalItems = data.total;
                             $scope.currentPage = data.current_page;
                             $scope.itemsperPage = 15;
                                });
                       
                        crudService.select('ventas', 'tiendas').then(function (data) {
                            $scope.tiendas = data;
                        });
                        crudService.select('ventas', 'comprobantes').then(function (data) {
                            $scope.comprobantes = data;
                        });
                        crudService.select('ventas', 'clientes').then(function (data) {
                            $scope.clientes = data;
                        });
                          crudService.select('ventas', 'products').then(function (data) {
                            $scope.products = data;
                        });
    
                    };

                }else{
                    crudService.paginate('ventas',1).then(function (data) {
                        $scope.ventas = data.data;

                var id = $routeParams.id;

                if(id)
                {
                    crudService.byId(id,'almacenes').then(function (data) {
                        $scope.almacen = data;
                    });

                }else{
                    crudService.paginate('almacenes',1).then(function (data) {
                        $scope.almacenes = data.data;
                        $scope.maxSize = 5;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                        $scope.itemsperPage = 15;

                   });

                    } 

                    if($location.path() == '/ventas/create') {
                        crudService.paginate('ventas',1).then(function (data) {
                        $scope.ventas = data.data;
                        });
                        crudService.select('ventas', 'tiendas').then(function (data) {
                            $scope.tiendas = data;
                        });

                        crudService.select('ventas', 'comprobantes').then(function (data) {
                            $scope.comprobantes = data;
                        });
                        crudService.select('ventas', 'clientes').then(function (data) {
                            $scope.clientes = data;
                        });

                        crudService.select('ventas', 'products').then(function (data) {
                            $scope.products = data;
                        });
                    }

                $scope.searchVenta = function(){
                if ($scope.query.length > 0) {
                    crudService.search('ventas',$scope.query,1).then(function (data){
                        $scope.ventas = data.data;
                        $log.log($scope.almacenes);
                    });
                    crudService.all('tiendasAll',1).then(function (data) {
                        $scope.tiendas=data;
                        $log.log($scope.tiendas);
                    });
                }

                

                $scope.searchAlmacen= function(){
                if ($scope.query.length > 0) {
                    crudService.search('almacenes',$scope.query,1).then(function (data){
                        $scope.almacenes = data.data;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                    });
                }else{
                    crudService.paginate('ventas',1).then(function (data) {
                        $scope.ventas = data.data;
                    crudService.paginate('almacenes',1).then(function (data) {
                        $scope.almacenes = data.data;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                    });
                }
                    
                };

                $scope.createVenta = function(){
                      
                      if ($scope.ventaCreateForm.$valid){        
                        crudService.create($scope.venta, 'ventas').then(function (data) {
                          
                            if (data['estado'] == true) {
                                $scope.success = data['nombres'];
                                alert('Venta Grabada Correctamente');
                                $location.path('/ventas');

                $scope.createAlmacen= function(){
                    //$scope.atribut.estado = 1;
                 
                    if ($scope.almacenCreateForm.$valid) {
                        $scope.almacen
                        crudService.create($scope.almacen, 'almacenes').then(function (data) {
                          
                            if (data['estado'] == true) {
                                $scope.success = data['nombres'];
                                alert('grabado correctamente');
                                $location.path('/almacenes');

                            } else {
                                $scope.errors = data;

                            }
                        });
                    }
                }

                $scope.editVenta = function(row){
                    $location.path('/ventas/edit/'+row.proId);
                };

                $scope.updateVenta = function(){

                    if ($scope.VentaEditForm.$valid) {
                        crudService.update($scope.venta,'ventas').then(function(data)
                        {
                            if(data['estado'] == true){
                                $scope.success = data['nombres'];
                                alert('Venta Editada Correctamente');
                                $location.path('/ventas');


                $scope.editAlmacen= function(row){
                    $location.path('/almacenes/edit/'+row.id);
                };

                $scope.updateAlmacen = function(){

                    if ($scope.AlmacenEditForm.$valid) {
                        crudService.update($scope.almacen,'almacenes').then(function(data)
                        {
                            if(data['estado'] == true){
                                $scope.success = data['nombres'];
                                alert('editado correctamente');
                                $location.path('/almacenes');
                            }else{
                                $scope.errors =data;
                            }
                        });
                    }
                };

                $scope.deleteVenta = function(row){
                    $scope.venta = row;
                }

                $scope.cancelVenta = function(){
                    $scope.venta = {};
                }

                $scope.destroyVenta = function(){
                    crudService.destroy($scope.venta,'ventas').then(function(data)
                    {
                        if(data['estado'] == true){
                            $scope.success = data['nombre'];
                            $scope.venta = {};
                            $route.reload();

                $scope.deleteAlmacen= function(row){
                    
                    $scope.almacen = row;
                }

                $scope.cancelAlmacen = function(){
                    $scope.almacen = {};
                }

                $scope.destroyAlmacen = function(){
                    crudService.destroy($scope.almacen,'almacenes').then(function(data)
                    {
                        if(data['estado'] == true){
                            $scope.success = data['nombre'];
                            $scope.almacen = {};
                            //alert('hola');
                            $route.reload();

                        }else{
                            $scope.errors = data;
                        }
                    });
                }

               $scope.disableVenta = function(row){
                crudService.byforeingKey('ventas','disableprod',row.proId).then(function(data)
                    {
                        if(data['estado'] == true){
                            $route.reload();
                        }else{
                            alert('No se pudo cambiar el estado');
                        }
                    });
                }        

               $scope.validarNombre=function(){
                   alert("Usted no puede crear dos Ventas con el mismo nombre");
                   $scope.venta.nombre='';
                   crudService.paginate('ventas',1).then(function (data) {
                        $scope.ventas = data.data;
                   });
               }
               $scope.validaNombre2=function(texto){
                 if(texto!=undefined){
                   
                  crudService.validar('ventas',texto).then(function (data){
                        if(data.nombre!=undefined){
                           alert("Usted no puede crear dos Ventas con el mismo nombre");
                           $scope.venta.nombre=''; 
                        }
                    });
                 }
               }

               $scope.validacodigo=function(texto){
                 if(texto!=undefined){
                  crudService.validar('ventasCodigo',texto).then(function (data){
                        if(data.codigo!=undefined){
                           alert("Usted no puede crear dos Ventas con el mismo codigo");
                           $scope.venta.codigo=''; 
                        }
                    });
                 }
               }
            }]);
})();