(function(){
    angular.module('employees.controllers',[])
        .controller('EmployeeController',['$scope', '$routeParams','$location','crudService','socketService' ,'$filter','$route','$log',
            function($scope, $routeParams,$location,crudService,socket,$filter,$route,$log){
                $scope.employees = [];
                $scope.employee = {};
                $scope.errors = null;
                $scope.success;
                $scope.query = '';

                $scope.toggle = function () {
                    $scope.show = !$scope.show;
                };

                $scope.pageChanged = function() {
                    if ($scope.query.length > 0) {
                        crudService.search('employees',$scope.query,$scope.currentPage).then(function (data){
                        $scope.employees = data.data;
                    });
                    }else{
                        crudService.paginate('employees',$scope.currentPage).then(function (data) {
                            $scope.employees = data.data;
                        });
                    }
                };


                var id = $routeParams.id;

                if(id)
                {
                    crudService.byId(id,'employees').then(function (data) {
                        $scope.employee = data;
                    });
                }else{
                    crudService.paginate('employees',1).then(function (data) {
                        $scope.employees = data.data;
                        $scope.maxSize = 5;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                        $scope.itemsperPage = 15;

                    });
                }

                socket.on('employee.update', function (data) {
                    $scope.employees=JSON.parse(data);
                });

                $scope.searchEmployee = function(){
                if ($scope.query.length > 0) {
                    crudService.search('employees',$scope.query,1).then(function (data){
                        $scope.employees = data.data;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                    });
                }else{
                    crudService.paginate('employees',1).then(function (data) {
                        $scope.employees = data.data;
                        $scope.totalItems = data.total;
                        $scope.currentPage = data.current_page;
                    });
                }
                    
                };

                $scope.createEmployee = function(){
                    //$scope.atribut.estado = 1;
                    if ($scope.employeeCreateForm.$valid) {
                        crudService.create($scope.employee, 'employees').then(function (data) {
                          
                            if (data['estado'] == true) {
                                $scope.success = data['nombres'];
                                alert('grabado correctamente');
                                $location.path('/employees');

                            } else {
                                $scope.errors = data;

                            }
                        });
                    }
                }


                $scope.editEmployee = function(row){
                    $location.path('/employees/edit/'+row.id);
                };

                $scope.updateEmployee = function(){

                    if ($scope.employeeCreateForm.$valid) {
                        crudService.update($scope.employee,'employees').then(function(data)
                        {
                            if(data['estado'] == true){
                                $scope.success = data['nombres'];
                                alert('editado correctamente');
                                $location.path('/employees');
                            }else{
                                $scope.errors =data;
                            }
                        });
                    }
                };

                $scope.deleteEmployee = function(row){
                    $scope.employee = row;
                }

                $scope.cancelEmployee = function(){
                    $scope.employee = {};
                }

                $scope.destroyEmployee = function(){
                    crudService.destroy($scope.employee,'employees').then(function(data)
                    {
                        if(data['estado'] == true){
                            $scope.success = data['nombre'];
                            $scope.employee = {};
                            //alert('hola');
                            $route.reload();

                        }else{
                            $scope.errors = data;
                        }
                    });
                }
            }]);
})();
