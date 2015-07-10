(function(){
    angular.module('routes',[])
        .config(['$routeProvider','$locationProvider', function ($routeProvider,$locationProvider) {
            $routeProvider                
                .when('/persons', {
                    templateUrl: '/js/app/persons/views/index.html',
                    controller: 'PersonController'
                })
                .when('/persons/create',{
                    templateUrl:'/persons/form-create',
                    controller: 'PersonController'
                })
                .when('/persons/edit/:id',{
                    templateUrl:'/persons/form-edit',
                    controller: 'PersonController'
                })
                .when('/users', {
                    templateUrl: '/js/app/users/views/index.html',
                    controller: 'UserController'
                })
                .when('/users/create',{
                    templateUrl:'/users/form-create',
                    controller: 'UserController'
                })
                .when('/users/edit/:id',{
                    templateUrl:'/users/form-edit',
                    controller: 'UserController'
                })
                .when('/customers', {
                    templateUrl: '/js/app/customers/views/index.html',
                    controller: 'CustomerController'
                })
                .when('/customers/create',{
                    templateUrl:'/customers/form-create',
                    controller: 'CustomerController'
                })
                .when('/customers/edit/:id',{
                    templateUrl:'/customers/form-edit',
                    controller: 'CustomerController'
                })
                .when('/employees', {
                    templateUrl: '/js/app/employees/views/index.html',
                    controller: 'EmployeeController'
                })
                .when('/employees/create',{
                    templateUrl:'/employees/form-create',
                    controller: 'EmployeeController'
                })
                .when('/employees/edit/:id',{
                    templateUrl:'/employees/form-edit',
                    controller: 'EmployeeController'
                })
                .otherwise({
                    redirectTo: '/'
                });
            $locationProvider.html5Mode(true);
        }]);

})();
