(function(){
    angular.module('orderPurchases.controllers',[])
        .controller('OrderPurchaseController',['$scope', '$routeParams','$location','crudPurchase','socketService' ,'$filter','$route','$http','$log',
            function($scope, $routeParams,$location,crudPurchase,socket,$filter,$route , $http,$log){
             
                $scope.orderPurchases = [];
                $scope.orderPurchase = {};
                $scope.products = [];
                $scope.product = {};
                $scope.detailOrderPurchases = [];
                $scope.detailOrderPurchase = {};
                $scope.errors = null;
                $scope.success;
                $scope.query = '';
                $scope.warehouses;
                $scope.orderPurchase.fechaPedido=new Date();
                $scope.variants={};

                $scope.suppliers;
                $scope.orderPurchase.montoBruto=0;
                $scope.orderPurchase.montoTotal=0;
                $scope.orderPurchase.descuento=0;
                $scope.codigoTemporalP=0;
                $scope.indexmodificar;
                $scope.editRows=false;
                $scope.mostrarVariantes=false;
                $scope.estadosdf=false;
                $scope.idtemporalP;
                $scope.variants.id;



                $scope.pageChanged = function() {
                    if ($scope.query.length > 0) {
                        crudPurchase.search('orderPurchases',$scope.query,$scope.currentPage).then(function (data){
                        $scope.orderPurchases = data.data;
                    });
                    }else{
                        crudPurchase.paginate('orderPurchases',$scope.currentPage).then(function (data) {
                            $scope.orderPurchases = data.data;
                        });
                    }
                };


                var id = $routeParams.id;

                if(id)
                {
                    crudPurchase.byId(id,'orderPurchases').then(function (data) {
                        $scope.orderPurchase = data;
                        $scope.codigoTemporalP=data.id;
                        $scope.orderPurchase.estados=data.Estado;
                        if(data.fechaPedido != null) {
                            if (data.fechaPedido.length > 0) {
                                data.fechaPedido = new Date(data.fechaPedido);
                            }
                        }
                        if(data.fechaPrevista != null) {
                            if (data.fechaPrevista.length > 0) {
                                data.fechaPrevista = new Date(data.fechaPrevista);
                            }
                        }
                        crudPurchase.byId(data.warehouses_id,'warehouses').then(function (data) {
                        $scope.warehouses=data;
                    });
                     $scope.dd=$scope.orderPurchase.fechaPrevista.getDate();
                     $scope.mm=$scope.orderPurchase.fechaPrevista.getMonth();
                     $scope.yyyy=$scope.orderPurchase.fechaPrevista.getFullYear();
                     $scope.dd1=$scope.orderPurchase.fechaPedido.getDate();
                     $scope.mm1=$scope.orderPurchase.fechaPedido.getMonth();
                     $scope.yyyy1=$scope.orderPurchase.fechaPedido.getFullYear();
                     if($scope.dd<10){$scope.dd="0"+$scope.dd;} else{$scope.dd=$scope.dd;}
                     if($scope.mm<10){$scope.mm="0"+(parseInt($scope.mm)+1);}else{$scope.mm=$scope.mm;}
                     $scope.orderPurchase.fechaPrevist=$scope.dd+"-"+$scope.mm+"-"+$scope.yyyy;
                     if($scope.dd1<10){$scope.dd1="0"+$scope.dd1;} else{$scope.dd1=$scope.dd1;}
                     if($scope.mm<10){$scope.mm1="0"+(parseInt($scope.mm1)+1);}else{$scope.mm1=$scope.mm1;}
                     $scope.orderPurchase.fechaPedid=$scope.dd1+"-"+$scope.mm1+"-"+$scope.yyyy1;
                    
                        $scope.orderPurchase.montoBruto=parseFloat(data.montoBruto);
                        $scope.orderPurchase.montoTotal=parseFloat(data.montoTotal);
                        $scope.orderPurchase.descuento=parseFloat(data.descuento);                      

                        
                        $scope.idtemporalP=data.suppliers_id;
                        crudPurchase.traerEmpresa($scope.idtemporalP).then(function (data) { 
                        $scope.orderPurchase.empresa = data.empresa;
                    });
                        
                        crudPurchase.paginateDPedido(data.id,'detailOrderPurchases').then(function (data) {
                        $scope.detailOrderPurchases = data.data;
                        $scope.detailOrderPurchase.unidades=parseFloat(data.cantidad);
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
                    crudPurchase.paginate('orderPurchases',1).then(function (data) {
                        $scope.orderPurchases = data.data;
                        $scope.maxSize = 5;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                        $scope.itemsperPage = 15;

                    });
                   
                    crudPurchase.select('warehouses','select').then(function(data){
                        $scope.warehouses = data;
                    });
                     
                }

                socket.on('orderPurchase.update', function (data) {
                    $scope.orderPurchases=JSON.parse(data);
                });
                $scope.ProvandoEdicion=function(){
                    $scope.show = !$scope.show;
                 crudPurchase.select('warehouses','select').then(function(data){
                        $scope.warehouses = data;
                    });   
                }
                 $scope.toggle = function () {
                    $scope.show = !$scope.show;
                
                };
                $scope.asignarEmpresa=function(row){
                    $scope.orderPurchase.suppliers_id=row.id;
                    $scope.orderPurchase.empresa=row.empresa;
                }
                $scope.EditarDetalles=function(row,index){
                    //$scope.detailOrderPurchases=[];
                    alert("primer index"+index);
                    $scope.detailOrderPurchase=row;
                    $scope.detailOrderPurchase.cantidad=parseFloat(row.cantidad);
                    $scope.detailOrderPurchase.preProducto=parseFloat(row.preProducto);
                    $scope.detailOrderPurchase.preCompra=parseFloat(row.preCompra);
                    $scope.detailOrderPurchase.montoBruto=parseFloat(row.montoBruto);
                    $scope.detailOrderPurchase.descuento=parseFloat(row.descuento);
                    $scope.detailOrderPurchase.montoTotal=parseFloat(row.montoTotal);
                    $scope.indexmodificar=index;
                    alert("segundo index 2"+ $scope.indexmodificar);
                    $scope.orderPurchase.montoBruto=$scope.orderPurchase.montoBruto - (parseFloat(row.montoTotal));
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
                    $scope.ModificarRow=function(){
                    $scope.detailOrderPurchase.id="";
                    alert("tercer index 2"+ $scope.indexmodificar);
                    $scope.detailOrderPurchases.splice($scope.indexmodificar,1,$scope.detailOrderPurchase);
                    $scope.orderPurchase.montoBruto=$scope.orderPurchase.montoBruto + (parseFloat($scope.detailOrderPurchase.montoTotal));
                    $scope.detailOrderPurchase = {};
                    $scope.variants={};
                    }
                    $scope.asignarProduc=function(row){
                         $scope.product.id=row.proNombre;
                         if(parseInt(row.TieneVariante)>0){
                               $scope.mostrarVariantes=true;
                               crudPurchase.bytraervar(row.proId,'variants').then(function (data) {
                               $scope.variants= data;
                               $scope.detailOrderPurchase.preProducto=parseInt(row.precioProducto);
                               $scope.detailOrderPurchase.nombre=row.proNombre;
                      });
                            }else{
                                alert("No tiene Variantes");
                                crudPurchase.bytraervar(row.proId,'variants').then(function (data) {
                               $scope.variants= data;
                               $scope.variants.id=data[0].id;
                               $scope.detailOrderPurchase.preProducto=parseInt(row.precioProducto);
                               $scope.detailOrderPurchase.nombre=row.proNombre;
                               $scope.mostrarVariantes=false;
                               $scope.seleccionar();
                               }); 
                            }
                         
                     
                    }
                    $scope.seleccionarDetPres=function(){
                       
                        $id=$scope.variants.id;
                         crudPurchase.paginateDPedido($id,'detpres').then(function (data) {
                            $scope.detPres=data.data;
                            $scope.maxSize = 5;
                            $scope.totalItems = data.total;
                            $scope.currentPage = data.current_page;
                            $scope.itemsperPage = 15;
                         });
                          $scope.mostrarModal="modal";
                        crudPurchase.byId($id,'variants').then(function (data) {
                        $scope.detailOrderPurchase.CodigoPCompra=data.sku;
                    });
                        
                    }
                    $scope.AsignarP=function(row){
                         $scope.detailOrderPurchase.preCompra=parseFloat(row.precioCompra);
                         $scope.detailOrderPurchase.detPres_id=row.iddetalleP;
                         alert($scope.detailOrderPurchase.preCompra);
                    }
                    $scope.AgregarProducto=function(){
                       if($scope.codigoTemporalP>0){
                        $scope.detailOrderPurchase.orderPurchases_id=$scope.codigoTemporalP;
                        alert($scope.detailOrderPurchase.orderPurchases_id);
                        $log.log($scope.detailOrderPurchase);
                        $scope.detailOrderPurchases.push($scope.detailOrderPurchase);
                        $log.log($scope.detailOrderPurchases);
                        $scope.orderPurchase.detailOrderPurchases=$scope.detailOrderPurchases;
                        //---------------------------------------------------------
                        $scope.orderPurchase.montoBruto= $scope.orderPurchase.montoBruto+$scope.detailOrderPurchase.montoTotal;
                        $scope.orderPurchase.montoTotal=$scope.orderPurchase.montoBruto-(($scope.orderPurchase.montoBruto*$scope.orderPurchase.descuento)/100);
                        $scope.orderPurchases.push($scope.orderPurchase);
                        $scope.detailOrderPurchase = {};
                        $scope.variants={};
                        $scope.product.id='';
                    }else{ alert ("!!Usted Debe Lenar a la cabecera del formulario para poder agregar!!")}
                    }
                    $scope.calcularmontoBrutoF=function(){
                        $scope.orderPurchase.montoTotal=$scope.orderPurchase.montoBruto - parseFloat(($scope.orderPurchase.montoBruto*$scope.orderPurchase.descuento)/100);
                    }
                    $scope.calculateSuppPric=function()
                    {
                        $scope.detailOrderPurchase.montoBruto=$scope.detailOrderPurchase.cantidad * parseFloat($scope.detailOrderPurchase.preCompra);
                        if($scope.detailOrderPurchase.descuento>0){
                        $scope.detailOrderPurchase.montoTotal= $scope.detailOrderPurchase.montoBruto - (($scope.detailOrderPurchase.montoBruto * $scope.detailOrderPurchase.descuento ) / 100);
                       }else{
                        $scope.detailOrderPurchase.montoTotal= $scope.detailOrderPurchase.montoBruto;
                       }
                    }
                    $scope.calculateTotalPrice=function(){
                        $scope.detailOrderPurchase.montoTotal= $scope.detailOrderPurchase.montoBruto - (($scope.detailOrderPurchase.montoBruto * $scope.detailOrderPurchase.descuento ) / 100);
                    }
                    //===========================================
                    //===========================================
                $scope.searchPurchase = function(){
                if ($scope.query.length > 0) {
                    crudPurchase.search('orderPurchases',$scope.query,1).then(function (data){
                        $scope.orderPurchases = data.data;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                    });
                }
               
                    
                }

                $scope.createPurchase = function(){
                  //  alert("estoy aqui"+$scope.codigoTemporalP);
                if($scope.codigoTemporalP == 0){
                   if ($scope.orderPurchaseCreateForm.$valid) {
                        crudPurchase.create($scope.orderPurchase, 'orderPurchases').then(function (data) {
                          
                            if (data['estado'] == true) {
                                $scope.success = data['nombres'];
                                 $scope.codigoTemporalP=(data['codigo']);
                                 $scope.orderPurchase.id=(data['codigo']);
                                alert('Orden Creada correctamente');
                                $scope.Warehouses(data['warehouse_id']);
                        } else {
                                $scope.errors = data;

                            }
                        });

                         
                    }}else{
                        $scope.Warehouses($scope.orderPurchase.warehouses_id);
                    }
                }
                $scope.Warehouses=function(id){
                    if(parseInt(id)> 0){
                    crudPurchase.byId(id,'warehouses').then(function (data) {
                        $scope.warehouses=data;
                    });}
                    $scope.dd=$scope.orderPurchase.fechaPrevista.getDate();
                    $scope.mm=$scope.orderPurchase.fechaPrevista.getMonth();
                    $scope.yyyy=$scope.orderPurchase.fechaPrevista.getFullYear();
                    $scope.dd1=$scope.orderPurchase.fechaPedido.getDate();
                    $scope.mm1=$scope.orderPurchase.fechaPedido.getMonth();
                    $scope.yyyy1=$scope.orderPurchase.fechaPedido.getFullYear();
                     if($scope.dd<10){$scope.dd="0"+$scope.dd;} else{$scope.dd=$scope.dd;}
                     if($scope.mm<10){$scope.mm="0"+(parseInt($scope.mm)+1);}else{$scope.mm=$scope.mm;}
                     $scope.orderPurchase.fechaPrevist=$scope.dd+"-"+$scope.mm+"-"+$scope.yyyy;
                     if($scope.dd1<10){$scope.dd1="0"+$scope.dd1;} else{$scope.dd1=$scope.dd1;}
                     if($scope.mm<10){$scope.mm1="0"+(parseInt($scope.mm1)+1);}else{$scope.mm1=$scope.mm1;}
                     $scope.orderPurchase.fechaPedid=$scope.dd1+"-"+$scope.mm1+"-"+$scope.yyyy1;
                     $scope.activEstados=false;
                    $scope.toggle();
                }
                $scope.sacarRow=function(index,total){
                    $scope.detailOrderPurchases.splice(index,1);
                    $scope.orderPurchase.montoBruto=$scope.orderPurchase.montoBruto - (parseFloat(total));
                }
             
                 $scope.DcreatePurchase = function(){
                   // alert("yagrave aqui 2");
                    crudPurchase.create($scope.orderPurchase.detailOrderPurchases, 'detailOrderPurchases').then(function (data) {
                          $log.log($scope.orderPurchase.detailOrderPurchases);
                            if (data['estado'] == true) {
                                alert('grabado correctamente detalle');
                                $scope.updatePurchase();
                                $scope.detailOrderPurchases=[];
                                //$scope.updatePurchase();
                            } else {
                                $scope.errors = data;

                            }
                        });
                    
                 }
                 $scope.activEstados=false;
                 $scope.activarCamposEdit=function(){
                     $scope.activEstados=true;
                     //$scope.warehouses(0);
                 }
                
                 $scope.updateDPurchase = function(){
                   $scope.orderPurchase.detailOrderPurchases=$scope.detailOrderPurchases;
                   if ($scope.orderPurchaseCreateForm.$valid) {
                        crudPurchase.update($scope.orderPurchase,'detailOrderPurchases').then(function (data) {
                          $log.log($scope.orderPurchase);
                            if (data['estado'] == true) {
                                //$scope.success = data['nombres'];
                                // $scope.codigoTemporalP=(data['codigo']);
                                alert('Editado correctamente a la fila');
                                //$location.path('/orderPurchases');
                                $scope.updatePurchase();
                                //$scope.detailOrderPurchase = {};
                               // $scope.variants={};
                            } else {
                                $scope.errors = data;

                            }
                        });

                         
                    }
                };

                $scope.updatePurchase = function(){
                   if ($scope.orderPurchaseCreateForm.$valid) {
                        crudPurchase.update($scope.orderPurchase,'orderPurchases').then(function (data) {
                          $log.log($scope.orderPurchase);
                            if (data['estado'] == true) {
                                $scope.success = data['nombres'];
                                // $scope.codigoTemporalP=(data['codigo']);
                                alert('Editado correctamente');

                                $scope.CrearCompra();
                            } else {
                                $scope.errors = data;

                            }
                        });

                         
                    }
                };


                $scope.cancelPurchase = function(){
                    $scope.orderPurchase = {};
                }
               $scope.estados=false;
               $scope.estados1=false;
                $scope.CambiarEstado=function(){
                      $scope.estados=true;
                     $scope.estados1=false;
                }
                $scope.CambiarEstado1=function(){
                      $scope.estados=false;
                      $scope.estados1=true;
                }
                //-----------------------------------------------------------------------
                $scope.editPurchase= function(row){
                       $location.path('/orderPurchases/edit/'+row.id);

                 };
                 //$scope.orderPurchase.orderPurchase_id;
                $scope.CrearCompra =function(){
                    $scope.orderPurchase.fechaEntrega=new Date();
                    $scope.orderPurchase.orderPurchase_id=$scope.codigoTemporalP;
                    $scope.orderPurchase.detailOrderPurchases=$scope.detailOrderPurchases
                    $scope.orderPurchases.push( $scope.orderPurchase);
                    alert("ala");
                    if($scope.orderPurchase.Estado==1){
                     crudPurchase.create($scope.orderPurchase, 'purchases').then(function (data) {
                          $log.log($scope.orderPurchase);
                            if (data['estado'] == true) {
                               // $scope.success = data['nombres'];
                                alert('Compra registrada');
                                $location.path('/orderPurchases');
                                //$scope.detailOrderPurchases=[];
                                //$scope.updatePurchase();
                            } else {
                                $scope.errors = data;

                            }
                        });
                 }else{
                    $location.path('/orderPurchases');
                 }
            }
            $scope.estado;
            $scope.searchEstados=function(){
                    alert($scope.estado);
                    if($scope.estado < 3 ){
                    crudPurchase.all('orderPurchases',$scope.estado).then(function (data) {
                        $scope.orderPurchases = data.data;
                        $scope.maxSize = 5;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                        $scope.itemsperPage = 15;

                    });
                }else{
                    crudPurchase.paginate('orderPurchases',1).then(function (data) {
                        $scope.orderPurchases = data.data;
                        $scope.maxSize = 5;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                        $scope.itemsperPage = 15;

                    });
                }
                }
            $scope.detailOrderPurchase.unidades;
            $scope.notar=function(row,index){
                alert("estamos dentro->"+index);
                if(row.cantidad1==0){ 
                    alert("usted a ingresado 0 product llegados ")
                    $scope.detailOrderPurchases.splice(index,1);
                }else{
                    $scope.orderPurchase.montoBruto=$scope.orderPurchase.montoBruto-row.montoTotal;
                    row.cantidad=row.cantidad1;
                 row.montoBruto=(row.cantidad-(row.cantidad-row.cantidad1))* parseFloat(row.preCompra);
                 if(row.descuento>0){
                        row.montoTotal= row.montoBruto - ((row.montoBruto * row.descuento ) / 100);
                       
                }else{
                       row.montoTotal= row.montoBruto;
                      
                }
                 $scope.orderPurchase.montoBruto=$scope.orderPurchase.montoBruto+row.montoTotal;
                $scope.orderPurchases.push($scope.orderPurchase);
                $log.log(row);
                $scope.detailOrderPurchases.splice(index,1,row);
                //$scope.detailOrderPurchases.push(row);
            }
                
                alert("modifique la fila correctamente");
            }
            
            //---------------------------------------------------------------
             $scope.ActualizarStock=function(){
                       
                       $scope.orderPurchase.detailOrderPurchases=$scope.detailOrderPurchases;
                       $scope.orderPurchases.push($scope.orderPurchase);
                        crudPurchase.update($scope.orderPurchase,'stocks').then(function (data) {
                          $log.log($scope.orderPurchase);
                            if (data['estado'] == true) {
                                //$scope.success = data['nombres'];
                                // $scope.codigoTemporalP=(data['codigo']);
                                alert('Stocks correctamente modificado');

                               // $scope.CrearCompra();
                            } else {
                                $scope.errors = data;

                            }
                        });

                         
                    
                 
             }
 
 
            }]);
})();
