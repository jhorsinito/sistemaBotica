(function(){
    angular.module('cashes.controllers',[])
        .controller('CashesController',['$scope', '$routeParams','$location','crudService','socketService' ,'$filter','$route','$log',
            function($scope, $routeParams,$location,crudService,socket,$filter,$route,$log){
                $scope.cashes = [];
                $scope.cash;
                $scope.errors = null;
                $scope.success;
                $scope.query = '';
                $scope.cashHeaders = {};
                $scope.cashHeader={};
                $scope.detCashes={};
                $scope.buscar;
                $scope.date = new Date();
                $scope.toggle = function () {
                    $scope.show = !$scope.show;
                };
                $scope.rutaMovimiento = function () {
                    $scope.rutaDetCash='/detCashes/create/'+$scope.cash.id; 
                };
                $scope.calculardescuadre = function () {
                    $scope.cash.descuadre=Number($scope.cash.montoReal)-Number($scope.cash.montoBruto);
                };
                    
                $scope.verCaja = function () {
                    alert($scope.cashes.length);
                    $log.log($scope.cashes[$scope.cashes.length-1]);
                    $scope.cash=$scope.cashes[$scope.cashes.length-1];
                    if ($scope.cash.estado=='0') {
                        alert("Caja Cerrada");
                        $scope.ruta='/cashes/create';
                    }else{
                        alert("Caja Open");
                        $scope.ruta='/cashes/edit/'+$scope.cash.id;
                    }
                };
                $scope.cerrarCaja = function () {
                    if($scope.cash.montoReal=='0.00'){
                        alert("Ingrese Monto Real");
                    }else{
                        alert($scope.date.getDate());
                        $scope.cash.fechaFin=$scope.date.getFullYear()+'-'+($scope.date.getMonth()+1)+'-'+$scope.date.getDate()+' '+$scope.date.getHours()+':'+$scope.date.getMinutes()+':'+$scope.date.getSeconds();
                            $scope.cash.estado='0';
                            alert($scope.cash.fechaFin);
                            $log.log($scope.cash);
                        if ($scope.cashCreateForm.$valid) {  
                            
                        crudService.update($scope.cash,'cashes').then(function(data)
                        {
                            if(data['estado'] == true){
                                
                                //$scope.success = data['nombres'];
                                alert('Caja Cerrada');
                                $location.path('/cashes');
                            }else{
                                $scope.errors =data;
                            }
                        });
                        }
                    }
                };
                

                $scope.pageChanged = function() {
                    if ($scope.query.length > 0) {
                        crudService.search('cashes',$scope.query,$scope.currentPage).then(function (data){
                        $scope.cashes = data.data;
                    });
                    }else{
                        crudService.paginate('cashes',$scope.currentPage).then(function (data) {
                            $scope.cashes = data.data;
                        });
                    }
                };
                //---------------------------------------------
                $scope.pageChanged1 = function() {
                    if ($scope.cash.id != 0) {
                        //alert("entre : "+$scope.cash.id)
                        crudService.search('detCashes',$scope.buscar,$scope.currentPage1).then(function (data){
                        $scope.detCashes = data.data;
                    });
                    }else{
                        crudService.paginate('detCashes',$scope.currentPage).then(function (data) {
                            $scope.detCashes = data.data;
                        });
                    }
                    //$log.log($scope.totalItems1);
                };
                //--------------------------------------------------


                
                var id = $routeParams.id;

                if(id)
                {
                    crudService.byId(id,'cashes').then(function (data) {
                        $scope.cash = data;
                        $scope.buscar=$scope.cash.id;
                        //$log.log($scope.cash);

                        crudService.search('detCashes',$scope.cash.id,1).then(function (data){
                           $scope.detCashes = data.data;

                            //$log.log($scope.detCashes);
                        });
                        
                    });
                    crudService.select('cashHeaders','select').then(function (data) {                        
                        $scope.cashHeaders = data;
                    });
                    //-------------------------------------------------------
                        crudService.paginate('detCashes',1).then(function (data) {
                            $scope.detCashes = data.data;
                            $scope.maxSize1 = 5;
                            $scope.totalItems1 = data.total;
                            $scope.currentPage1 = data.current_page;
                            $scope.itemsperPage1 = 2;
                            $log.log(data);
                        });

                    //-------------------------------------------------------

                    
                }else{
                    crudService.paginate('cashes',1).then(function (data) {
                        $scope.cashes = data.data;
                        $scope.maxSize = 5;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                        $scope.itemsperPage = 2;
                        //$scope.numPages1 =data.last_page;
                    });
                    crudService.select('cashHeaders','select').then(function (data) {                        
                        $scope.cashHeaders = data;
                    });
                }

                socket.on('cashes.update', function (data) {
                    $scope.cashes=JSON.parse(data);
                });
                


                $scope.searchcash = function(){
                if ($scope.query.length > 0) {
                    alert($scope.query);
                    crudService.search('cashes',$scope.query,1).then(function (data){
                        $scope.cashes = data.data;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                    });
                }else{
                    crudService.paginate('cashes',1).then(function (data) {
                        $scope.cashes = data.data;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                    });
                }
                    
                };

                $scope.createcash = function(){
                    //$scope.cash.estado = 1;
                    if ($scope.cashCreateForm.$valid) {
                       $scope.cash.fechaInicio=$scope.date.getFullYear()+'-'+($scope.date.getMonth()+1)+'-'+$scope.date.getDate()+' '+$scope.date.getHours()+':'+$scope.date.getMinutes()+':'+$scope.date.getSeconds();
                        $scope.cash.estado='1';
                        $scope.cash.montoBruto=$scope.cash.montoInicial;
                        crudService.create($scope.cash, 'cashes').then(function (data) {
                           
                            if (data['estado'] == true) {
                                $scope.success = data['nombres'];
                                alert('grabado correctamente');
                                $location.path('/cashes');

                            } else {
                                $scope.errors = data;

                            }
                        });
                    }
                }

                $scope.editcash = function(row){
                    if (row.estado=='0') {
                        alert("La caja esta Cerrada");
                    }
                    else{
                        $location.path('/cashes/edit/'+row.id);      
                    }
                     //$scope.cash.montoInicial=parseInt($scope.cash.montoInicial);
                };

                $scope.updatecash = function(){
                   if ($scope.cashCreateForm.$valid) {
                        crudService.update($scope.cash,'cashes').then(function(data)
                        {
                            if(data['estado'] == true){
                                $scope.success = data['nombres'];
                                alert('editado correctamente');
                                $location.path('/cashes');
                            }else{
                                $scope.errors =data;
                            }
                        });
                    }
                };

                $scope.deletecash = function(row){
                    $scope.cash = row;
                    alert(row.nombre);
                }

                $scope.cancelcash = function(){
                    $scope.cash = {};
                }

                $scope.destroycash = function(){
                    crudService.destroy($scope.cash,'cashes').then(function(data)
                    {
                        if(data['estado'] == true){
                            $scope.success = data['nombre'];
                            $scope.cash = {};
                            //alert('hola');
                            $route.reload();

                        }else{
                            $scope.errors = data;
                        }
                    });
                }
            }]);
})();
