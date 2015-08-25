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
                //$scope.idProvicional;
                 $scope.totAnterior;
                $scope.errors = null;
                $scope.success;
                $scope.query = '';
                $scope.stores;
                $scope.purchase.store_id='1';
                //------------------------------------------------
            
                //-------------------------------------------------

                $scope.toggle = function () {
                    $scope.show = !$scope.show;
                };

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

                        crudOPurchase.byId(id,'payments').then(function (data){
                            $scope.payment = data;
                             $scope.idProvicional=data.id;
                              $scope.totAnterior=data.Acuenta;
                              if(Number($scope.payment.Acuenta)>0){
                              $scope.payment.PorPagado=((Number($scope.payment.Acuenta)*100)/(Number($scope.payment.MontoTotal))).toFixed(2);
                             }else{$scope.payment.PorPagado=0;}
                             $scope.random();
                           //  alert(data.id);
                        crudOPurchase.byId($scope.payment.id,'detPayments').then(function (data) {
                        $scope.detPayments = data.data;
                        $scope.maxSize = 5;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                        $scope.itemsperPage = 5;

                    });
                        });
                        crudOPurchase.byId(id,'purchases').then(function (data) {
                            $scope.purchase=data;
                            $scope.payment.purchase_id=data.id;
                        crudOPurchase.byId(data.supplier_id,'suppliers').then(function (data) {
                            $scope.supplier=data;
                            $scope.payment.supplier_id=data.id;
                            //alert($scope.supplier.empresa);
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
                        $scope.maxSize = 5;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                        $scope.itemsperPage = 15;
                       
                    });

              

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
                $scope.traerPayments=function(row){
                    alert(row.id);

                    crudOPurchase.byId(row.id,'payments').then(function (data) {
                        $scope.payment=data;
                        alert($scope.payment.montoTotal);
                    });
                    $location.path('/purchases/create');
                }

                $scope.recalPayments=function(){
                    //alert($scope.payment.MontoTotal);
                    $scope.payment.Acuenta=Number($scope.totAnterior)+Number($scope.detPayment.montoPagado);
                    $scope.payment.Saldo=(Number($scope.payment.MontoTotal)-Number($scope.payment.Acuenta)).toFixed(2);
                    $scope.payment.PorPagado=((Number($scope.payment.Acuenta)*100)/(Number($scope.payment.MontoTotal))).toFixed(2);
                   $scope.random();
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
                        //if ($scope.paymentCreateForm.$valid){
                        crudOPurchase.create($scope.payment, 'detPayments').then(function (data) {
                          
                            if (data['estado'] == true) {
                                
                                alert('grabado correctamente');
                               // $scope.detPayments={};
                               $scope.totAnterior=data['montoP'];
                               $scope.detPayment.methodPayment_id='';
                               $scope.detPayment.montoPagado='';
                                $scope.paginateDetPay();
                                //$location.path('/types');

                            } else {
                                $scope.errors = data;

                            }
                        });//}
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
                    $scope.payment.detpId=row.id;
                    crudOPurchase.update($scope.payment,'payments').then(function(data)
                    {
                        if(data['estado'] == true){
                            $scope.success = data['nombre'];
                            $scope.Ttype = {};
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
