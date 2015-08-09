(function(){
    angular.module('purchases.controllers',[])
        .controller('PurchaseController',['$scope', '$routeParams','$location','crudPurchase','socketService' ,'$filter','$route','$log',
            function($scope, $routeParams,$location,crudPurchase,socket,$filter,$route,$log){
                $scope.purchases = [];
                $scope.purchase = {};
                $scope.products = [];
                $scope.product = {};
                $scope.detailPurchases = [];
                $scope.detailPurchase = {};
                $scope.errors = null;
                $scope.success;
                $scope.query = '';
                $scope.warehouses;
                $scope.purchase.fechaPedido=new Date();
                $scope.variants={};

                $scope.suppliers;
                $scope.supplier ;
                $scope.purchase.suppliers_id;
                $scope.detailPurchase.preProducto;
                $scope.detailPurchase.nombre;
                $scope.purchase.montoBruto=0.00;
                $scope.purchase.montoTotal=0.00;
                $scope.purchase.descuento=0.00;
                $scope.codigoTemporalP;
                $scope.purchase.warehouses_id;
                $scope.detailPurchase.variants_id;
                $scope.detailPurchase.purchases_id=0;
                $scope.mostrarVariantes=false;
                $scope.fechMinima=String(new Date().toJSON().slice(0,10));
                $scope.idtemporalP;
                $scope.toggle = function () {
                    $scope.show = !$scope.show;
                };


                $scope.pageChanged = function() {
                    if ($scope.query.length > 0) {
                        crudPurchase.search('purchases',$scope.query,$scope.currentPage).then(function (data){
                        $scope.purchases = data.data;
                    });
                    }else{
                        crudPurchase.paginate('purchases',$scope.currentPage).then(function (data) {
                            $scope.purchases = data.data;
                        });
                    }
                };


                var id = $routeParams.id;

                if(id)
                {
                    crudPurchase.byId(id,'purchases').then(function (data) {
                        if(data.fechaPedido != null) {
                            if (data.fechaPedido.length > 0) {
                                data.fechaPedido = new Date(data.fechaPedido);
                            }
                        }
                        if(data.fechaPrevista != null) {
                            if (data.fechaPrevista.length > 0) {
                                data.fechaPrevista = new Date(data.fechaPrevista);
                                alert(data.fechaPrevista);
                            }
                        }
                        $scope.purchase.montoBruto=parseFloat(data.montoBruto);
                        $scope.purchase.montoTotal=data.montoTotal;
                        $scope.purchase.descuento=20;                      

                        $scope.purchase = data;
                        $scope.idtemporalP=data.suppliers_id;
                        crudPurchase.traerEmpresa($scope.idtemporalP).then(function (data) { 
                        $scope.purchase.empresa = data.empresa;
                    });
                        
                         crudPurchase.paginateDPedido(data.id,'detailpurchases').then(function (data) {
                        
                        $scope.detailPurchases = data.data;
                        $scope.maxSize = 5;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                        $scope.itemsperPage = 15;
                       
                    });

                    });
                    crudPurchase.select('warehouses','select').then(function(data){
                        $scope.warehouses = data;
                    });
                    
                    

                }else{
                    crudPurchase.paginate('purchases',1).then(function (data) {
                        $scope.purchases = data.data;
                        $scope.maxSize = 5;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                        $scope.itemsperPage = 15;

                    });
                   
                    crudPurchase.select('warehouses','select').then(function(data){
                        $scope.warehouses = data;
                    });
                     
                }

                socket.on('purchase.update', function (data) {
                    $scope.purchases=JSON.parse(data);
                });
            
                $scope.asignarEmpresa=function(row){
                    $scope.purchase.suppliers_id=row.id;
                    $scope.purchase.empresa=row.empresa;
                }
                $scope.seleccionarWarehouse=function(){
                    alert($scope.purchase.warehouses_id);
                }
                $scope.searchsupplier=function(){
                 crudPurchase.paginate('suppliers',1).then(function (data) {
                        $scope.suppliers = data.data;
                        $scope.maxSize = 5;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                        $scope.itemsperPage = 15;
                       
                    });
                    }
                    //=========================================
                    //=========================================
                $scope.searchProduct=function(){
                 crudPurchase.paginate('products',1).then(function (data) {
                        $scope.products = data.data;
                        //$log.log(data.data);
                        $scope.maxSize = 5;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                        $scope.itemsperPage = 15;
                       
                    });
                    }
                    $scope.editRow=function(row){
                        
                    }
                    $scope.asignarProduc=function(row){
                         $scope.product.id=row.proNombre;
                         if(parseInt(row.TieneVariante)>0){
                               $scope.mostrarVariantes=true;
                            }else{
                                alert("No tiene Variantes");
                                $scope.mostrarVariantes=false;
                            }
                         crudPurchase.bytraervar(row.proId,'variants').then(function (data) {
                         $scope.variants= data;
                         $scope.detailPurchase.preProducto=row.precioProducto;
                         $scope.detailPurchase.nombre=row.proNombre;
                         
                     
                         
                    });
                     
                    }
                    $scope.seleccionar=function(){
                       
                        $id=$scope.variants.id;
                         alert("me selecionaste"+$id);
                        crudPurchase.byId($id,'variants').then(function (data) {
                        //$scope.variants = data;
                        $scope.detailPurchase.CodigoPCompra=data.sku;
                        $scope.detailPurchase.preCompra=data.suppPri;
                        alert($scope.detailPurchase.CodigoPCompra);
                    });
                        
                    }
                    $scope.AgregarProducto=function(){
                        
                        
                        if($scope.codigoTemporalP>0){
                        $scope.detailPurchase.variants_id=$scope.variants.id;
                        $scope.detailPurchase.purchases_id=$scope.codigoTemporalP;
                        alert($scope.detailPurchase.purchases_id);
                        $log.log($scope.detailPurchase);
                        $scope.detailPurchases.push($scope.detailPurchase);
                        $log.log($scope.detailPurchases);
                        $scope.purchase.detailPurchases=$scope.detailPurchases;
                        //---------------------------------------------------------
                        $scope.purchase.montoBruto= $scope.purchase.montoBruto+$scope.detailPurchase.montoTotal;
                        $scope.purchase.montoTotal=$scope.purchase.montoBruto-(($scope.purchase.montoBruto*$scope.purchase.descuento)/100);
                        $scope.purchases.push($scope.Purchase);
                        $scope.detailPurchase = {};
                        $scope.variants={};
                        $scope.product.id='';
                        }else{ alert ("!!Usted Debe Lenar a la cabecera del formulario para poder agregar!!")}
                    }
                    $scope.calcularmontoBrutoF=function(){
                        $scope.purchase.montoTotal=$scope.purchase.montoBruto - parseFloat(($scope.purchase.montoBruto*$scope.purchase.descuento)/100);
                    }
                    $scope.calculateSuppPric=function()
                    {
                        $scope.detailPurchase.montoBruto=$scope.detailPurchase.cantidad * parseFloat($scope.detailPurchase.preCompra);
                        if($scope.detailPurchase.descuento>0){
                        $scope.detailPurchase.montoTotal= $scope.detailPurchase.montoBruto - (($scope.detailPurchase.montoBruto * $scope.detailPurchase.descuento ) / 100);
                       }else{
                        $scope.detailPurchase.montoTotal= $scope.detailPurchase.montoBruto;
                       }
                    }
                    $scope.calculateTotalPrice=function(){
                        $scope.detailPurchase.montoTotal= $scope.detailPurchase.montoBruto - (($scope.detailPurchase.montoBruto * $scope.detailPurchase.descuento ) / 100);
                    }
                    //===========================================
                    //===========================================
                $scope.searchPurchase = function(){
                if ($scope.query.length > 0) {
                    crudPurchase.search('purchases',$scope.query,1).then(function (data){
                        $scope.purchases = data.data;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                    });
                }else{
                    crudPurchase.paginate('purchases',1).then(function (data) {
                        $scope.purchases = data.data;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                    });
                }
                    
                };

                $scope.createPurchase = function(){
                     alert("estoy aqui");
                   if ($scope.purchaseCreateForm.$valid) {
                         alert("estoy aqui");
                        crudPurchase.create($scope.purchase, 'purchases').then(function (data) {
                          
                            if (data['estado'] == true) {
                                $scope.success = data['nombres'];
                                 $scope.codigoTemporalP=(data['codigo']);
                                alert('grabado correctamente');
                            } else {
                                $scope.errors = data;

                            }
                        });

                         
                    }
                }
                $scope.sacarRow=function($index,$total){
                    $scope.detailPurchases.splice($index,1);
                    $scope.purchase.montoBruto=$scope.purchase.montoBruto - (parseFloat($total));
                }
                 $scope.DcreatePurchase = function(){
                    alert("yagrave aqui 2");
                    crudPurchase.create($scope.purchase.detailPurchases, 'detailpurchases').then(function (data) {
                          $log.log($scope.purchase.detailPurchases);
                            if (data['estado'] == true) {
                               // $scope.success = data['nombres'];
                                alert('grabado correctamente detalle');
                                $location.path('/purchases');
                                $scope.detailPurchases=[];
                            } else {
                                $scope.errors = data;

                            }
                        });
                    
                 }

                $scope.editPurchase= function(row){
                    $location.path('/purchases/edit/'+row.id);
                };

                $scope.updatePurchase = function(){

                    if ($scope.purchaseCreateForm.$valid) {
                        crudPurchase.update($scope.purchase,'purchases').then(function(data)
                        {
                            if(data['estado'] == true){
                                $scope.success = data['nombres'];
                                alert('editado correctamente');
                                $location.path('/purchases');
                            }else{
                                $scope.errors =data;
                            }
                        });
                    }
                };

                $scope.deletePurchase = function(row){
                    $scope.purchase = row;

                }

                $scope.cancelPurchase = function(){
                    $scope.purchase = {};
                }
                /*$scope.TreerDetalleCompra=function(row){
                    crudPurchase.traerEliminar(row.id).then(function(data){
                        $scope.detailPurchases = data;
                         alert(data[0].id);
                   
                   /////////////////////////pendiente
                    alert(data[0].id);
                    /*$log.log($scope.detailPurchases);
                     crudPurchase.destroy(data,'detailpurchases').then(function(data)
                    {
                        if(data['estado'] == true){
                            $scope.success = data['nombre'];
                            $scope.detailPurchase = {};
                            //alert('hola');
                            //$route.reload();
                            $scope.destroyPurchase();
                        }else{
                            $scope.errors = data;
                        }
                    }); });
                    //$scope.destroydetailPurchase();

                }*/
                $scope.destroydetailPurchase = function(){
                    $log.log($scope.detailPurchases);
                    crudPurchase.destroy($scope.detailPurchases,'detailpurchases').then(function(data)
                    {
                        if(data['estado'] == true){
                            $scope.success = data['nombre'];
                            $scope.detailPurchase = {};
                            //alert('hola');
                            //$route.reload();
                            $scope.destroyPurchase();
                        }else{
                            $scope.errors = data;
                        }
                    });
                }

                $scope.destroyPurchase = function(){
                    crudPurchase.destroy($scope.purchase,'purchases').then(function(data)
                    {
                        if(data['estado'] == true){
                            $scope.success = data['nombre'];
                            $scope.purchase = {};
                            //alert('hola');
                            $route.reload();

                        }else{
                            $scope.errors = data;
                        }
                    });
                }
            }]);
})();
