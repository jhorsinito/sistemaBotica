(function(){
    angular.module('purchases.controllers',[])
        .controller('PurchaseController',['$scope', '$routeParams','$location','crudOPurchase','socketService' ,'$filter','$route','$log',
            function($scope, $routeParams,$location,crudOPurchase,socket,$filter,$route,$log){
                $scope.purchases = [];
                $scope.purchase = {};
                $scope.errors = null;
                $scope.success;
                $scope.query = '';
                $scope.stores;
                $scope.purchase.store_id='1';

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

                    });
                }*/

                

              

                $scope.editCompra = function(row){
                    $location.path('/purchases/edit/'+row.id);
                };
                 $scope.verOrden= function(row){
                    $location.path('/orderPurchases/edit/'+row.orderPurchase_id);
                };
               


              
            }]);
})();
