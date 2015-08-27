(function(){
    angular.module('detCashes.controllers',[])
        .controller('DetCashesController',['$scope', '$routeParams','$location','crudService','socketService' ,'$filter','$route','$log',
            function($scope, $routeParams,$location,crudService,socket,$filter,$route,$log){
                $scope.detCashes = [];
                $scope.detCash={};
                $scope.errors = null;
                $scope.cash={};
                $scope.success;
                $scope.query = '';
                $scope.cashMotives = {};
                $scope.cashMotive={};
                $scope.date = new Date();
                $scope.tipo;

                //$scope.detCash.montoFinal=$scope.cash.montoBruto;
                $scope.salir = function(){
                    $scope.rutaCash='/cashes/edit/'+$scope.cash.id;       
                }
                $scope.createcash = function(){

                    if ($scope.cashCreateForm.$valid) {
                        $scope.detCash.cash_id=$scope.cash.id;
                        $scope.detCash.fecha=$scope.date.getFullYear()+'-'+$scope.date.getMonth()+'-'+$scope.date.getDay();
                        $scope.detCash.hora=$scope.date.getHours()+':'+$scope.date.getMinutes()+':'+$scope.date.getSeconds();
                        $scope.detCash.montoCaja=$scope.cash.montoBruto;
                        
                        crudService.create($scope.detCash, 'detCashes').then(function (data) {
                           
                            if (data['estado'] == true) {
                                $scope.success = data['nombres'];
                                alert('grabado correctamente');
                                //$location.path('/detCashes');

                            } else {
                                $scope.errors = data;

                            }
                        });
                    }

                    if($scope.tipo=='+'){
                        $scope.cash.ingresos=Number($scope.cash.ingresos)+Number($scope.detCash.montoMovimiento);
                    }
                    else{
                        $scope.cash.gastos=Number($scope.cash.gastos)+Number($scope.detCash.montoMovimiento);                    
                    }
                    $scope.cash.montoBruto=$scope.detCash.montoFinal

                    crudService.update($scope.cash,'cashes').then(function(data)
                        {
                            if(data['estado'] == true){
                                //alert('editado correctamente');
                                
                            }
                        }); 
                     $scope.rutaCash='/cashes/edit/'+$scope.cash.id;   
                }

                $scope.toggle = function () {
                    $scope.show = !$scope.show;
                };

                $scope.hola = function () {
                    if($scope.detCashes.length>0){
                        alert("Con Datos");
                        //$scope.ruta='/warehouses'; 
                         
                        alert($scope.date.getFullYear()+'-'+$scope.date.getMonth()+'-'+$scope.date.getDay()+' '+$scope.date.getHours()+':'+$scope.date.getMinutes()+':'+$scope.date.getSeconds());  
                    }else{
                        alert("Sin Datos");
                        //$scope.ruta='/detCashes/create';
                    }
                    
                };
                 $scope.cargarTipo = function () {
                    crudService.search('cashMotives',$scope.tipo,1).then(function (data){
                        $scope.cashMotives = data.data;
                    });
                    $scope.detCash.montoMovimiento=0;
                    
                };

                $scope.pageChanged = function() {
                    if ($scope.query.length > 0) {
                        crudService.search('detCashes',$scope.query,$scope.currentPage).then(function (data){
                        $scope.detCashes = data.data;
                    });
                    }else{
                        crudService.paginate('detCashes',$scope.currentPage).then(function (data) {
                            $scope.detCashes = data.data;
                        });
                    }
                };
                 $scope.calculate = function() {
                    alert($scope.tipo);
                    if($scope.tipo=='+'){
                        $scope.detCash.montoFinal=Number($scope.cash.montoBruto)+Number($scope.detCash.montoMovimiento);
                    }
                    else{
                        $scope.detCash.montoFinal=Number($scope.cash.montoBruto)-Number($scope.detCash.montoMovimiento);                    
                    }
                    
                };
                


                
                var id = $routeParams.id;

                if(id)
                {
                    
                    crudService.byId(id,'cashes').then(function (data) {
                        $scope.cash = data;
                    });

                    //$log.log($scope.cash);
                    //$scope.rutaCash='/cashes/edit/'+$scope.cash.id;
                    //alert($scope.cash.id);
                    
                }else{
                    crudService.paginate('detCashes',1).then(function (data) {
                        $scope.detCashes = data.data;
                        $scope.maxSize = 5;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                        $scope.itemsperPage = 2;
                    });
                    //crudService.select('cashMotives','select').then(function (data) {                        
                      //  $scope.cashMotives = data;
                    //});
                }
                //$log.log($scope.cash);

                socket.on('detCashes.update', function (data) {
                    $scope.detCashes=JSON.parse(data);
                });
                


                $scope.searchcash = function(){
                if ($scope.query.length > 0) {
                    alert($scope.query);
                    crudService.search('detCashes',$scope.query,1).then(function (data){
                        $scope.detCashes = data.data;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                    });
                }else{
                    crudService.paginate('detCashes',1).then(function (data) {
                        $scope.detCashes = data.data;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                    });
                }
                    
                };

                

                $scope.editcash = function(row){
                    $location.path('/detCashes/edit/'+row.id);                     
                };

                $scope.updatecash = function(){
                   if ($scope.cashCreateForm.$valid) {
                        crudService.update($scope.detCash,'detCashes').then(function(data)
                        {
                            if(data['estado'] == true){
                                $scope.success = data['nombres'];
                                alert('editado correctamente');
                                $location.path('/detCashes');
                            }else{
                                $scope.errors =data;
                            }
                        });
                    }
                };

                $scope.deletecash = function(row){
                    $scope.detCash = row;
                    alert(row.nombre);
                }

                $scope.cancelcash = function(){
                    $scope.detCash = {};
                }

                $scope.destroycash = function(){
                    crudService.destroy($scope.detCash,'detCashes').then(function(data)
                    {
                        if(data['estado'] == true){
                            $scope.success = data['nombre'];
                            $scope.detCash = {};
                            //alert('hola');
                            $route.reload();

                        }else{
                            $scope.errors = data;
                        }
                    });
                }
            }]);
})();
