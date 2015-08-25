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
                $scope.variants=[];
                $scope.variant={};
                $scope.payments=[];
                $scope.payment={};
                //$scope.detPayments=[];
                $scope.detPayment={};
                $scope.suppliers;
                $scope.orderPurchase.montoBruto=0;
                $scope.orderPurchase.montoTotal=0;
                $scope.orderPurchase.descuento=0;
                $scope.codigoTemporalP=0;
                $scope.indexmodificar;
                $scope.mostrarVariantes=false;
                $scope.idtemporalP;
                $scope.master=true;
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
                    
                       /* $scope.orderPurchase.montoBruto=parseFloat(data.montoBruto);
                        $scope.orderPurchase.montoTotal=parseFloat(data.montoTotal);
                        $scope.orderPurchase.descuento=parseFloat(data.descuento);     */                 

                        
                        $scope.idtemporalP=data.supplier_id;
                        crudPurchase.traerEmpresa($scope.idtemporalP).then(function (data) { 
                        $scope.orderPurchase.empresa = data.empresa;
                    });
                       // alert(data.id);
                        crudPurchase.paginateDPedido(data.id,'detailOrderPurchases').then(function (data) {
                        $scope.detailOrderPurchases = data.data;
                        $log.log($scope.detailOrderPurchases);
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
                //=========================================
                 crudPurchase.paginate('suppliers',1).then(function (data) {
                        $scope.suppliers = data.data;
                        //$scope.maxSize = 5;
                        //$scope.totalItems = data.total;
                        //$scope.currentPage = data.current_page;
                        //$scope.itemsperPage = 15;
                       
                    });
               // if($location.path() == '/orderPurchases/create/'){
                     crudPurchase.autocomplit('products',1).then(function (data) {
                        $scope.products = data.data;
                        //$scope.maxSize = 5;
                        //$scope.totalItems = data.total;
                        //$scope.currentPage = data.current_page;
                        //$scope.itemsperPage = 15;
                       
                    });
                     crudPurchase.autocomplit('variants',1).then(function (data) {
                        $scope.variants = data.data;
                        //$scope.maxSize = 5;
                        //$scope.totalItems = data.total;
                        //$scope.currentPage = data.current_page;
                        //$scope.itemsperPage = 15;
                       
                    });
                      crudPurchase.paginate('suppliers',1).then(function (data) {
                        $scope.suppliers = data.data;
                        //$scope.maxSize = 5;
                        //$scope.totalItems = data.total;
                        //$scope.currentPage = data.current_page;
                        //$scope.itemsperPage = 15;
                       
                    });
                    crudPurchase.paginate('methodPayments',1).then(function (data) {
                        $scope.methodPayments = data.data;
                        //$scope.maxSize = 5;
                        //$scope.totalItems = data.total;
                        //$scope.currentPage = data.current_page;
                        //$scope.itemsperPage = 15;

                    });
                    //=========================================

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
                $scope.asignarEmpresa=function(){
                   // alert("hola estoy aqui");
                   // alert($scope.orderPurchase.empresa.empresa);
                    $scope.orderPurchase.supplier_id=$scope.orderPurchase.empresa.id;
                    $scope.orderPurchase.empresa=$scope.orderPurchase.empresa.empresa;
                }
                $scope.total20;
               
                /*$scope.searchsupplier=function(){
                 crudPurchase.paginate('suppliers',1).then(function (data) {
                        $scope.suppliers = data.data;
                        $scope.maxSize = 5;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                        $scope.itemsperPage = 15;
                       
                    });
                }*/
                  
                $scope.sacarRow=function(index,total){
                      $scope.detailOrderPurchases.splice(index,1);
                      $scope.orderPurchase.montoBruto=$scope.orderPurchase.montoBruto - (parseFloat(total));
                      $scope.orderPurchase.montoTotal=parseFloat($scope.orderPurchase.montoBruto)-((parseFloat($scope.orderPurchase.montoBruto)*parseFloat($scope.orderPurchase.descuento))/100);
                    }
                  $scope.llenar=function(){
                    $scope.master= !$scope.master;
                    if($scope.master){
                    $scope.mostrarPresentacion=true;}
                    $scope.product.proId='';
                    $scope.variant.sku='';
                  }
                    $scope.mostrarPresentacion=true;
                    
                    $scope.asignarProduc1=function(){
                        $scope.detailOrderPurchase.Codigovar=$scope.product.proId.varid;
                        if($scope.master==false){
                            //alert($scope.master+"jajjaj");
                               $scope.detailOrderPurchase.CodigoPCompra=$scope.product.proId.varcode;
                               $scope.detailOrderPurchase.nombre=$scope.product.proId.proNombre;
                                crudPurchase.paginateDPedido($scope.product.proId.varid,'detpres').then(function (data) {
                               $scope.detPres=data.data;
                               $scope.maxSize = 5;
                               $scope.totalItems = data.total;
                               $scope.currentPage = data.current_page;
                               $scope.itemsperPage = 15;
                         
                                  });
                                 $scope.mostrarPresentacion=false;
                                 $scope.variant.sku=$scope.product.proId.varcode;                  
                         }else{
                           // alert($scope.master);
                            $scope.detailOrderPurchase.CodigoPCompra=$scope.product.proId.varcode;
                               $scope.detailOrderPurchase.nombre=$scope.product.proId.proNombre;
                                crudPurchase.select('detpres',$scope.product.proId.varid).then(function (data) {
                                    //$scope.detPres=data;
                                   // alert(data.esbase);
                                    $scope.detailOrderPurchase.esbase=data.esbase;
                                    $scope.detailOrderPurchase.detPres_id=data.detpresen_id;
                                    $scope.detailOrderPurchase.preProducto=parseFloat(data.precioProduct);
                                    $scope.detailOrderPurchase.preCompra=parseFloat(data.precioProduct);
                                  });
                                 //$scope.mostrarPresentacion=false;
                                 $scope.variant.sku=$scope.product.proId.varcode; 
                         }
                     
                    }
                    $scope.asignarProduc2=function(){
                        alert("este es el codigo de variante"+$scope.variant.sku.id);
                        $scope.detailOrderPurchase.Codigovar=$scope.variant.sku.id;
                         if($scope.master==false){
                           $scope.detailOrderPurchase.CodigoPCompra=$scope.variant.sku.sku;
                               $scope.detailOrderPurchase.nombre=$scope.variant.sku.nombre;
                                crudPurchase.paginateDPedido($scope.variant.sku.id,'detpres').then(function (data) {
                               $scope.detPres=data.data;
                               $scope.maxSize = 5;
                               $scope.totalItems = data.total;
                                $scope.currentPage = data.current_page;
                               $scope.itemsperPage = 15;
                                  });
                                 $scope.mostrarPresentacion=false;
                                 $scope.product.proId=$scope.variant.sku.nombre+" /"+$scope.variant.sku.descripcion;
                         }else{
                             $scope.detailOrderPurchase.CodigoPCompra=$scope.variant.sku.sku;
                               $scope.detailOrderPurchase.nombre=$scope.variant.sku.nombre;
                                crudPurchase.select('detpres',$scope.variant.sku.id).then(function (data) {
                                    //$scope.detPres=data;
                                    $scope.detailOrderPurchase.esbase=data.esbase;
                                    $scope.detailOrderPurchase.detPres_id=data.detpresen_id;
                                    $scope.detailOrderPurchase.preProducto=parseFloat(data.precioProduct);
                                    $scope.detailOrderPurchase.preCompra=parseFloat(data.precioProduct);
                                  });
                                 //$scope.mostrarPresentacion=false;
                                 $scope.product.proId=$scope.variant.sku.nombre+" /"+$scope.variant.sku.NombreAtributos;
                         }
                    }
                    $scope.seleccionarDetPres=function(){
                       if($scope.variants.id != undefined){
                        $id=$scope.variants.id;
                         crudPurchase.paginateDPedido($id,'detpres').then(function (data) {
                            $scope.detPres=data.data;
                            $scope.maxSize = 5;
                            $scope.totalItems = data.total;
                            $scope.currentPage = data.current_page;
                            $scope.itemsperPage = 15;

                         });
                          //$scope.mostrarModal="modal";
                        crudPurchase.byId($id,'variants').then(function (data) {
                        $scope.detailOrderPurchase.CodigoPCompra=data.sku;
                        $scope.mostrarPresentacion=false;
                    });
                        }else{
                            alert("por favor seleccione una variante");
                        }
                    }
                    $scope.AsignarP=function(row){
                         $scope.detailOrderPurchase.preProducto=parseFloat(row.precioCompra);
                         $scope.detailOrderPurchase.preCompra=parseFloat(row.precioCompra);
                         $scope.detailOrderPurchase.detPres_id=row.iddetalleP;
                         alert(row.base);
                         $scope.detailOrderPurchase.esbase=row.base;
                         $scope.mostrarPresentacion=true;
                    }
                    $scope.AgregarProducto=function(){
                    
                       if($scope.detailOrderPurchase.detPres_id>0){
                        if($scope.detailOrderPurchase.cantidad>1){
                        $scope.detailOrderPurchase.orderPurchases_id=$scope.codigoTemporalP;
                        $scope.detailOrderPurchases.push($scope.detailOrderPurchase);
                        $scope.orderPurchase.detailOrderPurchases=$scope.detailOrderPurchases;
                        //---------------------------------------------------------
                        $scope.orderPurchase.montoBruto= parseFloat(($scope.orderPurchase.montoBruto+$scope.detailOrderPurchase.montoTotal));
                        $scope.orderPurchase.montoTotal=parseFloat(($scope.orderPurchase.montoBruto-(($scope.orderPurchase.montoBruto*$scope.orderPurchase.descuento)/100)));
                        $scope.orderPurchases.push($scope.orderPurchase);
                        $scope.detailOrderPurchase = {};
                        //$scope.variants={};
                        $scope.product.proId='';
                        $scope.variant.sku='';
                        $scope.product.id='';
                    }else{
                       alert("Por favor debe ingresar una cantidad mayor a cero para poder agregar pedido");
                    }
                    }else{ alert("!!Usted Debe seleccionar un producto y una presentacion para poder agregar!!");}
                    }
                    $scope.ejemplo2=null;
                    $scope.estado_fin2=0;
                    $scope.ejemplo_de2=0;
                    $scope.calcularmontoBrutoF=function(){
                        if($scope.ejemplo2 != $scope.orderPurchase.montoTotal && $scope.estado_fin2 == $scope.orderPurchase.descuento){
                          $scope.orderPurchase.descuento=parseFloat(((($scope.orderPurchase.montoBruto - $scope.orderPurchase.montoTotal)/$scope.orderPurchase.montoBruto)*100).toFixed(2));
                          $scope.estado_fin2=$scope.orderPurchase.descuento;
                          $scope.estado_fin2=false;
                        }
                        if($scope.estado_fin2 && $scope.estado_fin2 != $scope.orderPurchase.descuento){
                        $scope.orderPurchase.montoTotal=parseFloat(($scope.orderPurchase.montoBruto - parseFloat(($scope.orderPurchase.montoBruto*$scope.orderPurchase.descuento)/100)).toFixed(2));
                        $scope.ejemplo2=$scope.orderPurchase.montoTotal;
                        $scope.estado_fin2=$scope.orderPurchase.descuento;
                        }else{$scope.estado_fin2=true;}
                    }
                   
                    $scope.ejemplo=null;
                    $scope.ejemplo_de=null;
                    $scope.estado_fin=true;
                    $scope.calculateSuppPric=function()
                    {      $scope.detailOrderPurchase.preCompra=parseFloat(($scope.detailOrderPurchase.preProducto).toFixed(2));
                           $scope.detailOrderPurchase.montoBruto=parseFloat(($scope.detailOrderPurchase.cantidad * parseFloat($scope.detailOrderPurchase.preProducto)).toFixed(2));
                           
                       if($scope.ejemplo != $scope.detailOrderPurchase.montoTotal && $scope.ejemplo_de == $scope.detailOrderPurchase.descuento){
                          $scope.detailOrderPurchase.descuento=parseFloat(((($scope.detailOrderPurchase.montoBruto - $scope.detailOrderPurchase.montoTotal)/$scope.detailOrderPurchase.montoBruto)*100).toFixed(2));
                           $scope.ejemplo_de=$scope.detailOrderPurchase.descuento;
                          $scope.estado_fin=false;
                        }
                      
                      if( $scope.estado_fin){
                       if($scope.detailOrderPurchase.descuento>0 ){
                          $scope.detailOrderPurchase.montoTotal= parseFloat(($scope.detailOrderPurchase.cantidad * ($scope.detailOrderPurchase.preCompra - (($scope.detailOrderPurchase.preCompra * $scope.detailOrderPurchase.descuento ) / 100))).toFixed(2));
                          $scope.detailOrderPurchase.preCompra=parseFloat(($scope.detailOrderPurchase.preCompra - (($scope.detailOrderPurchase.preCompra * $scope.detailOrderPurchase.descuento ) / 100)).toFixed(2));
                          $scope.ejemplo=$scope.detailOrderPurchase.montoTotal;
                          $scope.ejemplo_de=$scope.detailOrderPurchase.descuento;
                       }else{
                         $scope.detailOrderPurchase.preCompra=parseFloat(($scope.detailOrderPurchase.preProducto).toFixed(2));
                         $scope.detailOrderPurchase.montoBruto=parseFloat(($scope.detailOrderPurchase.cantidad * parseFloat($scope.detailOrderPurchase.preCompra)).toFixed(2));
                         $scope.detailOrderPurchase.montoTotal= parseFloat(($scope.detailOrderPurchase.cantidad * parseFloat($scope.detailOrderPurchase.preCompra)).toFixed(2));
                         $scope.detailOrderPurchase.descuento=0;
                         $scope.ejemplo_de=$scope.detailOrderPurchase.descuento;
                        $scope.ejemplo=$scope.detailOrderPurchase.montoTotal;
                       }}else{
                        $scope.detailOrderPurchase.preCompra=parseFloat(($scope.detailOrderPurchase.preCompra - (($scope.detailOrderPurchase.preCompra * $scope.detailOrderPurchase.descuento ) / 100)).toFixed(2));
                        $scope.estado_fin=true;}
                  // }
                    }
                /*$scope.calEnBaseTotal=function(){
                    $scope.detailOrderPurchase.preCompra=parseFloat(($scope.detailOrderPurchase.preProducto).toFixed(2));
                    $scope.detailOrderPurchase.montoBruto=parseFloat(($scope.detailOrderPurchase.cantidad * parseFloat($scope.detailOrderPurchase.preProducto)).toFixed(2));
                $scope.detailOrderPurchase.descuento=parseFloat(((($scope.detailOrderPurchase.montoBruto - $scope.detailOrderPurchase.montoTotal)/$scope.detailOrderPurchase.montoBruto)*100).toFixed(2));
                         
                }*/
                $scope.searchPurchase = function(){
                if ($scope.query.length > 0) {
                    crudPurchase.search('orderPurchases',$scope.query,1).then(function (data){
                        $scope.orderPurchases = data.data;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                    });
                }
               
                    
                }
                $scope.addCant=function(row,index){
                   
                      $scope.orderPurchase.montoBruto=$scope.orderPurchase.montoBruto-parseFloat(row.montoTotal);
                      row.cantidad=parseInt(row.cantidad)+1;
                      row.montoBruto=parseFloat((parseInt(row.cantidad)*parseFloat(row.preProducto)).toFixed(2));
                      row.montoTotal=parseFloat((parseInt(row.cantidad)*parseFloat(row.preCompra)).toFixed(2));
                      $scope.detailOrderPurchases.splice(index,1,row);
                      $scope.orderPurchase.montoBruto=parseFloat((($scope.orderPurchase.montoBruto)+parseFloat(row.montoTotal)).toFixed(2));;
                      $scope.orderPurchase.montoTotal=parseFloat((parseFloat($scope.orderPurchase.montoBruto)-((parseFloat($scope.orderPurchase.montoBruto)*parseFloat($scope.orderPurchase.descuento))/100)).toFixed(2));
                      
                }
                $scope.lessCant=function(row,index){
                     if(parseInt(row.cantidad)>1){
                    $scope.orderPurchase.montoBruto=$scope.orderPurchase.montoBruto-parseFloat(row.montoTotal);
                      row.cantidad=parseInt(row.cantidad)-1;
                      row.montoBruto=parseFloat((parseInt(row.cantidad)*parseFloat(row.preProducto)).toFixed(2));
                      row.montoTotal=parseFloat((parseInt(row.cantidad)*parseFloat(row.preCompra)).toFixed(2));
                      $scope.detailOrderPurchases.splice(index,1,row); 
                      $scope.orderPurchase.montoBruto=parseFloat((($scope.orderPurchase.montoBruto)+parseFloat(row.montoTotal)).toFixed(2));
                      // $scope.orderPurchase.montoBruto= $scope.orderPurchase.montoBruto.toFixed(2);
                      $scope.orderPurchase.montoTotal=parseFloat((parseFloat($scope.orderPurchase.montoBruto)-((parseFloat($scope.orderPurchase.montoBruto)*parseFloat($scope.orderPurchase.descuento))/100)).toFixed(2));
                      }else{
                        alert("Usted debe tener como minimo una unidad de lo contrario elimine la este producto de la lista");
                      }
                }

                $scope.createPurchase = function(){
                if($scope.codigoTemporalP == 0){
                   if ($scope.orderPurchaseCreateForm.$valid) {
                        crudPurchase.create($scope.orderPurchase, 'orderPurchases').then(function (data) {
                          
                            if (data['estado'] == true) {
                                $scope.success = data['nombres'];
                                 $scope.codigoTemporalP=(data['codigo']);
                                 $scope.orderPurchase.id=(data['codigo']);
                                alert('Orden Creada correctamente');
                                $scope.llenar();
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
                    else{
                       crudPurchase.byId($scope.orderPurchase.warehouses_id,'warehouses').then(function (data) {
                        $scope.warehouses=data;
                    });  
                    }
                    if($scope.orderPurchase.fechaPrevista != null){
                    $scope.dd=$scope.orderPurchase.fechaPrevista.getDate();
                    $scope.mm=$scope.orderPurchase.fechaPrevista.getMonth();
                    $scope.yyyy=$scope.orderPurchase.fechaPrevista.getFullYear();
                };
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
                
             
                 $scope.DcreatePurchase = function(){
                    crudPurchase.create($scope.orderPurchase.detailOrderPurchases, 'detailOrderPurchases').then(function (data) {
                          $log.log($scope.orderPurchase.detailOrderPurchases);
                            if (data['estado'] == true) {
                                alert('grabado correctamente detalle');
                                $scope.updatePurchase();
                                $scope.detailOrderPurchases=[];
                            } else {
                                $scope.errors = data;

                            }
                        });
                    
                 }
                 $scope.activEstados=false;
                 $scope.activarCamposEdit=function(){
                     $scope.activEstados=true;
                 }
                
                 $scope.updateDPurchase = function(){
                   $scope.orderPurchase.detailOrderPurchases=$scope.detailOrderPurchases;
                   if ($scope.orderPurchaseCreateForm.$valid) {
                        crudPurchase.update($scope.orderPurchase,'detailOrderPurchases').then(function (data) {
                            if (data['estado'] == true) {
                                alert('Editado correctamente a la fila');
                                $scope.updatePurchase();
                            } else {
                                $scope.errors = data;

                            }
                        });

                         
                    }
                };

                $scope.updatePurchase = function(){
                    
                   if($scope.orderPurchase.cancelar){
                      $scope.orderPurchase.Estado=2;
                   }
                   if ($scope.orderPurchaseCreateForm.$valid) {
                        crudPurchase.update($scope.orderPurchase,'orderPurchases').then(function (data) {
                         
                            if (data['estado'] == true) {
                                $scope.success = data['nombres'];
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
                     $scope.llenar();
                }
                $scope.CambiarEstado1=function(){
                      $scope.estados=false;
                      $scope.estados1=true;
                }
                //-----------------------------------------------------------------------
                $scope.editPurchase= function(row){

                       $location.path('/orderPurchases/edit/'+row.id);

                 };
                 
                $scope.paymentsCalc=function(){
                    $scope.payment.Saldo=$scope.payment.montoTotal-$scope.payment.Acuenta;
                }
                 $scope.createPayments=function(){
                    
                        crudPurchase.create($scope.payment, 'payments').then(function (data) {
                          
                            if (data['estado'] == true) {
                                $scope.success = data['nombres'];
                                alert('Adelanto creado correctamente');

                            } else {
                                $scope.errors = data;

                            }
                        });
                   // }
                }
                $scope.CrearCompraDirecta =function(){
                    $scope.orderPurchase.compraDirecta=1;
                    $scope.orderPurchase.fechaEntrega=$scope.orderPurchase.fechaPedido;
                    $scope.orderPurchase.detailOrderPurchases=$scope.detailOrderPurchases
                    $scope.orderPurchase.Saldo=$scope.orderPurchase.montoTotal;
                    $scope.orderPurchases.push( $scope.orderPurchase);
                    
                     crudPurchase.create($scope.orderPurchase, 'purchases').then(function (data) {
                         
                            if (data['estado'] == true) {
                                alert('Compra directa correctamente registrada');
                                $location.path('/orderPurchases');
                            } else {
                                $scope.errors = data;

                            }
                        });
                 
            }

                $scope.CrearCompra =function(){
                    $scope.orderPurchase.fechaEntrega=new Date();
                    $scope.orderPurchase.orderPurchase_id=$scope.codigoTemporalP;
                    $scope.orderPurchase.detailOrderPurchases=$scope.detailOrderPurchases
                    $scope.orderPurchase.Saldo=$scope.orderPurchase.montoTotal;
                    $scope.orderPurchases.push( $scope.orderPurchase);
                    if($scope.orderPurchase.Estado==1){
                     crudPurchase.create($scope.orderPurchase, 'purchases').then(function (data) {
                         
                            if (data['estado'] == true) {
                                alert('Compra registrada');
                                $location.path('/orderPurchases');
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
            $scope.ComprovarCantidad=function(row,index){
                if(row.cantidad1==0){ 
                          alert("usted a ingresado 0 product por ende este registro no sera tomado eencuenta ")
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
                $scope.orderPurchase.montoTotal=parseFloat($scope.orderPurchase.montoBruto)-((parseFloat($scope.orderPurchase.montoBruto)*parseFloat($scope.orderPurchase.descuento))/100);
                $scope.orderPurchases.push($scope.orderPurchase);
                $scope.detailOrderPurchases.splice(index,1,row);
            }
                
                alert("modifique la fila correctamente");
            }
            
               $scope.searchPurchase = function(){
                if ($scope.query.length > 0) {
                    crudPurchase.search('orderPurchases',$scope.query,1).then(function (data){
                        $scope.orderPurchases = data.data;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                    });
                }else{
                    crudPurchase.paginate('orderPurchases',1).then(function (data) {
                        $scope.orderPurchases = data.data;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                    });
                }
                    
                };
                 $scope.popover=function(row){
                        crudPurchase.bytraervar(row.detPres_id,'variants').then(function (data) {
                        $scope.variants = data;
                        crudPurchase.bytraervar(data.base,'presentations').then(function (data) {
                        $scope.presentation = data;
                        
                         });
                    });
                 }
                 $scope.payment.Acuenta=0;
                 $scope.recalPayments=function(){
                    //alert($scope.payment.MontoTotal);
                if(Number($scope.payment.MontoTotal)>=Number($scope.detPayment.montoPagado)){
                    $scope.payment.Acuenta=Number($scope.totAnterior)+Number($scope.detPayment.montoPagado);
                    $scope.payment.Saldo=(Number($scope.payment.MontoTotal)-Number($scope.payment.Acuenta)).toFixed(2);
                    $scope.payment.PorPagado=((Number($scope.payment.Acuenta)*100)/(Number($scope.payment.MontoTotal))).toFixed(2);
                     $scope.random();
                }else{
                    alert('!!Error Usted Solo Puede Ingresar una cantidad menor o igual al total!!');
                }
                }
                $scope.payment={};
                 $scope.payment.idpayment;
                 $scope.totAnterior;
                $scope.payments=function(row){

                    $scope.detPayment.fecha=new Date();
                    crudPurchase.byId(row.id,'payments').then(function (data){
                            $scope.payment = data;
                            $scope.payment.empresa=row.empresa;
                            $scope.totAnterior=$scope.payment.Acuenta
                            $scope.payment.idpayment=$scope.payment.id;
                            $scope.payment.PorPagado=((Number($scope.payment.Acuenta)*100)/(Number($scope.payment.MontoTotal))).toFixed(2);
                    
                           // alert($data.Acuenta);
                     if(data.id>0){      
                     crudPurchase.byId($scope.payment.id,'detPayments').then(function (data) {
                        $scope.detPayments = data.data;
                        $scope.maxSize = 5;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                        $scope.itemsperPage = 5;

                    }); }else{
                        $scope.detPayments=[];
                    $scope.payment=row;
                    $scope.payment.MontoTotal=row.montoTotal;
                    $scope.payment.orderPurchase_id=row.id;
                    $scope.payment.supplier_id=row.supID;
                    $scope.payment.Saldo=row.montoTotal;
                    $scope.payment.PorPagado=0;
                    $scope.totAnterior=0;
                     }  });
                      
                    $scope.totAnterior=$scope.payment.Acuenta
                    $scope.random();
                   //  alert($scope.totAnterior);
                    //alert(row.empresa);
                    
                }
                /*$scope.asignarCodPayme=function(row)
                {
                       $scope.payment.orderPurchase_id=row.id;
                       $scope.payment.supplier_id=row.supID;
                }*/
                 $scope.createPayment = function(){
                   // alert( $scope.payment.fecha);
                    $scope.payment.detPayments=$scope.detPayment;
                    if ($scope.paymentCreateForm.$valid){
                        crudPurchase.create($scope.payment, 'payments').then(function (data) {
                          
                            if (data['estado'] == true) {
                                $scope.success = data['nombres'];
                                alert('grabado correctamente payments');
                                $scope.detPayment.methodPayment_id='';
                               $scope.detPayment.montoPagado='';
                                $scope.paginateDetPay();

                            } else {
                                $scope.errors = data;

                            }
                        });}
                }
                $scope.paginateDetPay=function(){
                      crudPurchase.byId($scope.payment.id,'detPayments').then(function (data) {
                        $scope.detPayments = data.data;
                        $scope.maxSize = 5;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                        $scope.itemsperPage = 5;

                    });
                }
            $scope.random = function() {
                var type;

                if ($scope.payment.PorPagado < 25) {
                  type = 'info';
                } else if ($scope.payment.PorPagado < 50) {
                  type = 'success';
                } else if ($scope.payment.PorPagado < 75) {
                  type = 'warning';
                } else {
                  type = 'danger';
                }

                $scope.type = type;
              };
 
            }]);
})();
