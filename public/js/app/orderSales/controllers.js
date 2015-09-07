(function(){
    angular.module('orderSales.controllers',[])
        .controller('OrderSalesController',['$scope', '$routeParams','$location','crudServiceOrderSales','socketService' ,'$filter','$route','$log','$modal',
            function($scope, $routeParams,$location,crudServiceOrderSales,socket,$filter,$route,$log,$modal){
                $scope.orderSales = [];
                $scope.orderSale = {};
                $scope.errors = null; 
                $scope.success;
                $scope.query = '';
                $scope.store={};
                $scope.warehouse={};
                $scope.warehouse.id='1';
                $scope.store.id='1';
                $scope.cash1={};
                $scope.cash1.cashHeader_id='1';
                $scope.base=true;
                $scope.skuestado=true;
                $scope.compras=[];
                $scope.sale={};
                

                $scope.toggle = function () {
                    $scope.show = !$scope.show;
                };

                $scope.pageChanged = function() {
                    if ($scope.query.length > 0) {
                        crudServiceOrderSales.search('orderSales',$scope.query,$scope.currentPage).then(function (data){
                        $scope.orderSales = data.data;
                    });
                    }else{
                        crudServiceOrderSales.paginate('orderSales',$scope.currentPage).then(function (data) {
                            $scope.orderSales = data.data;
                        });
                    }
                };


                var id = $routeParams.id;

                if(id)
                {
                    crudServiceOrderSales.byId(id,'orderSales').then(function (data) {
                        $scope.orderSale = data;
                    });
                }else{
                    crudServiceOrderSales.paginate('orderSales',1).then(function (data) {
                        $scope.orderSales = data.data;
                        $scope.maxSize = 5;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                        $scope.itemsperPage = 15;

                    });

                    crudServiceOrderSales.select('stores','select').then(function (data) {                        
                        $scope.stores = data;

                    });
                    crudServiceOrderSales.search('warehousesStore',$scope.store.id,1).then(function (data){
                        $scope.warehouses=data.data;
                    });
                    crudServiceOrderSales.search('searchHeaders',$scope.store.id,1).then(function (data){
                        $scope.cashHeaders=data;
                    });
                }

                socket.on('orderSale.update', function (data) {
                    $scope.orderSales=JSON.parse(data);
                });


                $scope.dynamicPopover = {
                    content: 'Hello, World!',
                    templateUrl: 'myPopoverTemplate.html',
                    title: 'Quantity'
                };

                $scope.dynamicPopover1 = {
                    content: 'Hello, World!',
                    templateUrl: 'myPopoverTemplate1.html',
                    title: 'Precio',
                    title1: 'Descuento'
                };

                $scope.dynamicPopover5 = { 
                    content: 'Hello, World!',
                    templateUrl: 'myPopoverTemplate5.html',
                    title: 'Datos'
                };

                $scope.dynamicPopover2 = {
                    content: 'Hello, World!',
                    templateUrl: 'myPopoverTemplate2.html',
                    title: 'Preciodd',
                    title1: 'Descuento'
                };
                $scope.dynamicPopover6 = {
                    content: 'Hello, World!',
                    templateUrl: 'myPopoverTemplate6.html',
                    title: 'Notas',
                };
                $scope.atributoSelected=undefined;
                $scope.getAtributos = function(val) {
                  return crudServiceOrderSales.reportProWare('products',$scope.store.id,$scope.warehouse.id,val).then(function(response){
                    return response.map(function(item){
                      return item;
                    });
                  });
                };

                $scope.varianteSkuSelected;
                $scope.varianteSkuSelected1=undefined;
                $scope.getvariantSKU = function(size) {
                    if($scope.varianteSkuSelected.length <10){
                    }else if($scope.varianteSkuSelected.length==10){
                        crudServiceOrderSales.reportProWare('productsSearchsku',$scope.store.id,$scope.warehouse.id,$scope.varianteSkuSelected).then(function(data){    
                            $scope.varianteSkuSelected1={};
                            $scope.varianteSkuSelected1=data;

                            //if ($scope.varianteSkuSelected1[0].Stock>0) { 
                                $scope.Jalar(size);
                            //}else{
                              //  alert("STOCK INSUFICIENTE");
                                //$scope.varianteSkuSelected=undefined;
                            //}                                                          
                        });
                    }
                };
                $scope.Jalar = function(size) {
                    if ($scope.varianteSkuSelected1.length>0) {
                        crudServiceOrderSales.reportProWare('productsVariantes',$scope.store.id,$scope.warehouse.id,$scope.varianteSkuSelected1[0].vari).then(function(data){    
                            $scope.presentations = data;
                            if($scope.base){                
                                    $scope.varianteSkuSelected1[0].cantidad=1;
                                    $scope.varianteSkuSelected1[0].descuento=0;
                                    $scope.varianteSkuSelected1[0].subTotal=$scope.varianteSkuSelected1[0].cantidad*Number($scope.varianteSkuSelected1[0].precioProducto);
                                    $scope.varianteSkuSelected1[0].precioVenta=Number($scope.varianteSkuSelected1[0].precioProducto);
                        
                                   $scope.compras.push($scope.varianteSkuSelected1[0]);  
    
                                    $scope.sale.montoTotal=$scope.sale.montoTotalSinDescuento+$scope.varianteSkuSelected1[0].subTotal;
                                    $scope.recalcularCompra();

                               $scope.varianteSkuSelected1=undefined;
                                $scope.varianteSkuSelected="";
    
                            }else{                           
                                var modalInstance = $modal.open({      
                                    templateUrl: 'myModalContent.html',
                                    controller: 'ModalInstanceCtrl',
                                    size: size,
                                    resolve: {
                                        presentations: function () {
                                          return $scope.presentations;
                                        }                                    
                                    }
                                })
                                $scope.varianteSkuSelected1=undefined;
                                $scope.varianteSkuSelected="";
                            }
                        });
                    }else{
                        alert("Ingrese SKU Correctamente");
                        $scope.varianteSkuSelected1=undefined;
                        $scope.varianteSkuSelected="";
                    } 
                }

                $scope.recalcularCompra=function(){
                    $scope.sale.montoTotalSinDescuento=$scope.sale.montoTotal;
                    $scope.sale.montoTotal=((100-Number($scope.sale.descuento))*Number($scope.sale.montoTotalSinDescuento))/100;    

                    $scope.sale.montoBruto=Number($scope.sale.montoTotal)/1.18;
                    $scope.sale.igv=$scope.sale.montoTotal-$scope.sale.montoBruto;  
                };


                
            }]);

})();
