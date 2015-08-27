(function(){
    angular.module('orders.controllers',[])
        .controller('OrderController',['$scope', '$routeParams','$location','crudServiceOrders','socketService' ,'$filter','$route','$log','$window','$modal',
            function($scope, $routeParams,$location,crudServiceOrders,socket,$filter,$route,$log, $window,$modal){
                
                $scope.errors = null;
                $scope.success;
                $scope.query = '';
                /*

                $scope.orders = [];
                $scope.order1={};
                
                $scope.detOrders=[];
                    $scope.order={};
                    $scope.stores={};
                    $scope.store={};
                    $scope.warehouses={};
                    $scope.warehouse={};
                    $scope.warehouse.id='1';
                    $scope.store.id='1';
                    $scope.atributos={};
                    $scope.compras=[];
                    $scope.compra={};
                    $scope.order.montoBruto=0;
                    $scope.order.descuento=0;
                    $scope.order.montoTotal=0;
                    $scope.order.montoTotalSinDescuento=0;
                    $scope.order.igv=0;
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
                    $scope.order={};
                    $scope.stores={};
                    $scope.store={};
                    $scope.warehouses={};
                    $scope.warehouse={};
                    $scope.warehouse.id='1';
                    $scope.store.id='1';
                    $scope.atributos={};
                    $scope.compras=[];
                    $scope.compra={};
                    $scope.order.montoBruto=0;
                    $scope.order.descuento=0;
                    $scope.order.montoTotal=0;
                    $scope.order.montoTotalSinDescuento=0;
                    $scope.order.igv=0;
                    $scope.bandera=false;
                    $scope.banderaPagosCash=true;
                    $scope.banderaPagosTarjeta=true;
                    $scope.acuenta=false;
                    $scope.customer={};
                    $scope.date = new Date();
                    $scope.base=true;
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
                }
                $scope.inicializar();
                $scope.oPres;
                crudServiceOrders.qewsdxxd = function (){
                    //alert("fdfdfdfdf");
                    $scope.atributoSelected=crudServiceOrders.getPres();
                    if ($scope.atributoSelected.NombreAtributos!=undefined) {        
                                $scope.atributoSelected.cantidad=1;
                                $scope.atributoSelected.descuento=0;
                                $scope.atributoSelected.subTotal=$scope.atributoSelected.cantidad*Number($scope.atributoSelected.precioProducto);
                                $scope.atributoSelected.precioVenta=Number($scope.atributoSelected.precioProducto);
                    
                                $scope.compras.push($scope.atributoSelected);  

                                $scope.order.montoTotal=$scope.order.montoTotalSinDescuento+$scope.atributoSelected.subTotal;
                                $scope.recalcularCompra();
                                //$scope.order.montoTotalSinDescuento=$scope.order.montoTotal;
                                //$scope.order.montoBruto=Number($scope.order.montoTotal)/1.18;
                                //$scope.order.igv=$scope.order.montoTotal-$scope.order.montoBruto;
                            }else{
                                alert("Seleccione Producto Correctamente");
                                $scope.atributoSelected=undefined;
                            }
                    $scope.atributoSelected=undefined;
                    $log.log(crudServiceOrders.getPres());
                }



                $scope.pagar = function () {
                    if ($scope.order.montoTotal==0) {
                        alert("Seleccione productos");
                    }else{
                        
                    }
                }

                $scope.realizarPago = function () {
                    $scope.salePayment.MontoTotal=$scope.order.montoTotal;
                    $scope.salePayment.Acuenta=0;
                    $scope.salePayment.customer_id=$scope.order.customer_id;

                    if($scope.pago.tarjeta>0 || $scope.pago.cash>0){
                        if($scope.acuenta){
                            alert("credito");
                            $scope.salePayment.estado=1;
                            $scope.order.estado=1;
                            if ($scope.radioModel!=undefined && $scope.pago.tarjeta==0) {
                                alert("Elija monto Pago Tarjeta");
                            }else if($scope.radioModel!=undefined && $scope.pago.tarjeta>0){
                                //crear detalle pago tarjeta
                                $scope.salePayment.Acuenta=$scope.salePayment.Acuenta+$scope.pago.tarjeta;
                                //1 credito 0 terminado
                                //Detalle tarjeta
                                $scope.saledetPayment.fecha=$scope.date.getFullYear()+'-'+($scope.date.getMonth()+1)+'-'+$scope.date.getDate()+' '+$scope.date.getHours()+':'+$scope.date.getMinutes()+':'+$scope.date.getSeconds();
                                $scope.saledetPayment.monto=$scope.pago.tarjeta;
                                $scope.saledetPayment.saleMethodPayment_id=$scope.radioModel;

                                $scope.salePayment.Saldo=$scope.salePayment.MontoTotal-$scope.salePayment.Acuenta;

                                $scope.saledetPayments.push($scope.saledetPayment); 
                                //$scope.compras.push($scope.atributoSelected);                                 
                                $scope.saledetPayment={};
                            }
                            else if($scope.radioModel==undefined && $scope.pago.tarjeta>0){
                                alert("Elija Tarjeta.");
                                //$scope.banderaPagosCash=true;
                                //$scope.banderaPagosTarjeta=true;
                                $scope.banderaPagosTarjeta=false;
                                //alert($scope.banderaPagos);
                                //alert("sdasdszxcz");
                            }
                            if($scope.pago.cash>0&&$scope.banderaPagosTarjeta){
                                //crear detalle pago contado
                                //alert("xD QSAS");
                                $scope.salePayment.Acuenta=$scope.salePayment.Acuenta+$scope.pago.cash;
                                //1 credito 0 terminado
                                //Detalle tarjeta
                                $scope.saledetPayment.fecha=$scope.date.getFullYear()+'-'+($scope.date.getMonth()+1)+'-'+$scope.date.getDate()+' '+$scope.date.getHours()+':'+$scope.date.getMinutes()+':'+$scope.date.getSeconds();
                                $scope.saledetPayment.monto=$scope.pago.cash;
                                $scope.saledetPayment.saleMethodPayment_id='1';

                                $scope.salePayment.Saldo=$scope.salePayment.MontoTotal-$scope.salePayment.Acuenta;

                                $scope.saledetPayments.push($scope.saledetPayment);                                
                                $scope.saledetPayment={};   
                            }

                            if ($scope.banderaPagosCash&&$scope.banderaPagosTarjeta) {
                                $scope.order.saledetPayments=$scope.saledetPayments;
                                $scope.order.salePayment=$scope.salePayment;
                                //crear compra
                                $scope.createorder();

                                $log.log($scope.order);
                                //saldo credito   
                            };
                            $scope.banderaPagosTarjeta=true;
                            
                            
                        }else{
                            if ($scope.pago.tarjeta+$scope.pago.cash<$scope.order.montoTotal) {
                                alert("Pago menor a la compra"+$scope.radioModel);
                            }else{
                                alert("Contado");
                            $scope.salePayment.estado=0;
                            $scope.order.estado=0;
                            if ($scope.radioModel!=undefined && $scope.pago.tarjeta==0) {
                                alert("Elija monto Pago Tarjeta");
                            }else if($scope.radioModel!=undefined && $scope.pago.tarjeta>0){
                                //crear detalle pago tarjeta
                                $scope.salePayment.Acuenta=$scope.salePayment.Acuenta+$scope.pago.tarjeta;
                                //1 credito 0 terminado
                                //Detalle tarjeta
                                $scope.saledetPayment.fecha=$scope.date.getFullYear()+'-'+($scope.date.getMonth()+1)+'-'+$scope.date.getDate()+' '+$scope.date.getHours()+':'+$scope.date.getMinutes()+':'+$scope.date.getSeconds();
                                $scope.saledetPayment.monto=$scope.pago.tarjeta;
                                $scope.saledetPayment.saleMethodPayment_id=$scope.radioModel;

                                $scope.salePayment.Saldo=$scope.salePayment.MontoTotal-$scope.salePayment.Acuenta;

                                $scope.saledetPayments.push($scope.saledetPayment); 
                                //$scope.compras.push($scope.atributoSelected);                                 
                                $scope.saledetPayment={};
                            }
                            else if($scope.radioModel==undefined && $scope.pago.tarjeta>0){
                                alert("Elija Tarjeta");
                                //$scope.banderaPagos=false;
                                //alert($scope.banderaPagos);
                                //alert("sdasdszxcz");
                                $scope.banderaPagosTarjeta=false;
                            }
                            if($scope.pago.cash>0 && $scope.banderaPagosTarjeta){
                                alert($scope.banderaPagos);
                                //crear detalle pago contado
                                //alert("xD QSAS");
                                $scope.salePayment.Acuenta=$scope.salePayment.Acuenta+$scope.pago.cash;
                                //1 credito 0 terminado
                                //Detalle tarjeta
                                $scope.saledetPayment.fecha=$scope.date.getFullYear()+'-'+($scope.date.getMonth()+1)+'-'+$scope.date.getDate()+' '+$scope.date.getHours()+':'+$scope.date.getMinutes()+':'+$scope.date.getSeconds();
                                $scope.saledetPayment.monto=$scope.pago.cash;
                                $scope.saledetPayment.saleMethodPayment_id='1';

                                $scope.salePayment.Saldo=$scope.salePayment.MontoTotal-$scope.salePayment.Acuenta;

                                $scope.saledetPayments.push($scope.saledetPayment);                                
                                $scope.saledetPayment={};   
                            }
                            if ($scope.banderaPagosCash&&$scope.banderaPagosTarjeta) {
                                $scope.order.saledetPayments=$scope.saledetPayments;
                                $scope.order.salePayment=$scope.salePayment;
                                //crear compra
                                $scope.createorder();
                                $log.log($scope.order);
                                };
                                $scope.banderaPagosTarjeta=true;
                            }
                        }
                    }
                    else{
                            alert("No puede realizar pago");
                    }    
                }

               

                
                $scope.baseestado = function () {
                    //$log.log($scope.order);
                    $log.log($scope.compras);                
                };
                $scope.toggle = function () {
                    $scope.show = !$scope.show;
                };

                $scope.createorder = function(){
                    //$scope.order.estado = 1;
                    alert("Entre");
                    $scope.order.fechaPedido=$scope.date.getFullYear()+'-'+($scope.date.getMonth()+1)+'-'+$scope.date.getDate()+' '+$scope.date.getHours()+':'+$scope.date.getMinutes()+':'+$scope.date.getSeconds();
                    $scope.order.detOrders=$scope.compras;
                    $log.log($scope.order);

                    //if ($scope.orderCreateForm.$valid) {
                        crudServiceOrders.create($scope.order, 'orders').then(function (data) {
                           
                            if (data['estado'] == true) {
                                $scope.success = data['nombres'];
                                alert('grabado correctamente');
                                //$location.path('/orders');

                            } else {
                                $scope.errors = data;

                            }
                        });
                    //}
                    $scope.inicializar();
                }
                
                $scope.createCustomer = function(){

                    if ($scope.customerCreateForm.$valid) {
                        crudServiceOrders.create($scope.customer, 'customers').then(function (data) {
                           
                            if (data['estado'] == true) {
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
                $scope.atributoSelected=undefined;
                $scope.getAtributos = function(val) {
                  return crudServiceOrders.reportProWare('products',$scope.store.id,$scope.warehouse.id,val).then(function(response){
                    //$log.log(response);
                    //if (response.NombreAtributos==undefined) {
                      // banderaAtibutos=false;
                    //}
                    //else{
                      //  banderaAtibutos=true;
                    //}

                    return response.map(function(item){
                      //alert(item.length==0);
                      //if(item.length==0){
                        //alert("hola");
                      //}
                      return item;
                    });
                  });
                };
                $scope.customersSelected=undefined;
                $scope.getcustomers = function(val) {
                    $log.log(val);
                  return crudServiceOrders.search('customersVenta',val,1).then(function(response){
                    return response.data.map(function(item){
                      //alert(item.nombre);
                      $scope.order.customer_id=item.id;
                      return item;
                    });
                  });         
                };
                $scope.employeeSelected=undefined;
                $scope.getemployee = function(val) {
                    $log.log(val);
                  return crudServiceOrders.search('employeesVenta',val,1).then(function(response){
                    return response.data.map(function(item){
                      //alert(item.nombre);
                      $scope.order.employee_id=item.id;
                      return item;
                    });
                  });
                };
                //------------------------------------
                //------------------------------------
                //------------------------------------
                $scope.pagoCredito={};
                $scope.detPago={};
                $scope.createdetPayment = function(){
                    $scope.pagoCredito=$scope.payment[0];
                    alert($scope.pagoCredito.Saldo);
                    
                    if(Number($scope.pagoCredito.Saldo)>$scope.detPago.monto){
                    $scope.pagoCredito.Acuenta=Number($scope.pagoCredito.Acuenta)+$scope.detPago.monto;
                    $scope.pagoCredito.Saldo=Number($scope.pagoCredito.Saldo)-$scope.detPago.monto;

                    $scope.detPago.salePayment_id=$scope.payment[0].id;

                    $scope.pagoCredito.detPayments=$scope.detPago;
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
                    }else{
                        alert("Holas");
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
                    $scope.order.montoTotal=$scope.order.montoTotalSinDescuento-$scope.compras[index].subTotal;

                    if($scope.bandera){
                        $scope.compras[index].precioVenta=((100-Number($scope.compras[index].descuento))*Number($scope.compras[index].precioProducto))/100;
                    }else{
                        $scope.compras[index].descuento=((Number($scope.compras[index].precioProducto)-Number($scope.compras[index].precioVenta))*100)/Number($scope.compras[index].precioProducto);
                    }
                    $scope.compras[index].subTotal=$scope.compras[index].cantidad*Number($scope.compras[index].precioVenta);

                    $scope.order.montoTotal=$scope.order.montoTotal+$scope.compras[index].subTotal;
                    $scope.recalcularCompra();
                    //$scope.order.montoTotalSinDescuento=$scope.order.montoTotal;
                    //$scope.order.montoBruto=Number($scope.order.montoTotal)/1.18;
                    //$scope.order.igv=$scope.order.montoTotal-$scope.order.montoBruto;
                    $scope.bandera=false;   
                };

                $scope.aumentarCantidad= function(index){
                    $scope.compras[index].cantidad=$scope.compras[index].cantidad+1;
                     $scope.calcularmontos(index); 
                     $log.log($scope.order);               
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
                    alert("entre -"+$scope.compras[index].descuento);
                    $scope.bandera=true;
                    $scope.calcularmontos(index);
                };


                //-----------------------------------------------------
                $scope.aumentarTotalPedido= function(){
                    $scope.order.montoTotal=Number($scope.order.montoTotal)+1;

                     $scope.order.descuento=((Number($scope.order.montoTotalSinDescuento)-Number($scope.order.montoTotal))*100)/Number($scope.order.montoTotalSinDescuento);
                    //$scope.recalcularCompra();
                    $scope.order.montoBruto=Number($scope.order.montoTotal)/1.18;
                    $scope.order.igv=$scope.order.montoTotal-$scope.order.montoBruto;
                };
                $scope.disminuirTotalPedido= function(){
                    $scope.order.montoTotal=Number($scope.order.montoTotal)-1;                     
                    $scope.order.descuento=((Number($scope.order.montoTotalSinDescuento)-Number($scope.order.montoTotal))*100)/Number($scope.order.montoTotalSinDescuento);    
                    //$scope.recalcularCompra();
                    $scope.order.montoBruto=Number($scope.order.montoTotal)/1.18;
                    $scope.order.igv=$scope.order.montoTotal-$scope.order.montoBruto;
                };
                $scope.aumentarDescuentoPedido= function(){
                    $scope.order.descuento=Number($scope.order.descuento)+1;
                    $scope.order.montoTotal=((100-Number($scope.order.descuento))*Number($scope.order.montoTotalSinDescuento))/100;
                    //$scope.recalcularCompra();
                    $scope.order.montoBruto=Number($scope.order.montoTotal)/1.18;
                    $scope.order.igv=$scope.order.montoTotal-$scope.order.montoBruto;
                };
                $scope.disminuirDescuentoPedido= function(){
                    $scope.order.descuento=Number($scope.order.descuento)-1;
                    $scope.order.montoTotal=((100-Number($scope.order.descuento))*Number($scope.order.montoTotalSinDescuento))/100;    
                    //$scope.recalcularCompra();
                    $scope.order.montoBruto=Number($scope.order.montoTotal)/1.18;
                    $scope.order.igv=$scope.order.montoTotal-$scope.order.montoBruto;
                };
                
                $scope.sacarRow=function(index,total){
                    $scope.order.montoTotal=$scope.order.montoTotalSinDescuento-$scope.compras[index].subTotal;
                    
                    $scope.recalcularCompra();

                    $scope.compras.splice(index,1);
                }

                $scope.recalcularCompra=function(){
                    $scope.order.montoTotalSinDescuento=$scope.order.montoTotal;
                    $scope.order.montoTotal=((100-Number($scope.order.descuento))*Number($scope.order.montoTotalSinDescuento))/100;    

                    $scope.order.montoBruto=Number($scope.order.montoTotal)/1.18;
                    $scope.order.igv=$scope.order.montoTotal-$scope.order.montoBruto;  
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

                     $scope.tabs = [
                        { title:'Dynamic Title 1', content:'Dynamic content 1' },
                        { title:'Dynamic Title 2', content:'Dynamic content 2', disabled: true }
                    ];
                     $scope.alertMe = function() {
                        setTimeout(function() {
                         $window.alert('You\'ve selected the alert tab!');
                        });
                    };



                $scope.cargarAtri = function(size){
                    //crudServiceOrders.search('detpresPresentation',$scope.atributoSelected.vari,1).then(function (data){
                    crudServiceOrders.reportProWare('productsVariantes',$scope.store.id,$scope.warehouse.id,$scope.atributoSelected.vari).then(function(data){    
                        $scope.presentations = data;
                        $log.log($scope.presentations);
                        if($scope.base){
                            if ($scope.atributoSelected.NombreAtributos!=undefined) {        
                                $scope.atributoSelected.cantidad=1;
                                $scope.atributoSelected.descuento=0;
                                $scope.atributoSelected.subTotal=$scope.atributoSelected.cantidad*Number($scope.atributoSelected.precioProducto);
                                $scope.atributoSelected.precioVenta=Number($scope.atributoSelected.precioProducto);
                    
                                $scope.compras.push($scope.atributoSelected);  

                                $scope.order.montoTotal=$scope.order.montoTotalSinDescuento+$scope.atributoSelected.subTotal;
                                $scope.recalcularCompra();
                                //$scope.order.montoTotalSinDescuento=$scope.order.montoTotal;
                                //$scope.order.montoBruto=Number($scope.order.montoTotal)/1.18;
                                //$scope.order.igv=$scope.order.montoTotal-$scope.order.montoBruto;
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
                    $scope.cargarAtri(size);                   
                };

                $scope.close = function () {
                     $modal.dismiss('cancel');   
                };





                $scope.pageChanged = function() {
                    if ($scope.query.length > 0) {
                        crudServiceOrders.search('orders',$scope.query,$scope.currentPage).then(function (data){
                        $scope.orders = data.data;
                    });
                    }else{
                        crudServiceOrders.paginate('orders',$scope.currentPage).then(function (data) {
                            $scope.orders = data.data;
                        });
                    }
                };
                $scope.cargarAtributos = function() {
                    alert("Hola : "+$scope.store.id+$scope.warehouse.id);
                    crudServiceOrders.reportProWare('products',$scope.store.id,$scope.warehouse.id).then(function (data) {
                            $scope.atributos = data;
                            //$log.log(data);
                        });
                };
                $('#myTabs2 a').click(function (e) {
                          e.preventDefault()
                          $(this).tab('show')});


                var id = $routeParams.id;
                $scope.eeeeeeeeeeee = function() {
                    $log.log($scope.detOrders);
                    alert($scope.order1.id);
                }
                if(id)
                {
                    crudServiceOrders.byId(id,'orders').then(function (data) {
                        $scope.order1 = data;

                        crudServiceOrders.search('DetOrders',$scope.order1.id,1).then(function (data){
                            $scope.detOrders = data.data;
                            //$log.log($scope.detOrders);
                        });
                        crudServiceOrders.search('salePayment',$scope.order1.id,1).then(function (data){
                            $scope.payment = data.data;
                            //$log.log($scope.payment);
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
                    crudServiceOrders.paginate('orders',1).then(function (data) {
                        $scope.orders = data.data;
                        $scope.maxSize = 5;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                        $scope.itemsperPage = 15;

                    });

                    crudServiceOrders.select('stores','select').then(function (data) {                        
                        $scope.stores = data;

                    });
                    crudServiceOrders.select('warehouses','select').then(function (data) {                        
                        $scope.warehouses = data;

                    });
                }

                socket.on('orders.update', function (data) {
                    $scope.orders=JSON.parse(data);
                });

                $scope.searchorder = function(){
                if ($scope.query.length > 0) {
                    crudServiceOrders.search('orders',$scope.query,1).then(function (data){
                        $scope.orders = data.data;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                    });
                }else{
                    crudServiceOrders.paginate('orders',1).then(function (data) {
                        $scope.orders = data.data;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                    });
                }
                    
                };

                

                $scope.editorder = function(row){
                    $location.path('/orders/edit/'+row.id);
                };

                $scope.updateorder = function(){
                   if ($scope.orderCreateForm.$valid) {
                        crudServiceOrders.update($scope.order,'orders').then(function(data)
                        {
                            if(data['estado'] == true){
                                $scope.success = data['nombres'];
                                alert('editado correctamente');
                                $location.path('/orders');
                            }else{
                                $scope.errors =data;
                            }
                        });
                    }
                };

                $scope.deleteorder = function(row){
                    $scope.order = row;
                }

                $scope.cancelorder = function(){
                    $scope.order = {};
                }

                $scope.destroyorder = function(){
                    crudServiceOrders.destroy($scope.order,'orders').then(function(data)
                    {
                        if(data['estado'] == true){
                            $scope.success = data['nombre'];
                            $scope.order = {};
                            //alert('hola');
                            $route.reload();

                        }else{
                            $scope.errors = data;
                        }
                    });
                }
            }]);
})();