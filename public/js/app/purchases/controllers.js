(function(){
    angular.module('purchases.controllers',[])
        .controller('PurchaseController',['$scope','$http' ,'$routeParams','$location','crudOPurchase','socketService' ,'$filter','$route','$log',
            function($scope,$http, $routeParams,$location,crudOPurchase,socket,$filter,$route,$log){
                $scope.purchases = [];
                $scope.purchase = {};
                $scope.payments=[];
                $scope.payment={};
                $scope.supplier={};
                $scope.methodPayments=[];
                $scope.methodPayment={};
                $scope.detPayment={};
                $scope.inputStocks=[];
                $scope.inputStock={};
                $scope.headInputStocks=[];
                headInputStock={};
                $scope.products=[];
                $scope.product={};
                $scope.pendientAccounts=[];
                $scope.pendientAccount={};
                $scope.cashHeaders=[];
                $scope.cashHeader={};
                $scope.atributes=[];
                $scope.atribute={};
                $scope.date=new Date();
                //$scope.idProvicional;
                $scope.totAnterior;
                $scope.errors = null;
                $scope.success;
                $scope.query = '';
                $scope.stores;
                $scope.purchase.store_id='1';
                $scope.date=new Date();
                //------------------------------------------------
            
                //-------------------------------------------------

                $scope.toggle = function () {
                    $scope.show = !$scope.show;
                };
                $scope.pagechan4=function(){
                    crudOPurchase.paginate('pendientAccounts',$scope.currentPage).then(function (data) {
                         $scope.pendientAccounts = data.data;
                    }); 
                }
                $scope.pagechan3=function(){
                    //alert(idobcional);
                    crudOPurchase.paginate('detPayments',$scope.currentPage).then(function (data) {
                            $scope.detPayments = data.data;
                        });
                }
                $scope.pagechan2=function(){
                    crudOPurchase.paginate('inputStocks',$scope.currentPage).then(function (data) {
                            $scope.headInputStocks = data.data;
                        });
                }
                $scope.pageChanged = function() {
                    if ($scope.query.length > 0) {
                        crudOPurchase.search('purchases',$scope.query,$scope.currentPage).then(function (data){
                        $scope.purchases = data.data;
                    });
                    }else{
                        crudOPurchase.paginate('purchases',$scope.currentPage).then(function (data) {
                            $scope.purchases = data.data;
                        });
                    }
                };
                var id = $routeParams.id;
                var idobcional;
                if(id)
                {
                    if($location.path() == '/purchases/edit/'+$routeParams.id) {
                    crudOPurchase.byId(id,'purchases').then(function (data) {
                            if(data.fechaEntrega != null) {
                              if (data.fechaEntrega.length > 0) {
                                $scope.purchases.fechaEntrega = new Date(data.fechaEntrega);
                              }
                            }
                             $scope.purchases = data;
                             $scope.purchase.montoBruto=parseFloat(data.montoBruto);
                             $scope.purchase.montoTotal=parseFloat(data.montoTotal);
                             $scope.purchase.descuento=parseFloat(data.descuento); 

                          crudOPurchase.paginateDPedido(data.id,'detailPurchases').then(function (data) {
                             $scope.detailPurchases = data.data;
                             $scope.maxSize = 5;
                             $scope.totalItems = data.total;
                             $scope.currentPage = data.current_page;
                             $scope.itemsperPage = 15;
                       
                           });
                      });
                     };
                    if($location.path() == '/purchases/show/'+$routeParams.id) {
                        crudOPurchase.select2('payments',id).then(function (data){
                               $scope.payment = data;
                               $scope.idProvicional=data.id;
                                $scope.totAnterior=data.Acuenta;
                            if(Number($scope.payment.Acuenta)>0){
                                  $scope.payment.PorPagado=((Number($scope.payment.Acuenta)*100)/(Number($scope.payment.MontoTotal))).toFixed(2);
                            }else{$scope.payment.PorPagado=0;}
                                  $scope.random();
                                  idobcional=data.id;
                        crudOPurchase.byId($scope.payment.id,'detPayments',1).then(function (data) {
                        $scope.detPayments = data.data;
                        $scope.maxSize = 5;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                        $scope.itemsperPage = 5;

                    });
                        });
                        crudOPurchase.byId(id,'purchases').then(function (data) {
                            $scope.purchase=data;
                            $scope.alamcenId=data.warehouses_id;
                            $scope.payment.purchase_id=data.id;
                            crudOPurchase.byId(data.supplier_id,'suppliers').then(function (data) {
                                 $scope.supplier=data;
                                $scope.payment.supplier_id=data.id;
                            });
                        crudOPurchase.listaCashes('cashHeaders',$scope.alamcenId).then(function (data) {
                            $scope.cashHeaders = data;
                        
                        });
                });
                        crudOPurchase.paginate('methodPayments',1).then(function (data) {
                        $scope.methodPayments = data.data;
                        $scope.maxSize = 5;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                        $scope.itemsperPage = 15;

                    });

                      $scope.detPayment.fecha=new Date();
                    };
                }else{
                    crudOPurchase.paginate('purchases',1).then(function (data) {
                        $scope.purchases = data.data;
                        $scope.maxSize = 5;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                        $scope.itemsperPage = 15;

                    });
                    
                   
                }

                socket.on('purchase.update', function (data) {
                    $scope.purchases=JSON.parse(data);
                });
                $scope.estado;

             /*   $scope.searchEstados=function(){
                    alert($scope.estado);
                    crudOPurchase.all('detailOrderPurchases',$scope.estado).then(function (data) {
                        $scope.purchases = data.data;
                        $scope.maxSize = 5;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                        $scope.itemsperPage = 15;

                    });methodPayments
                }*/

                crudOPurchase.paginate('suppliers',1).then(function (data) {
                        $scope.suppliers = data.data;
                     });

                $scope.limpiarStocks=function(){
                    $scope.inputStocks=[];
                }

                $scope.editCompra = function(row){
                    $location.path('/purchases/edit/'+row.id);
                };
                 $scope.verOrden= function(row){
                    $location.path('/orderPurchases/edit/'+row.orderPurchase_id);
                };
                $scope.searchPurchase = function(){
                if ($scope.query.length > 0) {
                    crudOPurchase.search('purchases',$scope.query,1).then(function (data){
                        $scope.purchases = data.data;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                    });
                }else{
                    crudOPurchase.paginate('purchases',1).then(function (data) {
                        $scope.purchases = data.data;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                    });
                }
                    
                };
                if($location.path() == '/purchases/showD') {
                    crudOPurchase.paginate('pendientAccounts',1).then(function (data) {
                        $scope.pendientAccounts = data.data;
                        $scope.maxSize = 5;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                        $scope.itemsperPage = 15;

                    });
                    crudOPurchase.autocomplit2('cashHeaders').then(function (data) {
                        $scope.cashHeaders = data;
                        
                        });
                }
                if($location.path() == '/purchases/create') {
                    crudOPurchase.paginate('inputStocks',1).then(function (data) {
                        $scope.headInputStocks = data.data;
                        $scope.maxSize = 5;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                        $scope.itemsperPage = 15;

                    });
                    crudOPurchase.select('warehouses','select').then(function(data){
                        $scope.warehouses = data;
                    });
                     crudOPurchase.autocomplit('products',1).then(function (data) {
                        $scope.products = data.data;
                       
                       
                    });
                   /*crudOPurchase.autocomplit2('products',1).then(function (data) {
                        $scope.products = data.data;
                    });*/
                    $scope.purchase.fecha=new Date();
                    $scope.purchase.tipo="Entrada";
               }
               $scope.mostrarCreate=false;
               $scope.ver=function(){
                   if ($scope.inputStocksCreateForm.$valid) {
                   $scope.mostrarCreate=!$scope.mostrarCreate;
                   }else{
                    alert("Complete Todos los Campos");
                   }
               }

                $scope.ListarinputStocks=function(row){
                
                crudOPurchase.byId(row.id,'inputStocks').then(function (data){
                            $scope.inputStocks=data.data;
                });
                }
                $scope.verStockActual1=function(){
                   
                    crudOPurchase.StockActual('stocks',$scope.product.proId.varid,$scope.purchase.warehouses_id).then(function (data){
                            $scope.stock=data;
                            $scope.inputStock.CantidaStock=data.stockActual;
                            
                   });
                }
               $scope.verStockActual=function(){
                if($scope.purchase.tipo=="Salida" || $scope.purchase.tipo=="Transferencia"){
                            if($scope.inputStock.CantidaStock<$scope.inputStock.cantidad_llegado || $scope.inputStock.cantidad_llegado<=0){
                                 alert("error esta cantidad es incorrecta no existe en stock");
                                 $scope.inputStock.cantidad_llegado='';
                            }
                }
               }
               //$scope.orderPurchase.eliminar=0;
               $scope.verEdicion=false;
               $scope.canselarEditDeudas=function(){
                $scope.verEdicion=false;
                   $scope.indexPirata=-1;
               }
               $scope.EditarDeudas=function(index){
                    $scope.indexPirata=index;
                    $scope.verEdicion=true;
               }
              $scope.saldoAnterior=0;
               $scope.ActualizarSaldo=function(row,nuevoSaldo){

                    if(Number(row.Saldo) >=nuevoSaldo){
                      if($scope.saldoAnterior==0){$scope.saldoAnterior=Number(row.Saldo);}
                      row.Saldo=$scope.saldoAnterior-nuevoSaldo;
                      if(row.Saldo==0){
                        row.estado=1;
                      }
                    }else{
                        alert("ERROR: el Monto ingresado no debe superar la deuda");
                    }
               }
               $scope.row={};
               $scope.CuentasAFavor=function(row){
                row.fecha=$scope.date.getFullYear()+'-'+($scope.date.getMonth()+1)+'-'+$scope.date.getDate();
                row.hora=$scope.date.getHours()+':'+$scope.date.getMinutes()+':'+$scope.date.getSeconds();
                crudOPurchase.update(row, 'pendientAccounts').then(function (data) {
                            if (data['estado'] == true) {
                                alert('Cuenta Editada Correctamente');
                                $scope.verEdicion=false;
                                $scope.indexPirata=-1;
                                $scope.saldoAnterior=0;
                            } else {
                                $scope.errors = data;

                            }
                        });
               }
               $scope.sacarRowStock=function(index){
                   $scope.inputStocks.splice(index,1);
               }
               $scope.companies=[];
               $scope.company={};
               $scope.badera=true;
               $scope.calCantidad=function(stockActual,atributos,sku,varCodigo,can,talla,TieneVariante){
                        alert(varCodigo);
                        if(can>0 && $scope.purchase.tipo=='Entrada'){
                    
                         $scope.badera=true;
                         if($scope.companies[0]!=undefined){
                             for(var n=0;n<$scope.companies.length;n++){
                                 if($scope.companies[n].talla==talla){
                                 $scope.companies[n].cantidad_llegado=can;
                                 $scope.badera=false;                      
                               }
                             }}
                     if($scope.badera==true){
                       
                    $scope.company.variant_id=varCodigo;
                     //$scope.detailOrderPurchase.preCompra=parseFloat(($scope.detailOrderPurchase.preProducto).toFixed(2));
                      //====================Traendo Presentacion==============================
                      crudOPurchase.select('detpres',varCodigo).then(function (data) {
                                    $scope.company.codigo=data.codigo;
                                    $scope.company.esbase=data.esbase;
                                    $scope.company.detPres_id=data.detpresen_id;
                                    $scope.company.cantidad_llegado=can;
                                    $scope.company.talla=talla;
                       $scope.companies.push($scope.company);
                       $scope.company={};
                                    
                                    
                        });
                    }
                
                     }else{
                        if(can>0 && can<=stockActual){
                             $scope.badera=true;
                             if($scope.companies[0]!=undefined){
                             for(var n=0;n<$scope.companies.length;n++){
                                 if($scope.companies[n].talla==talla){
                                  $scope.companies[n].cantidad_llegado=can;
                                   $scope.badera=false;                      
                               }
                             }}
                    if($scope.badera==true){
                    $scope.company.variant_id=varCodigo;
                     crudOPurchase.select('detpres',varCodigo).then(function (data) {
                                   $scope.company.codigo=data.codigo;
                                   $scope.company.esbase=data.esbase;
                                   $scope.company.detPres_id=data.detpresen_id;
                                   $scope.company.cantidad_llegado=can;
                                   $scope.company.talla=talla;
                                   
                    $scope.companies.push($scope.company);
                    $scope.company={};
                                    
                                    
                        });
                      //====================Fin========================================
                     //$scope.detailOrderPurchases.push($scope.detailOrderPurchase); 
                     }
                        }else{
                            $scope.cantidad='';
                        alert("Ingrese Cantidad mayor a cero o Ingrese Cantidad que no supere el Stock Actual!!!!");
                         }
                     }
                  }
               $scope.codigoVarP;
               $scope.CantidaStock='';
               $scope.obcionales=[];
               $scope.obcional={};
               $scope.mostrarTallas=function(taco){
                    alert($scope.codigoVarP);
                    if(taco!=null){
                    crudOPurchase.getTallas($scope.codigoVarP,taco,$scope.purchase.warehouses_id).then(function (data) {
                          $scope.atributes=data.data;
                    });
                    $scope.mostrarPresentacion=false;
                } else{
                    alert("Selecciones un numero de Taco!!!")
                }
                  }
               $scope.mostrarPresentacion=true;
                $scope.asignarProduc1=function(){
                    $scope.codigoVarP=$scope.product.proId.varCodigo;
                     crudOPurchase.MostrarAtributos($scope.product.proId.varCodigo,'Taco').then(function (data) {
                              $scope.variants=data.data;
                                //alert("Estoy Buscando Taco");
                              //if($scope.variants.length>0){$scope.Listo=false;}else{$scope.activarCampCantidad=false;}
                              if($scope.variants[0]==null)
                              {
                                       crudOPurchase.MostrarAtributos($scope.product.proId.varCodigo,'Talla').then(function (data) 
                                       {
                                              //alert("Estoy Buscando Talla");
                                              $scope.atributes=data.data;
                                             // if($scope.atributes.length>1){$scope.Listo=false;}else{$scope.activarCampCantidad=false;}
                                              //alert($scope.atributes.length);
                                              if($scope.atributes[0]==null)
                                              {
                                                $scope.activarCampCantidad=true;
                                                 //---------------------------------------------------------------
                                               }else{
                                                  $scope.mostrarPresentacion=false;
                                               }
                         
                                  });
                                  
                              
                                  }
                            });
                                
                        
            }
               $scope.verEntradasEstock=function(){
                    $scope.purchase.eliminar=1;
                  if( $scope.mostrarPresentacion==false ){
                    $log.log($scope.companies);
                        for(var n=0;n<$scope.companies.length;n++){
                            alert($scope.companies[n].cantidad);
                            $scope.companies[n].descripcion=$scope.inputStock.descripcion;
                            $scope.inputStocks.push($scope.companies[n]);
                         }
                         $scope.mostrarPresentacion=true;
                  }else{
                    if ($scope.inputStocksBodyCreateForm.$valid) {
                    alert($scope.purchase.warehouDestino_id);
                    if(parseInt($scope.purchase.warehouses_id)!=parseInt($scope.purchase.warehouDestino_id)){
                    $scope.inputStock.variant_id=$scope.product.proId.varid;
                    $scope.inputStock.codigo=$scope.product.proId.varCodigo;
                    crudOPurchase.select('detpres',$scope.product.proId.varid).then(function (data) {
                                    $scope.inputStock.esbase=data.esbase;
                                    $scope.inputStock.detPres_id=data.detpresen_id;
                                    crudOPurchase.byId($scope.purchase.warehouses_id,'warehouses').then(function (data) {
                                        $scope.inputStock.nombre=data.nombre;

                                    }); 
                    $scope.inputStocks.push($scope.inputStock);
                    $scope.inputStock={};
                    $scope.product.proId='';
                    if($scope.check==true){
                        $scope.variant.sku='';
                      }
                    });
                 }else{
                    alert("Error no se Puede Seleccionar dos Almacenes Iguales")
                 }
                    }else{alert("complete los campos");}
                 }}

                $scope.searchSkuEstock=function(sku){
                     $scope.purchase.eliminar=1;
                      crudOPurchase.autocomplitVar('variants',sku).then(function (data) {
                        $scope.product.proId = data;
                        if(data==null){
                            alert('No se a Encontrado Producto');
                            $scope.variant.sku='';
                        }else{
                            crudOPurchase.StockActual('stocks',$scope.product.proId.varid,$scope.purchase.warehouses_id).then(function (data){
                            $scope.stock=data;
                            $scope.inputStock.CantidaStock=data.stockActual;
                            
                     });
                    }
                        //alert(data.varCodigo);
            if($scope.product.proId.varCodigo!=null){
                     if(parseInt($scope.inputStock.warehouses_id)!=parseInt($scope.inputStock.warehouDestino_id)){
                     $scope.inputStock.variant_id=$scope.product.proId.varid;
                     $scope.inputStock.codigo=$scope.product.proId.varCodigo;
                     
                 }else{
                    alert("Error no se Puede Seleccionar dos Almacenes Iguales")
                 }}
             });
                    
                 }
                $scope.nuevo=function(){
                    $scope.mostrarCreate=false;
                    $scope.purchase.tipo="Entrada";
                    $scope.purchase.warehouses_id=''; 
                    $scope.purchase.warehouDestino_id='';
                    $scope.inputStock.cantidad_llegado='';
                    $scope.product.proId='';
                    $scope.inputStock.descripcion='';
                    $scope.inputStocks=[];
                }
                
                $scope.crearEntradasEstock=function(){
                    $scope.purchase.detailOrderPurchases=$scope.inputStocks;
                    $scope.mostrarCreate=!$scope.mostrarCreate;
                     //alert("sobre");
                    crudOPurchase.create($scope.purchase, 'inputStocks').then(function (data) {
                        // alert("debajo");
                            if (data['estado'] == true) {
                                alert('Movimiento Registrado');
                                $scope.purchase.warehouses_id=''; 
                                $scope.purchase.warehouDestino_id='';  
                                $scope.inputStocks=[];                             
                                $scope.mostrarCreate=false;
                                $scope
                                $location.path('/purchases/create');
                            } else {
                                $scope.errors = data;

                            }
                        });
                }
                $scope.traerPayments=function(row){
                    crudOPurchase.byId(row.id,'payments').then(function (data) {
                        $scope.payment=data;
                    });
                    $location.path('/purchases/create');
                }
        ///caja no es mia XD -------------------------------------------------------------------
                $scope.cajas={};
                $scope.cashes={};
                $scope.TraerSales=function(id){
                     crudOPurchase.byId(id,'cashes').then(function (data) {
                        $scope.cashes=data;
                        $scope.payment.cash_id=$scope.cashes.id; 
                        $scope.payment.fecha=$scope.date.getFullYear()+'-'+($scope.date.getMonth()+1)+'-'+$scope.date.getDate();
                        $scope.payment.hora=$scope.date.getHours()+':'+$scope.date.getMinutes()+':'+$scope.date.getSeconds();
                        $scope.payment.montoCaja=$scope.cashes.montoBruto;
                        $scope.payment.montoMovimientoTarjeta=0;
                        $scope.payment.cashMotive_id=7;
                        $scope.payment.estado=1;
                    });
                }

    ///---------------------------------------------------------------------------------
                $scope.Saldo1=0;
                $scope.recalPayments=function(){
                if($scope.Saldo1==0){$scope.Saldo1=$scope.payment.Saldo;}
                if($scope.payment.cash_id>0){
                    if(Number($scope.cashes.montoBruto)<=Number($scope.detPayment.montoPagado)){
                      $scope.detPayment.montoPagado=-1;
                    }
                    $scope.payment.montoMovimientoEfectivo=Number($scope.detPayment.montoPagado);
                    $scope.payment.montoFinal=Number($scope.payment.montoCaja)-$scope.payment.montoMovimientoEfectivo;
                }     //---------------------------------------------------
                if(Number($scope.Saldo1)>=Number($scope.detPayment.montoPagado) && Number($scope.payment.MontoTotal)>=Number($scope.detPayment.montoPagado) && Number($scope.detPayment.montoPagado)>0){
                    if($scope.payment.detpId>0){
                          $scope.payment.Acuenta=Number($scope.totAnterior)-Number($scope.PagoAnterior);
                          $scope.payment.Acuenta=Number($scope.payment.Acuenta)+Number($scope.detPayment.montoPagado);
                          $scope.payment.Saldo=(Number($scope.payment.MontoTotal)-Number($scope.payment.Acuenta)).toFixed(2);
                          $scope.payment.PorPagado=((Number($scope.payment.Acuenta)*100)/(Number($scope.payment.MontoTotal))).toFixed(2);
                          $scope.random();
                    }else{
                          $scope.payment.Acuenta=Number($scope.totAnterior)+Number($scope.detPayment.montoPagado);
                          $scope.payment.Saldo=(Number($scope.payment.MontoTotal)-Number($scope.payment.Acuenta)).toFixed(2);
                          $scope.payment.PorPagado=((Number($scope.payment.Acuenta)*100)/(Number($scope.payment.MontoTotal))).toFixed(2);
                          $scope.random();
                   }
                   }else{
                    $scope.detPayment.montoPagado='';
                    alert('!!Error Usted Solo Puede Ingresar una cantidad menor o igual al total!!');
                }
                }
               $scope.addMethodPaiment=function(){
                 $scope.detPayment=$scope.idProvicional;
                 $scope.detPayments.push($scope.detPayment);
                 $scope.detPayment={};
               }

                $scope.createdetPayment = function(){
                    //$scope.atribut.estado = 1;
                    $scope.detPayment.payment_id=$scope.idProvicional;
                    $scope.payment.detPayments=$scope.detPayment;
                        if ($scope.paymentCreateForm.$valid){
                            crudOPurchase.create($scope.payment, 'detPayments').then(function (data) {
                            if (data['estado'] == true) {
                               alert('grabado correctamente');
                               $scope.totAnterior=$scope.payment.Acuenta;
                               $scope.detPayment={};
                               $scope.detPayment.fecha=new Date();
                               $scope.payment.cash_id=0; 
                               $scope.Saldo1=0;
                               $scope.payment.cajamensual=false;
                               $scope.paginateDetPay();
                            } else {
                                $scope.errors = data;

                            }
                        });
                    }else{
                        alert("error");
                    }
                }
                $scope.paginateDetPay=function(){
                      crudOPurchase.byId($scope.idProvicional,'detPayments').then(function (data) {
                        $scope.detPayments = data.data;
                        $scope.maxSize = 5;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                        $scope.itemsperPage = 5;

                    });
                }
                $scope.destroyPay = function(row){
                    $scope.payment.detpId=row.id;
                    $scope.payment.cashMonthly_id=row.cashMonthly_id;
                    $scope.payment.detCash_id=row.detCash_id;
                    crudOPurchase.destroy($scope.payment,'payments').then(function(data)
                    {
                        if(data['estado'] == true){
                            $scope.success = data['nombre'];
                            $route.reload();

                        }else{
                            $scope.errors = data;
                        }
                    });
                }
                $scope.PagoAnterior;
                $scope.mostrarBtnGEd=false;
                 $scope.check=false;
                $scope.editDetpayment=function(row){
                    $scope.check=true;
                    if(row.cashMonthly_id>0){
                        $scope.payment.cajamensual=true;
                        $scope.payment.cashMonthly_id=row.cashMonthly_id;
                    }else{
                        $scope.payment.cajamensual=false;
                    }
                    $scope.payment.detpId=row.id;
                    $scope.detPayment.cashe_id=row.cashID;
                    $scope.payment.cash_id=$scope.detPayment.cashe_id;
                    $scope.payment.detCash_id=row.detCash_id;
                    $scope.detPayment.oldPay=row.montoPagado;
                    $scope.PagoAnterior=row.montoPagado;
                    $scope.detPayment.fecha=new Date(row.fecha);
                    $scope.detPayment.methodPayment_id=row.methodPayment_id;
                    $scope.detPayment.montoPagado=(parseFloat(row.montoPagado));
                    $scope.mostrarBtnGEd=true;
                }
                
                $scope.cashmontly=function(){
                     $scope.payment.months_id=$scope.date.getMonth()+1;
                     $scope.payment.año=$scope.date.getFullYear();
                     }
                $scope.editPayment = function(){
                    $scope.payment.detPayments=$scope.detPayment;
                    crudOPurchase.update($scope.payment,'payments').then(function(data)
                    {
                        if(data['estado'] == true){
                            $scope.success = data['nombre'];
                            $route.reload();

                        }else{
                            $scope.errors = data;
                        }
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
