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
                        //$scope.purchases = data;
                       
                       if(data.fechaEntrega != null) {
                            if (data.fechaEntrega.length > 0) {
                                $scope.purchases.fechaEntrega = new Date(data.fechaEntrega);
                                //alert(data.fechaPrevista);
                            }
                        }
                        $scope.purchases = data;
                       // alert( $scope.purchases.orderPurchase_id);
                        $scope.purchase.montoBruto=parseFloat(data.montoBruto);
                        $scope.purchase.montoTotal=parseFloat(data.montoTotal);
                        $scope.purchase.descuento=parseFloat(data.descuento); 

                       crudOPurchase.paginateDPedido(data.id,'detailPurchases').then(function (data) {
                        $scope.detailPurchases = data.data;
                        //$scope.detailPurchase.unidades=parseFloat(data.cantidad);
                        $scope.maxSize = 5;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                        $scope.itemsperPage = 15;
                       
                    });});
                     };
                    if($location.path() == '/purchases/show/'+$routeParams.id) {
                        //alert('ok');
                        //alert(id);
                        crudOPurchase.select2('payments',id).then(function (data){
                            $scope.payment = data;
                             $scope.idProvicional=data.id;
                              $scope.totAnterior=data.Acuenta;
                              if(Number($scope.payment.Acuenta)>0){
                              $scope.payment.PorPagado=((Number($scope.payment.Acuenta)*100)/(Number($scope.payment.MontoTotal))).toFixed(2);
                             }else{$scope.payment.PorPagado=0;}
                             $scope.random();
                             idobcional=data.id;
                         // alert(idobcional);
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
                            //alert($scope.supplier.empresa);
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
                        //$scope.maxSize = 5;
                        //$scope.totalItems = data.total;
                        //$scope.currentPage = data.current_page;
                        //$scope.itemsperPage = 15;
                       
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
                crudOPurchase.autocomplit2('products',1).then(function (data) {
                        $scope.products = data.data;
                    });
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
               $scope.verStockActual=function(){
                if($scope.purchase.tipo=="Salida"){
                   crudOPurchase.StockActual('stocks',$scope.product.proId.varid,$scope.purchase.warehouses_id).then(function (data){
                            $scope.stock=data;
                            if(data.stockActual<$scope.inputStock.cantidad_llegado || $scope.inputStock.cantidad_llegado<0){
                                 alert("error esta cantidad es incorrecta no existe en stock");
                                 $scope.inputStock.cantidad_llegado=0;
                            }
                   });
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
                //$scope.pendientAccount=row;
                row.fecha=$scope.date.getFullYear()+'-'+($scope.date.getMonth()+1)+'-'+$scope.date.getDate();
                row.hora=$scope.date.getHours()+':'+$scope.date.getMinutes()+':'+$scope.date.getSeconds();
                //$scope.pendientAccount=row;
                crudOPurchase.update(row, 'pendientAccounts').then(function (data) {
                         
                            if (data['estado'] == true) {
                                alert('Cuenta Editada Correctamente');
                                $scope.verEdicion=false;
                                $scope.indexPirata=-1;
                                $scope.saldoAnterior=0;
                                //$location.path('/purchases/create');
                            } else {
                                $scope.errors = data;

                            }
                        });
               }
               $scope.sacarRowStock=function(index){
                   $scope.inputStocks.splice(index,1);
               }
               $scope.verEntradasEstock=function(){
                     $scope.purchase.eliminar=1;
                     //$scope.inputStock.eliminar=1;

                     if ($scope.inputStocksBodyCreateForm.$valid) {
                     if(parseInt($scope.inputStock.warehouses_id)!=parseInt($scope.inputStock.warehouDestino_id)){
                     $scope.inputStock.variant_id=$scope.product.proId.varid;
                     $scope.inputStock.codigo=$scope.product.proId.varCodigo;
                     crudOPurchase.select('detpres',$scope.product.proId.varid).then(function (data) {
                                    $scope.inputStock.esbase=data.esbase;
                                    $scope.inputStock.detPres_id=data.detpresen_id;
                                    crudOPurchase.byId($scope.inputStock.warehouses_id,'warehouses').then(function (data) {
                                     $scope.inputStock.nombre=data.nombre;

                                   }); 
                    // alert($scope.inputStock.nombre);
                     
                     $scope.inputStocks.push($scope.inputStock);
                     $scope.inputStock={};
                     $scope.product.proId='';
                     $scope.variant.sku='';
                    
                    });
                 }else{
                    alert("Error no se Puede Seleccionar dos Almacenes Iguales")
                 }
                    }else{alert("complete los campos");}
                 }

                $scope.searchSkuEstock=function(sku){
                     $scope.purchase.eliminar=1;
                      crudOPurchase.autocomplitVar('variants',sku).then(function (data) {
                        $scope.product.proId = data;
                        //alert($scope.product.proId.id);
                        if(data==null){
                            alert('No se a Encontrado Producto');
                            $scope.variant.sku='';
                        }
                        //alert(data.varCodigo);
            /*if($scope.product.proId.varCodigo!=null){
                     //$scope.inputStock.eliminar=1;
                     if(parseInt($scope.inputStock.warehouses_id)!=parseInt($scope.inputStock.warehouDestino_id)){
                     $scope.inputStock.variant_id=$scope.product.proId.varid;
                     $scope.inputStock.codigo=$scope.product.proId.varCodigo;
                     crudOPurchase.select('detpres',$scope.product.proId.varid).then(function (data) {
                                    $scope.inputStock.esbase=data.esbase;
                                    $scope.inputStock.detPres_id=data.detpresen_id;
                                    crudOPurchase.byId($scope.inputStock.warehouses_id,'warehouses').then(function (data) {
                                     $scope.inputStock.nombre=data.nombre;

                                   }); 
                    // alert($scope.inputStock.nombre);
                     
                     //$scope.inputStocks.push($scope.inputStock);
                     //$scope.inputStock={};
                     //$scope.product.proId='';
                    
                    });
                 }else{
                    alert("Error no se Puede Seleccionar dos Almacenes Iguales")
                 }}*/});
                    
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
                   // alert(row.id);

                    crudOPurchase.byId(row.id,'payments').then(function (data) {
                        $scope.payment=data;
                        //alert($scope.payment.montoTotal);
                    });
                    $location.path('/purchases/create');
                }
        ///caja no es mia XD -------------------------------------------------------------------
                $scope.cajas={};
                 $scope.cashes={};
                $scope.TraerSales=function(id){
                    //alert("hola"+id);
                     crudOPurchase.byId(id,'cashes').then(function (data) {
                       $scope.cashes=data;
                        //alert($scope.cashes.montoBruto);
                    
                
                    ///$scope.payment={};
                    //$scope.detPayment.detCash_id=$scope.cashes.id;
                    $scope.payment.cash_id=$scope.cashes.id; 
                    $scope.payment.fecha=$scope.date.getFullYear()+'-'+($scope.date.getMonth()+1)+'-'+$scope.date.getDate();
                    $scope.payment.hora=$scope.date.getHours()+':'+$scope.date.getMinutes()+':'+$scope.date.getSeconds();
                    $scope.payment.montoCaja=$scope.cashes.montoBruto;
                    $scope.payment.montoMovimientoTarjeta=0;
                    $scope.payment.cashMotive_id=7;
                    $scope.payment.estado=1;
                    //$scope.sale.fechaPedido=$scope.date.getFullYear()+'-'+($scope.date.getMonth()+1)+'-'+$scope.date.getDate()+' '+$scope.date.getHours()+':'+$scope.date.getMinutes()+':'+$scope.date.getSeconds();
                    //$scope.sale.detOrders=$scope.compras;
                    //$scope.sale.movimiento=$scope.payment; 
                    //$scope.sale.caja=$scope.cashfinal;
                    });
                }

    ///---------------------------------------------------------------------------------
                $scope.Saldo1=0;
                $scope.recalPayments=function(){
                  //  alert($scope.Saldo1);
                if($scope.Saldo1==0){$scope.Saldo1=$scope.payment.Saldo;}
                if($scope.payment.cash_id>0){
                   // alert('hola');
                   if(Number($scope.cashes.montoBruto)<=Number($scope.detPayment.montoPagado)){
                      $scope.detPayment.montoPagado=-1;
                    }
                    $scope.payment.montoMovimientoEfectivo=Number($scope.detPayment.montoPagado);
                    $scope.payment.montoFinal=Number($scope.payment.montoCaja)-$scope.payment.montoMovimientoEfectivo;
                    //$scope.cashes.gastos=Number($scope.cashes.gastos)+Number($scope.payment.montoMovimientoEfectivo); 
                    //$scope.cashes.montoBruto=$scope.payment.montoFinal;
                }     //---------------------------------------------------
               // alert($scope.payment.MontoTotal);
                if(Number($scope.Saldo1)>=Number($scope.detPayment.montoPagado) && Number($scope.payment.MontoTotal)>=Number($scope.detPayment.montoPagado) && Number($scope.detPayment.montoPagado)>0){
                    if($scope.payment.detpId>0){
                          $scope.payment.Acuenta=Number($scope.totAnterior)-Number($scope.PagoAnterior);
                          //alert($scope.payment.Acuenta);
                          $scope.payment.Acuenta=Number($scope.payment.Acuenta)+Number($scope.detPayment.montoPagado);
                          $scope.payment.Saldo=(Number($scope.payment.MontoTotal)-Number($scope.payment.Acuenta)).toFixed(2);
                          $scope.payment.PorPagado=((Number($scope.payment.Acuenta)*100)/(Number($scope.payment.MontoTotal))).toFixed(2);
                          $scope.random();
                    }else{
                        //alert($scope.totAnterior);
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
                    //alert($scope.payment.id);
                    //if ($scope.TtypeCreateForm.$valid) {
                        if ($scope.paymentCreateForm.$valid){
                        crudOPurchase.create($scope.payment, 'detPayments').then(function (data) {
                          
                            if (data['estado'] == true) {
                                
                                alert('grabado correctamente');
                               // $scope.detPayments={};
                               $scope.totAnterior=$scope.payment.Acuenta;
                               $scope.detPayment={};
                               $scope.detPayment.fecha=new Date();
                               $scope.payment.cash_id=0; 
                               $scope.Saldo1=0;
                               $scope.payment.cajamensual=false;
                               //$scope.detPayment.montoPagado='';
                                $scope.paginateDetPay();
                                //$location.path('/types');

                            } else {
                                $scope.errors = data;

                            }
                        });
                    }else{
                        alert("error");
                    }
                   // }else{
                    //    alert("error");
                    //}*/
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
                    //alert(row.cashID);
                    $scope.payment.detpId=row.id;
                    $scope.payment.cashMonthly_id=row.cashMonthly_id;
                   // $scope.Payment.cash_id=parseInt(row.cashID);
                    $scope.payment.detCash_id=row.detCash_id;
                    crudOPurchase.destroy($scope.payment,'payments').then(function(data)
                    {
                        if(data['estado'] == true){
                            $scope.success = data['nombre'];
                            //$scope.Ttype = {};
                            //alert('hola');
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
                    //alert($scope.payment.cajamensual);
                     $scope.payment.months_id=$scope.date.getMonth()+1;
                     $scope.payment.año=$scope.date.getFullYear();
                     }
                $scope.editPayment = function(){
                    $scope.payment.detPayments=$scope.detPayment;
                    
                    crudOPurchase.update($scope.payment,'payments').then(function(data)
                    {
                        if(data['estado'] == true){
                            $scope.success = data['nombre'];
                            //$scope.Ttype = {};
                            //alert('hola');
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
