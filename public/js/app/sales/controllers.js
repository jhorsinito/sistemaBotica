(function(){
    angular.module('sales.controllers',[])
        .controller('SaleController',['$scope', '$routeParams','$location','crudServiceOrders','socketService' ,'$filter','$route','$log','$window','$modal',
            function($scope, $routeParams,$location,crudServiceOrders,socket,$filter,$route,$log, $window,$modal){
                
                $scope.errors = null;
                $scope.success;
                $scope.query = ''; 
                /*

                $scope.orders = [];
                $scope.order1={};
                
                $scope.detOrders=[];
                    $scope.sale={};
                    $scope.stores={};
                    $scope.store={};
                    $scope.warehouses={};
                    $scope.warehouse={};
                    $scope.warehouse.id='1';
                    $scope.store.id='1';
                    $scope.atributos={};
                    $scope.compras=[];
                    $scope.compra={};
                    $scope.sale.montoBruto=0;
                    $scope.sale.descuento=0; 
                    $scope.sale.montoTotal=0;
                    $scope.sale.montoTotalSinDescuento=0;
                    $scope.sale.igv=0;
                    $scope.bandera=false;
                    $scope.acuenta;
                    $scope.customer={};
                    $scope.date = new Date();
                    $scope.base=true;
                    $scope.presentations=[];
                    $scope.pago={};
                    $scope.pago.tarjeta=0;
                    $scope.pago.cash=0;
                    $scope.radioModel;
                    $scope.saledetPayments=[];
                    $scope.saledetPayment={};
                    $scope.salePayment={};
                */

                $scope.inicializar = function (){
                    $scope.orders = [];
                    $scope.sale={};
                    //$scope.stores={};
                    $scope.store={};
                    //$scope.warehouses={};
                    $scope.warehouse={};
                    $scope.warehouse.id='1';
                    $scope.store.id='1';
                    $scope.atributos={};
                    $scope.compras=[];
                    $scope.compra={};
                    $scope.sale.montoBruto=0;
                    $scope.sale.descuento=0;
                    $scope.sale.montoTotal=0;
                    $scope.sale.notas="";
                    $scope.sale.montoTotalSinDescuento=0;
                    $scope.sale.igv=0;
                    $scope.bandera=false;
                    $scope.banderaNotas=true;
                    $scope.banderaPagosCash=true;
                    $scope.banderadeleteFavorito=true;
                    $scope.banderaPagosTarjeta=true;
                    $scope.acuenta=false;
                    $scope.customer={};
                    $scope.date = new Date();
                    $scope.base=true;
                    $scope.skuestado=true;
                    $scope.presentations=[];
                    $scope.pago={};
                    $scope.pago.tarjeta=0;
                    $scope.pago.cash=0;
                    $scope.radioModel=undefined;
                    $scope.saledetPayments=[];
                    $scope.detPayments={};
                    $scope.saledetPayment={};
                    $scope.salePayment={};
                    $scope.payment={};
                    $scope.atributoSelected=undefined;
                    $scope.customersSelected=undefined;
                    $scope.employeeSelected=undefined;
                    $scope.sale.customer_id=undefined;
                    $scope.sale.employee_id=undefined;
                    $scope.sale.vuelto=0;
                    $scope.exitCustumer=false;
                    //$scope.cashHeaders={};
                    $scope.cash1={};
                    $scope.cash1.cashHeader_id='1';
                    $scope.cashes={};
                    $scope.cashfinal={};

                }

                $scope.inicializar();
                $scope.oPres;

                $scope.mostrarAlmacenCaja = function () {
                    crudServiceOrders.search('searchHeaders',$scope.store.id,1).then(function (data){
                        $scope.cashHeaders=data;
                    });
                    crudServiceOrders.search('warehousesStore',$scope.store.id,1).then(function (data){
                        $scope.warehouses=data.data;
                    });
                    crudServiceOrders.search('cashes',$scope.cash1.cashHeader_id,1).then(function (data){
                        var canCashes=data.total;
                        var pagActual=Math.ceil(canCashes/15);
                        crudServiceOrders.search('cashes',$scope.cash1.cashHeader_id,pagActual).then(function (data){
                            $scope.cashes = data.data;
                            $scope.cashfinal=$scope.cashes[$scope.cashes.length-1];
                        });
                    });    
                }
                $scope.createmovCaja = function(tipo){
                    $scope.detCash={};
                    $scope.mostrarAlmacenCaja();

                    $scope.detCash.cash_id=$scope.cashfinal.id; 
                    $scope.detCash.fecha=$scope.date.getFullYear()+'-'+($scope.date.getMonth()+1)+'-'+$scope.date.getDate();
                    $scope.detCash.hora=$scope.date.getHours()+':'+$scope.date.getMinutes()+':'+$scope.date.getSeconds();
                    $scope.detCash.montoCaja=$scope.cashfinal.montoBruto;
                    
                    $scope.detCash.montoMovimientoTarjeta=Number($scope.pago.tarjeta);
                    $scope.detCash.montoMovimientoEfectivo=Number($scope.pago.cash);
                    $scope.detCash.montoFinal=Number($scope.detCash.montoCaja)+$scope.detCash.montoMovimientoTarjeta+$scope.detCash.montoMovimientoEfectivo;
                    $scope.detCash.estado='1'; 
                    //alert(tipo);
                    if(tipo=='credito'){
                        $scope.detCash.cashMotive_id='14';    
                    }else if(tipo=='contado'){
                        $scope.detCash.cashMotive_id='1';   
                    }
                    

                    $scope.cashfinal.ingresos=Number($scope.cashfinal.ingresos)+Number($scope.detCash.montoMovimientoTarjeta)+Number($scope.detCash.montoMovimientoEfectivo); 
                    $scope.cashfinal.montoBruto=$scope.detCash.montoFinal;
                    //////////////////////////////////////////////

                    $scope.sale.fechaPedido=$scope.date.getFullYear()+'-'+($scope.date.getMonth()+1)+'-'+$scope.date.getDate()+' '+$scope.date.getHours()+':'+$scope.date.getMinutes()+':'+$scope.date.getSeconds();
                    $scope.sale.detOrders=$scope.compras;
                    $scope.sale.movimiento=$scope.detCash; 
                    $scope.sale.caja=$scope.cashfinal;
                }

                $scope. createorder = function(tipo){

                    crudServiceOrders.search('cashes',$scope.cash1.cashHeader_id,1).then(function (data){
                        var canCashes=data.total;
                        var pagActual=Math.ceil(canCashes/15);
                        crudServiceOrders.search('cashes',$scope.cash1.cashHeader_id,pagActual).then(function (data){

                            $scope.cashes = data.data;
                            $scope.cashfinal=$scope.cashes[$scope.cashes.length-1];

                        
                            $scope.createmovCaja(tipo);
                            //$log.log($scope.cashfinal);
                        
                            //$log.log($scope.sale);

                            for (var i = 0; i < $scope.sale.saledetPayments.length; i++) {
                                $scope.sale.saledetPayments[i].numCaja=$scope.detCash.cash_id;
                            };
                    
                             crudServiceOrders.create($scope.sale, 'sales').then(function (data) {
                           
                                    if (data['estado'] == true) {
                                        $scope.success = data['nombres'];
                                    alert('grabado correctamente');

                                 
                                        //$location.path('/orders');

                                        crudServiceOrders.reportProWare('productsFavoritos',$scope.store.id,$scope.warehouse.id,'1').then(function(data){    
                                            $scope.favoritos=data;
                                            $log.log($scope.favoritos);
                                        });
                                

                                    } else {
                                        $scope.errors = data;
                                    }
                            });

                            $scope.inicializar();
                        })    
                    });
                }
                $scope.actualizarCaja= function(){
                    //$log.log($scope.cashfinal);
                    $scope.detCashes={};
                    if ($scope.cashfinal.estado == 0) {       
                        //alert("Caja Cerrada");
                    }else{
                        crudServiceOrders.search('detCashesSale',$scope.cashfinal.id,1).then(function (data){
                            $scope.detCashes = data.data;
                            $scope.maxSize1 = 5;
                            $scope.totalItems1 = data.total;
                            $scope.currentPage1 = data.current_page;
                            $scope.itemsperPage1 = 15;
                        });
                    }
                        
                }
                $scope.pageChanged1 = function() {
                    if ($scope.query.length > 0) {
                        crudServiceOrders.search('detCashesSale',$scope.cashfinal.id,$scope.currentPage1).then(function (data){
                            $scope.detCashes = data.data;
                        });
                    }else{
                        crudServiceOrders.search('detCashesSale',$scope.cashfinal.id,$scope.currentPage1).then(function (data){
                            $scope.detCashes = data.data;
                        });
                    }
                };
                /*
                $scope.createcash = function(){
                    $scope.mostrarAlmacenCaja();

                    $scope.detCash={};

                    $scope.detCash.cash_id=$scope.cashfinal.id; 
                    $scope.detCash.fecha=$scope.date.getFullYear()+'-'+($scope.date.getMonth()+1)+'-'+$scope.date.getDate();
                    $scope.detCash.hora=$scope.date.getHours()+':'+$scope.date.getMinutes()+':'+$scope.date.getSeconds();
                    $scope.detCash.montoCaja=$scope.cashfinal.montoBruto;
                    $scope.detCash.cashMotive_id='1';
                    $scope.detCash.montoMovimientoCash=$scope.pago.cash;
                    $scope.detCash.montoMovimientoEfectivo=$scope.pago.tarjeta;
                    $scope.detCash.montoFinal=Number($scope.detCash.montoCaja)+$scope.detCash.montoMovimientoCash+$scope.detCash.montoMovimientoEfectivo;
                    $scope.detCash.estado='1';

                    $scope.cashfinal.ingresos=Number($scope.cashfinal.ingresos)+Number($scope.detCash.montoMovimiento); 
                    $scope.cashfinal.montoBruto=$scope.detCash.montoFinal;
                    $log.log('-------------');
                    $log.log($scope.detCash);

                }*/
                $scope.estadoNotas = function () {
                    if($scope.sale.notas==""){
                        $scope.banderaNotas=true;
                    }else{
                        $scope.banderaNotas=false;     
                    }
                }
                $scope.delFavEst = function () {
                    //alert($scope.banderadeleteFavorito);
                    if($scope.banderadeleteFavorito){
                        $scope.banderadeleteFavorito=false;
                    }else{
                        $scope.banderadeleteFavorito=true;     
                    }
                }
                crudServiceOrders.AsignarCom = function (){
                    //alert("fdfdfdfdf");

                    $scope.atributoSelected=crudServiceOrders.getPres();
                    
                        //alert("pase");
                        //$log.log($scope.atributoSelected);
                        if ($scope.atributoSelected.NombreAtributos!=undefined) {
                            //if ($scope.atributoSelected.equivalencia<=$scope.atributoSelected.Stock) {        
                                $scope.atributoSelected.cantidad=1;
                                $scope.atributoSelected.descuento=0;
                                $scope.atributoSelected.subTotal=$scope.atributoSelected.cantidad*Number($scope.atributoSelected.precioProducto);
                                $scope.atributoSelected.precioVenta=Number($scope.atributoSelected.precioProducto);
                    
                                $scope.compras.push($scope.atributoSelected);  

                                $scope.sale.montoTotal=$scope.sale.montoTotalSinDescuento+$scope.atributoSelected.subTotal;
                                $scope.recalcularCompra();
                                //$scope.sale.montoTotalSinDescuento=$scope.sale.montoTotal;
                                //$scope.sale.montoBruto=Number($scope.sale.montoTotal)/1.18;
                                //$scope.sale.igv=$scope.sale.montoTotal-$scope.sale.montoBruto;
                                //}else{
                                  //  alert("STOCK menor a la Presentacion");    
                                //}
                            }else{
                                alert("Seleccione Producto Correctamente");
                                $scope.atributoSelected=undefined;
                            }
                    
                    $scope.atributoSelected=undefined;
                    //$log.log(crudServiceOrders.getPres());
                }



                $scope.pagar = function () {
                    if ($scope.sale.montoTotal==0) {
                        alert("Seleccione productos");
                    }else{
                        
                    }
                }
                $scope.calcularVuelto = function () {
                    if ($scope.pago.tarjeta+$scope.pago.cash>$scope.sale.montoTotal) {
                        $scope.sale.vuelto=(Number($scope.pago.tarjeta)+Number($scope.pago.cash)-Number($scope.sale.montoTotal));
                        //$scope.pago.cash=$scope.pago.cash-(Number($scope.pago.tarjeta)+Number($scope.pago.cash)-Number($scope.sale.montoTotal));
                    }else{
                         $scope.sale.vuelto=0;   
                    };
                    if($scope.pago.cash==undefined){
                        $scope.pago.cash=0;
                    }
                    if($scope.pago.tarjeta==undefined){
                        $scope.pago.tarjeta=0;
                    }
                }

                $scope.realizarPago = function () {
                //$log.log($scope.cashfinal.estado);
                //$scope.mostrarAlmacenCaja();    
                if ($scope.cashfinal.estado=='1') {
                    $scope.salePayment.MontoTotal=$scope.sale.montoTotal;
                    $scope.salePayment.Acuenta=0;
                    $scope.salePayment.customer_id=$scope.sale.customer_id;

                    if($scope.pago.tarjeta>0 || $scope.pago.cash>0){
                        if($scope.acuenta){
                            //Inicia Pago Credito 
                            alert("credito");
                            if($scope.customersSelected==undefined){
                                alert("Elija Cliente");
                            }
                            else{
                                $scope.salePayment.estado=1;
                                $scope.sale.estado=1;
                                if ($scope.pago.tarjeta+$scope.pago.cash>$scope.sale.montoTotal){
                                    alert("Usa Pago Contado");
                                }else{
                                if ($scope.radioModel!=undefined && $scope.pago.tarjeta==0) {
                                    alert("Elija monto Pago Tarjeta");
                                }else if($scope.radioModel!=undefined && $scope.pago.tarjeta>0){
                                    $scope.salePayment.Acuenta=$scope.salePayment.Acuenta+$scope.pago.tarjeta;
                                    $scope.saledetPayment.fecha=$scope.date.getFullYear()+'-'+($scope.date.getMonth()+1)+'-'+$scope.date.getDate()+' '+$scope.date.getHours()+':'+$scope.date.getMinutes()+':'+$scope.date.getSeconds();
                                    $scope.saledetPayment.monto=$scope.pago.tarjeta;
                                    $scope.saledetPayment.saleMethodPayment_id=$scope.radioModel;
                                    $scope.salePayment.Saldo=$scope.salePayment.MontoTotal-$scope.salePayment.Acuenta;
                                    $scope.saledetPayments.push($scope.saledetPayment);                                 
                                    $scope.saledetPayment={};
                                }
                                else if($scope.radioModel==undefined && $scope.pago.tarjeta>0){
                                    alert("Elija Tarjeta.");
                                    $scope.banderaPagosTarjeta=false;
                                }

                                if($scope.pago.cash>0&&$scope.banderaPagosTarjeta){
                                    $scope.salePayment.Acuenta=$scope.salePayment.Acuenta+$scope.pago.cash;
                                    $scope.saledetPayment.fecha=$scope.date.getFullYear()+'-'+($scope.date.getMonth()+1)+'-'+$scope.date.getDate()+' '+$scope.date.getHours()+':'+$scope.date.getMinutes()+':'+$scope.date.getSeconds();
                                    $scope.saledetPayment.monto=$scope.pago.cash;
                                    $scope.saledetPayment.saleMethodPayment_id='1';

                                    $scope.salePayment.Saldo=$scope.salePayment.MontoTotal-$scope.salePayment.Acuenta;

                                    $scope.saledetPayments.push($scope.saledetPayment);                                
                                    $scope.saledetPayment={};   
                                }

                                if ($scope.banderaPagosCash&&$scope.banderaPagosTarjeta) {
                                    $scope.sale.saledetPayments=$scope.saledetPayments;
                                    $scope.sale.salePayment=$scope.salePayment;
                                    var tipo='credito';
                                    $scope.createorder(tipo);
                                };
                                }
                            $scope.banderaPagosTarjeta=true;
                            }
                           //Termina Pago Credito 
                        }else{
                            //Inicio Pago Contado 
                            if ($scope.pago.tarjeta+$scope.pago.cash>$scope.sale.montoTotal) {
                                alert("Vuelto : "+(Number($scope.pago.tarjeta)+Number($scope.pago.cash)-Number($scope.sale.montoTotal)));
                                $scope.pago.cash=$scope.pago.cash-(Number($scope.pago.tarjeta)+Number($scope.pago.cash)-Number($scope.sale.montoTotal));
                            };
                            if ($scope.pago.tarjeta+$scope.pago.cash<$scope.sale.montoTotal) {
                                alert("Pago menor a la compra");
                            }else{
                            alert("Contado");
                            //if (true) {};
                            $scope.salePayment.estado=0;
                            $scope.sale.estado=0;
                            if ($scope.radioModel!=undefined && $scope.pago.tarjeta==0) {
                                alert("Elija monto Pago Tarjeta");
                            }else if($scope.radioModel!=undefined && $scope.pago.tarjeta>0){
                                $scope.salePayment.Acuenta=$scope.salePayment.Acuenta+$scope.pago.tarjeta;
                                $scope.saledetPayment.fecha=$scope.date.getFullYear()+'-'+($scope.date.getMonth()+1)+'-'+$scope.date.getDate()+' '+$scope.date.getHours()+':'+$scope.date.getMinutes()+':'+$scope.date.getSeconds();
                                $scope.saledetPayment.monto=$scope.pago.tarjeta;
                                $scope.saledetPayment.saleMethodPayment_id=$scope.radioModel;
                                $scope.salePayment.Saldo=$scope.salePayment.MontoTotal-$scope.salePayment.Acuenta;
                                $scope.saledetPayments.push($scope.saledetPayment);                                  
                                $scope.saledetPayment={};
                            }
                            else if($scope.radioModel==undefined && $scope.pago.tarjeta>0){
                                alert("Elija Tarjeta");
                                $scope.banderaPagosTarjeta=false;
                            }
                            if($scope.pago.cash>0 && $scope.banderaPagosTarjeta){
                                //alert($scope.banderaPagos);
                                $scope.salePayment.Acuenta=$scope.salePayment.Acuenta+$scope.pago.cash;
                                $scope.saledetPayment.fecha=$scope.date.getFullYear()+'-'+($scope.date.getMonth()+1)+'-'+$scope.date.getDate()+' '+$scope.date.getHours()+':'+$scope.date.getMinutes()+':'+$scope.date.getSeconds();
                                $scope.saledetPayment.monto=$scope.pago.cash;
                                $scope.saledetPayment.saleMethodPayment_id='1';
                                $scope.salePayment.Saldo=$scope.salePayment.MontoTotal-$scope.salePayment.Acuenta;
                                $scope.saledetPayments.push($scope.saledetPayment);                                
                                $scope.saledetPayment={};   
                            }
                            if ($scope.banderaPagosCash&&$scope.banderaPagosTarjeta) {
                                $scope.sale.saledetPayments=$scope.saledetPayments;
                                $scope.sale.salePayment=$scope.salePayment;
                                //crear compra
                                var tipo='contado';
                                $scope.createorder(tipo);
                                //$log.log($scope.sale);
                                };
                                $scope.banderaPagosTarjeta=true;
                            }
                        }
                    }
                    else{
                            alert("No puede realizar pago");

                    }
                    //--
                    
                    }else{
                        alert("Caja Cerrada");
                        //$scope.createcash();
                    }

                }

               

                

                $scope.toggle = function () {
                    $scope.show = !$scope.show;
                };

                
                
                $scope.createCustomer = function(){

                    if ($scope.customerCreateForm.$valid) {
                        crudServiceOrders.create($scope.customer, 'customers').then(function (data) {
                           
                            if (data['estado'] == true) {
                                $scope.exitCustumer=true;
                                $scope.success = data['nombres'];
                                alert('grabado correctamente');
                                //$location.path('/customers');

                            } else {
                                $scope.errors = data.responseJSON;

                            }
                        });
                    }
                    $scope.customer={};
                }
                $scope.varianteSkuSelected;
                $scope.varianteSkuSelected1=undefined;
                $scope.getvariantSKU = function(size) {
                    if($scope.varianteSkuSelected.length <10){
                        //alert("hola");
                    }else if($scope.varianteSkuSelected.length==10){
                        //alert("entre" + $scope.varianteSkuSelected);
                        crudServiceOrders.reportProWare('productsSearchsku',$scope.store.id,$scope.warehouse.id,$scope.varianteSkuSelected).then(function(data){    
                            $scope.varianteSkuSelected1={};
                            $scope.varianteSkuSelected1=data;
                            //$log.log($scope.varianteSkuSelected1);

                            if ($scope.varianteSkuSelected1[0].Stock>0) { 
                                $scope.Jalar(size);
                            }else{
                                alert("STOCK INSUFICIENTE");
                                $scope.varianteSkuSelected=undefined;
                            }                                                          
                        });
                    }
                };
                $scope.Jalar = function(size) {
                    $log.log($scope.varianteSkuSelected1.length);
                    if ($scope.varianteSkuSelected1.length>0) {
                        crudServiceOrders.reportProWare('productsVariantes',$scope.store.id,$scope.warehouse.id,$scope.varianteSkuSelected1[0].vari).then(function(data){    
                            $scope.presentations = data;
                            $log.log($scope.presentations);
                            if($scope.base){                
                                    $scope.varianteSkuSelected1[0].cantidad=1;
                                    $scope.varianteSkuSelected1[0].descuento=0;
                                    $scope.varianteSkuSelected1[0].subTotal=$scope.varianteSkuSelected1[0].cantidad*Number($scope.varianteSkuSelected1[0].precioProducto);
                                    $scope.varianteSkuSelected1[0].precioVenta=Number($scope.varianteSkuSelected1[0].precioProducto);
                        
                                   $scope.compras.push($scope.varianteSkuSelected1[0]);  
    
                                    $scope.sale.montoTotal=$scope.sale.montoTotalSinDescuento+$scope.varianteSkuSelected1[0].subTotal;
                                    $scope.recalcularCompra();
                                    //$scope.sale.montoTotalSinDescuento=$scope.sale.montoTotal;
                                    //$scope.sale.montoBruto=Number($scope.sale.montoTotal)/1.18;
                                    //$scope.sale.igv=$scope.sale.montoTotal-$scope.sale.montoBruto;
                               $scope.varianteSkuSelected1=undefined;
                                $scope.varianteSkuSelected="";
    
                            }else{                           
                                var modalInstance = $modal.open({      
                                    //animation: $scope.animationsEnabled,
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



                $scope.atributoSelected=undefined;
                $scope.getAtributos = function(val) {
                  return crudServiceOrders.reportProWare('products',$scope.store.id,$scope.warehouse.id,val).then(function(response){
                    return response.map(function(item){
                        //$log.log(item);
                      return item;
                    });
                  });
                };
                $scope.customersSelected=undefined;
                $scope.getcustomers = function(val) {
                    //$log.log(val);
                  return crudServiceOrders.search('customersVenta',val,1).then(function(response){
                    return response.data.map(function(item){
                      //alert(item.nombre);
                      $scope.sale.customer_id=item.id;
                      $scope.sale.cliente=item.busqueda;
                      //$scope.customersSelected=undefined; 
                      return item;
                    });
                  });
                };
                $scope.deleteCliente= function(){
                    $scope.sale.customer_id=undefined;
                    $scope.sale.cliente=undefined;
                    $scope.customersSelected=undefined;    
                }

                $scope.employeeSelected=undefined;
                $scope.getemployee = function(val) {
                    //$log.log(val);
                  return crudServiceOrders.search('employeesVenta',val,1).then(function(response){
                    return response.data.map(function(item){
                      //alert(item.nombre);
                      $scope.sale.employee_id=item.id;
                      $scope.sale.vendedor=item.busqueda;
                      return item;
                    });
                  });
                };
                $scope.deleteVendedor= function(){
                    $scope.sale.employee_id=undefined;
                    $scope.sale.vendedor=undefined;
                    $scope.employeeSelected=undefined;    
                }
                //------------------------------------
                //------------------------------------
                //------------------------------------
                $scope.pagoCredito={};
                $scope.detPago={};
                $scope.createdetPayment = function(){
                    if($scope.detPago.monto<0){
                        alert("Numero no valido");
                    }else{
                        $scope.pagoCredito=$scope.payment[0]; 
                        crudServiceOrders.search('cashes',$scope.cash1.cashHeader_id,1).then(function (data){
                        var canCashes=data.total;
                        var pagActual=Math.ceil(canCashes/15);
                            //alert(pagActual);

                            crudServiceOrders.search('cashes',$scope.cash1.cashHeader_id,pagActual).then(function (data){    
                                $scope.cashes = data.data;

                                $scope.cashfinal=$scope.cashes[$scope.cashes.length-1];

                                if ($scope.cashfinal.estado=='1') {

                                    $scope.detCash={};
                                    $scope.mostrarAlmacenCaja();

                                    $scope.detCash.cash_id=$scope.cashfinal.id; 
                                    $scope.detCash.fecha=$scope.date.getFullYear()+'-'+($scope.date.getMonth()+1)+'-'+$scope.date.getDate();
                                    $scope.detCash.hora=$scope.date.getHours()+':'+$scope.date.getMinutes()+':'+$scope.date.getSeconds();
                                    $scope.detCash.montoCaja=$scope.cashfinal.montoBruto;
                                    $scope.detCash.cashMotive_id='13';

                                    if ($scope.detPago.saleMethodPayment_id=='1') {
                                        $scope.detCash.montoMovimientoEfectivo=Number($scope.detPago.monto);
                                        $scope.detCash.montoMovimientoTarjeta=0;
                                        
                                    }else{
                                        $scope.detCash.montoMovimientoTarjeta=Number($scope.detPago.monto);
                                        $scope.detCash.montoMovimientoEfectivo=0;         
                                    }                        
                        
                                    $scope.detCash.montoFinal=Number($scope.detCash.montoCaja)+$scope.detCash.montoMovimientoTarjeta+$scope.detCash.montoMovimientoEfectivo;
                                    $scope.detCash.estado='1';

                                    $scope.cashfinal.ingresos=Number($scope.cashfinal.ingresos)+Number($scope.detCash.montoMovimientoTarjeta)+Number($scope.detCash.montoMovimientoEfectivo); 
                                    $scope.cashfinal.montoBruto=$scope.detCash.montoFinal;
                                    //////////////////////////////////////////////
                                    $scope.pagoCredito.movimiento=$scope.detCash; 
                                    $scope.pagoCredito.caja=$scope.cashfinal;



                    
                                    if(Number($scope.pagoCredito.Saldo)>=$scope.detPago.monto){
                                        $scope.pagoCredito.Acuenta=Number($scope.pagoCredito.Acuenta)+$scope.detPago.monto;
                                        $scope.pagoCredito.Saldo=Number($scope.pagoCredito.Saldo)-$scope.detPago.monto;

                                        $scope.detPago.salePayment_id=$scope.payment[0].id;

                                        $scope.pagoCredito.detPayments=$scope.detPago;
                                        //--------------
                                        crudServiceOrders.byId($scope.pagoCredito.sale_id,'sales').then(function (data) {
                                                $scope.saleCredito=data;
                                                
                                                $scope.pagoCredito.sale=$scope.saleCredito;
                                                $log.log($scope.pagoCredito);

                                            crudServiceOrders.create($scope.pagoCredito, 'saledetPayments').then(function (data) {
                          
                                                if (data['estado'] == true) {
                                
                                                    alert('grabado correctamente');
                                                    $scope.paginateDetPay($scope.detPago.salePayment_id);
                                                    $scope.pagoCredito={};
                                                    $scope.detPago={};
                                                } else {
                                                    $scope.errors = data;

                                                }
                                            });
                                        });
                                    }else{
                                        alert("Pago mayor a la deuda");
                                    }

                            }else{alert("Caja Cerrada");}
                            });
                        }); 
                    }

                }
                $scope.paginateDetPay=function(idP){
                      crudServiceOrders.byId(idP,'saledetPayments').then(function (data) {
                        $scope.detPayments = data.data;
                        $scope.maxSize = 5;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                        $scope.itemsperPage = 5;

                    });
                }
                //------------------------------------
                //------------------------------------
                //------------------------------------
                $scope.calcularmontos=function(index){
                    if($scope.compras[index].cantidad>$scope.compras[index].Stock){
                        $scope.compras[index].cantidad=Number($scope.compras[index].Stock);
                        alert("Cantidad excede el STOCK");
                    }
                    if($scope.compras[index].cantidad<1){
                       $scope.compras[index].cantidad=1;
                       alert("La cantidad debe ser mayor 0"); 
                    }
                    $scope.sale.montoTotal=$scope.sale.montoTotalSinDescuento-$scope.compras[index].subTotal;

                    if($scope.bandera){
                        $scope.compras[index].precioVenta=((100-Number($scope.compras[index].descuento))*Number($scope.compras[index].precioProducto))/100;
                    }else{
                        $scope.compras[index].descuento=((Number($scope.compras[index].precioProducto)-Number($scope.compras[index].precioVenta))*100)/Number($scope.compras[index].precioProducto);
                    }
                    $scope.compras[index].subTotal=$scope.compras[index].cantidad*Number($scope.compras[index].precioVenta);

                    $scope.sale.montoTotal=$scope.sale.montoTotal+$scope.compras[index].subTotal;
                    $scope.recalcularCompra();
                    //$scope.sale.montoTotalSinDescuento=$scope.sale.montoTotal;
                    //$scope.sale.montoBruto=Number($scope.sale.montoTotal)/1.18;
                    //$scope.sale.igv=$scope.sale.montoTotal-$scope.sale.montoBruto;
                    $scope.bandera=false;   
                };

                $scope.aumentarCantidad= function(index){
                    if ($scope.compras[index].equivalencia!=undefined) {
                        $scope.compras[index].cantidad=$scope.compras[index].cantidad+1;
                        if($scope.compras[index].cantidad*$scope.compras[index].equivalencia>$scope.compras[index].Stock){
                            alert("STOK INSUFICIENTE");
                            $scope.compras[index].cantidad=$scope.compras[index].cantidad-1;
                        }else{
                            //$scope.compras[index].cantidad=$scope.compras[index].cantidad+1;
                            $scope.calcularmontos(index);    
                        }
                    }else{
                        $scope.compras[index].cantidad=$scope.compras[index].cantidad+1;
                        $scope.calcularmontos(index); 
                        //$log.log($scope.sale);   
                    }
                                
                };
                $scope.disminuirCantidad= function(index){
                    $scope.compras[index].cantidad=$scope.compras[index].cantidad-1;
                    
                    $scope.calcularmontos(index);
                };
                $scope.aumentarPrecio= function(index){
                    $scope.compras[index].precioVenta=Number($scope.compras[index].precioVenta)+1;
                    $scope.calcularmontos(index);
                };
                $scope.disminuirPrecio= function(index){
                    $scope.compras[index].precioVenta=Number($scope.compras[index].precioVenta)-1;
                    $scope.calcularmontos(index);
                };
                $scope.aumentarDescuento= function(index){
                    $scope.compras[index].descuento=Number($scope.compras[index].descuento)+1;
                    $scope.bandera=true;
                    $scope.calcularmontos(index);
                };
                $scope.disminuirDescuento= function(index){
                    $scope.compras[index].descuento=Number($scope.compras[index].descuento)-1;
                    //alert("entre -"+$scope.compras[index].descuento);
                    $scope.bandera=true;
                    $scope.calcularmontos(index);
                };
                $scope.keyUpDescuento= function(index){
                    //$scope.compras[index].descuento=Number($scope.compras[index].descuento)-1;
                    //alert("entre -"+$scope.compras[index].descuento);
                    $scope.bandera=true;
                    $scope.calcularmontos(index);
                };


                //-----------------------------------------------------
                $scope.aumentarTotalPedido= function(){
                    $scope.sale.montoTotal=Number($scope.sale.montoTotal)+1;

                     $scope.sale.descuento=((Number($scope.sale.montoTotalSinDescuento)-Number($scope.sale.montoTotal))*100)/Number($scope.sale.montoTotalSinDescuento);
                    //$scope.recalcularCompra();
                    $scope.sale.montoBruto=Number($scope.sale.montoTotal)/1.18;
                    $scope.sale.igv=$scope.sale.montoTotal-$scope.sale.montoBruto;
                };
               
                $scope.disminuirTotalPedido= function(){
                    $scope.sale.montoTotal=Number($scope.sale.montoTotal)-1;                     
                    $scope.sale.descuento=((Number($scope.sale.montoTotalSinDescuento)-Number($scope.sale.montoTotal))*100)/Number($scope.sale.montoTotalSinDescuento);    
                    //$scope.recalcularCompra();
                    $scope.sale.montoBruto=Number($scope.sale.montoTotal)/1.18;
                    $scope.sale.igv=$scope.sale.montoTotal-$scope.sale.montoBruto;
                };
                 $scope.keyUpTotalPedido= function(){
                    //$scope.sale.montoTotal=Number($scope.sale.montoTotal)+1;

                     $scope.sale.descuento=((Number($scope.sale.montoTotalSinDescuento)-Number($scope.sale.montoTotal))*100)/Number($scope.sale.montoTotalSinDescuento);
                    //$scope.recalcularCompra();
                    $scope.sale.montoBruto=Number($scope.sale.montoTotal)/1.18;
                    $scope.sale.igv=$scope.sale.montoTotal-$scope.sale.montoBruto;
                };
                $scope.keyUpDescuentoPedido= function(){
                    //$scope.sale.descuento=Number($scope.sale.descuento)+1;
                    $scope.sale.montoTotal=((100-Number($scope.sale.descuento))*Number($scope.sale.montoTotalSinDescuento))/100;
                    //$scope.recalcularCompra();
                    $scope.sale.montoBruto=Number($scope.sale.montoTotal)/1.18;
                    $scope.sale.igv=$scope.sale.montoTotal-$scope.sale.montoBruto;
                };
                $scope.aumentarDescuentoPedido= function(){
                    $scope.sale.descuento=Number($scope.sale.descuento)+1;
                    $scope.sale.montoTotal=((100-Number($scope.sale.descuento))*Number($scope.sale.montoTotalSinDescuento))/100;
                    //$scope.recalcularCompra();
                    $scope.sale.montoBruto=Number($scope.sale.montoTotal)/1.18;
                    $scope.sale.igv=$scope.sale.montoTotal-$scope.sale.montoBruto;
                };
                $scope.disminuirDescuentoPedido= function(){
                    $scope.sale.descuento=Number($scope.sale.descuento)-1;
                    $scope.sale.montoTotal=((100-Number($scope.sale.descuento))*Number($scope.sale.montoTotalSinDescuento))/100;    
                    //$scope.recalcularCompra();
                    $scope.sale.montoBruto=Number($scope.sale.montoTotal)/1.18;
                    $scope.sale.igv=$scope.sale.montoTotal-$scope.sale.montoBruto;
                };
                
                $scope.sacarRow=function(index,total){
                    $scope.sale.montoTotal=$scope.sale.montoTotalSinDescuento-$scope.compras[index].subTotal;
                    
                    $scope.recalcularCompra();

                    $scope.compras.splice(index,1);
                    if($scope.compras.length<1){
                        $scope.sale.descuento=0;    
                    }
                }

                $scope.recalcularCompra=function(){
                    $scope.sale.montoTotalSinDescuento=$scope.sale.montoTotal;
                    $scope.sale.montoTotal=((100-Number($scope.sale.descuento))*Number($scope.sale.montoTotalSinDescuento))/100;    

                    $scope.sale.montoBruto=Number($scope.sale.montoTotal)/1.18;
                    $scope.sale.igv=$scope.sale.montoTotal-$scope.sale.montoBruto;  
                };

                

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

                     $scope.tabs = [
                        { title:'Dynamic Title 1', content:'Dynamic content 1' },
                        { title:'Dynamic Title 2', content:'Dynamic content 2', disabled: true }
                    ];
                     $scope.alertMe = function() {
                        setTimeout(function() {
                         $window.alert('You\'ve selected the alert tab!');
                        });
                    };

                $scope.cargarFavoritos= function(row,size){                      
                        crudServiceOrders.reportProWare('productsVariantes',$scope.store.id,$scope.warehouse.id,row.vari).then(function(data){    
                        $scope.presentations = data;
                        //$log.log($scope.presentations);
                        if($scope.base){
                            //$scope.atributoSelected=undefined;
                            crudServiceOrders.reportProWare('productsFavoritos',$scope.store.id,$scope.warehouse.id,'1').then(function(data){    
                                        $scope.favoritos=data;
                                    });
                            $scope.atributoSelected=row;
                            if ($scope.atributoSelected.NombreAtributos!=undefined) {
                                if ($scope.atributoSelected.Stock>0) {         
                                    $scope.atributoSelected.cantidad=1;
                                    $scope.atributoSelected.descuento=0;
                                    $scope.atributoSelected.subTotal=$scope.atributoSelected.cantidad*Number($scope.atributoSelected.precioProducto);
                                    $scope.atributoSelected.precioVenta=Number($scope.atributoSelected.precioProducto);
                    
                                    $scope.compras.push($scope.atributoSelected);  

                                    $scope.sale.montoTotal=$scope.sale.montoTotalSinDescuento+$scope.atributoSelected.subTotal;
                                    $scope.recalcularCompra();

                                    //$scope.sale.montoTotalSinDescuento=$scope.sale.montoTotal;
                                    //$scope.sale.montoBruto=Number($scope.sale.montoTotal)/1.18;
                                    //$scope.sale.igv=$scope.sale.montoTotal-$scope.sale.montoBruto;
                                }else{
                                    alert("STOCK INSUFICIENTE");
                                }
                            }else{
                                alert("Seleccione Producto Correctamente");
                                $scope.atributoSelected=undefined;
                            }
                            $scope.atributoSelected=undefined;

                        }else{                           
                            var modalInstance = $modal.open({      
                                //animation: $scope.animationsEnabled,
                                templateUrl: 'myModalContent.html',
                                controller: 'ModalInstanceCtrl',
                                size: size,
                                resolve: {
                                    presentations: function () {
                                      return $scope.presentations;
                                    }                                    
                                }
                            })
                        }
                    });  
                }
                $scope.estadoFavorito=false;
                $scope.AddFavoritos= function(){
                    $scope.banderadeleteFavorito=true;
                    if($scope.atributoSelected==undefined){
                        alert("Seleccione Producto Correctamente");
                    }else{
                        if($scope.atributoSelected.favorite=='0'){
                            alert("El Producto ya es Favorito");
                        }else{
                            
                            if ($scope.atributoSelected.NombreAtributos!=undefined) { 
                               crudServiceOrders.byId($scope.atributoSelected.vari,'variants').then(function (data) {
                                    $scope.addFavorito=data;
                                    $scope.addFavorito.favorite=0;
                                    //$log.log($scope.addFavorito);
                                    if ($scope.addFavorito!=null) {
                                        crudServiceOrders.editFavoritoId($scope.addFavorito,'variants').then(function (data) {
                                            $scope.estadoFavorito=data['estado'];
                                      
                                   
                                    
                                    $scope.addFavorito={};
                                    $scope.favoritos={};
                                  
                                    crudServiceOrders.reportProWare('productsFavoritos',$scope.store.id,$scope.warehouse.id,'1').then(function(data){    
                                        $scope.favoritos=data;
                                    }); 
                                      });
                                    };
                                     
                                });

                               

                            }else{
                                alert("Seleccione Producto Correctamente");
                                $scope.atributoSelected=undefined;
                            }
                            $scope.atributoSelected=undefined;                        
                        }
                    }                  
                       //$log.log($scope.atributoSelected);                    
                }
                $scope.deleteFavoritos= function(row){  
                    
                        //alert($scope.atributoSelected.vari);
                        crudServiceOrders.byId(row.vari,'variants').then(function (data) {
                            $scope.addFavorito=data;
                                $scope.addFavorito.favorite=1;
                            //$log.log($scope.addFavorito);
                            crudServiceOrders.editFavoritoId($scope.addFavorito,'variants');

                            $scope.addFavorito={};
                            $scope.favoritos={};

                            crudServiceOrders.reportProWare('productsFavoritos',$scope.store.id,$scope.warehouse.id,'1').then(function(data){                                       
                                $scope.favoritos=data;
                            });
                        });                 
                }

                $scope.cargarAtri = function(size){
                    //crudServiceOrders.search('detpresPresentation',$scope.atributoSelected.vari,1).then(function (data){
                        //$log.log($scope.atributoSelected+"aca");
                    crudServiceOrders.reportProWare('productsVariantes',$scope.store.id,$scope.warehouse.id,$scope.atributoSelected.vari).then(function(data){    
                        $scope.presentations = data;
                        //$log.log($scope.presentations);
                        if($scope.base){
                            if ($scope.atributoSelected.NombreAtributos!=undefined) {
                                if ($scope.atributoSelected.Stock>0) {       
                                    $scope.atributoSelected.cantidad=1;
                                    $scope.atributoSelected.descuento=0;
                                    $scope.atributoSelected.subTotal=$scope.atributoSelected.cantidad*Number($scope.atributoSelected.precioProducto);
                                    $scope.atributoSelected.precioVenta=Number($scope.atributoSelected.precioProducto);
                    
                                    $scope.compras.push($scope.atributoSelected);  

                                    $scope.sale.montoTotal=$scope.sale.montoTotalSinDescuento+$scope.atributoSelected.subTotal;
                                    $scope.recalcularCompra();
                                    //$scope.sale.montoTotalSinDescuento=$scope.sale.montoTotal;
                                    //$scope.sale.montoBruto=Number($scope.sale.montoTotal)/1.18;
                                    //$scope.sale.igv=$scope.sale.montoTotal-$scope.sale.montoBruto;
                                }else{
                                    alert("STOK INSUFICIENTE");
                                }   
                            }else{
                                alert("Seleccione Producto Correctamente");
                                $scope.atributoSelected=undefined;
                            }
                            $scope.atributoSelected=undefined;

                        }else{                           
                            var modalInstance = $modal.open({      
                                //animation: $scope.animationsEnabled,
                                templateUrl: 'myModalContent.html',
                                controller: 'ModalInstanceCtrl',
                                size: size,
                                resolve: {
                                    presentations: function () {
                                      return $scope.presentations;
                                    }                                    
                                }
                            })
                        }
                    });
                    
                }





                 $scope.open = function (size) {
                    $log.log($scope.atributoSelected+" open");                    
                    $scope.cargarAtri(size);                   
                };

                $scope.close = function () {
                     $modal.dismiss('cancel');   
                };





                $scope.pageChanged = function() {
                    if ($scope.query.length > 0) {
                        crudServiceOrders.search('sales',$scope.query,$scope.currentPage).then(function (data){
                        $scope.orders = data.data;
                    });
                    }else{
                        crudServiceOrders.paginate('sales',$scope.currentPage).then(function (data) {
                            $scope.orders = data.data;
                        });
                    }
                };
                $scope.cargarAtributos = function() {
                    //alert("Hola : "+$scope.store.id+$scope.warehouse.id);
                    crudServiceOrders.reportProWare('products',$scope.store.id,$scope.warehouse.id).then(function (data) {
                            $scope.atributos = data;
                            //$log.log(data);
                        });
                };
                $('#myTabs2 a').click(function (e) {
                          e.preventDefault()
                          $(this).tab('show')});


                var id = $routeParams.id;

                if(id)
                {
                    crudServiceOrders.byId(id,'sales').then(function (data) {
                        $scope.order1 = data;
                        $log.log($scope.order1)

                        crudServiceOrders.search('DetSales',$scope.order1.id,1).then(function (data){
                            $scope.detOrders = data.data;
                            //$log.log($scope.detOrders);
                        });
                        crudServiceOrders.search('salePayment',$scope.order1.id,1).then(function (data){
                            $scope.payment = data.data;
                            $log.log($scope.payment);
                            crudServiceOrders.search('SaleDetPayment',$scope.payment[0].id,1).then(function (data){
                                $scope.detPayments = data.data;
                                //$log.log(data);
                            });
                        });
                    });
                    crudServiceOrders.select('saleMethodPayments','select').then(function (data) {                        
                        $scope.saleMethodPayments = data;

                    });

                }else{
                    crudServiceOrders.paginate('sales',1).then(function (data) {
                        $scope.orders = data.data;
                        $scope.maxSize = 5;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                        $scope.itemsperPage = 15;

                    });

                    crudServiceOrders.select('stores','select').then(function (data) {                        
                        $scope.stores = data;

                    });
                    crudServiceOrders.search('warehousesStore',$scope.store.id,1).then(function (data){
                        $scope.warehouses=data.data;
                        //$log.log($scope.warehouses);
                    });
                    crudServiceOrders.reportProWare('productsFavoritos',$scope.store.id,$scope.warehouse.id,'1').then(function(data){    
                        $scope.favoritos=data;
                        //$log.log($scope.favoritos);
                    });

                    crudServiceOrders.search('searchHeaders',$scope.store.id,1).then(function (data){
                        $scope.cashHeaders=data;
                        $log.log($scope.cashHeaders);
                    });

                    crudServiceOrders.search('cashes',$scope.cash1.cashHeader_id,1).then(function (data){
                        var canCashes=data.total;
                        var pagActual=Math.ceil(canCashes/15);
                        crudServiceOrders.search('cashes',$scope.cash1.cashHeader_id,pagActual).then(function (data){
                            $scope.cashes = data.data;
                            $scope.cashfinal=$scope.cashes[$scope.cashes.length-1];
                            //$log.log($scope.cashfinal);
                            crudServiceOrders.search('detCashesSale',$scope.cashfinal.id,1).then(function (data){
                            $scope.detCashes = data.data;
                            $scope.maxSize1 = 5;
                                $scope.totalItems1 = data.total;
                                $scope.currentPage1 = data.current_page;
                                $scope.itemsperPage1 = 15;

                                //$log.log($scope.detCashes);
                            });
                        });
                    });
                    //$scope.detCashes={};
                    
                }

                socket.on('sales.update', function (data) {
                    $scope.orders=JSON.parse(data);
                });

                $scope.searchorder = function(){
                if ($scope.query.length > 0) {
                    crudServiceOrders.search('sales',$scope.query,1).then(function (data){
                        $scope.orders = data.data;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                    });
                }else{
                    crudServiceOrders.paginate('sales',1).then(function (data) {
                        $scope.orders = data.data;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                    });
                }
                    
                };

                

                $scope.editorder = function(row){
                    $location.path('/sales/edit/'+row.id);
                };

                $scope.updateorder = function(){
                   if ($scope.orderCreateForm.$valid) {
                        crudServiceOrders.update($scope.sale,'sales').then(function(data)
                        {
                            if(data['estado'] == true){
                                $scope.success = data['nombres'];
                                alert('editado correctamente');
                                $location.path('/sales');
                            }else{
                                $scope.errors =data;
                            }
                        });
                    }
                };

                $scope.deleteorder = function(row){
                    $scope.sale = row;
                }

                $scope.cancelorder = function(){
                    $scope.sale = {};
                }

                $scope.destroyorder = function(){
                    crudServiceOrders.destroy($scope.sale,'sales').then(function(data)
                    {
                        if(data['estado'] == true){
                            $scope.success = data['nombre'];
                            $scope.sale = {};
                            //alert('hola');
                            $route.reload();

                        }else{
                            $scope.errors = data;
                        }
                    });
                }
            }]);
})();