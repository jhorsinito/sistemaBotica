(function(){
    angular.module('routes',[])
        .config(['$routeProvider','$locationProvider', function ($routeProvider,$locationProvider) {
            $routeProvider
            // ------------------------------------------------------
            .when('/atributes', {
                    templateUrl: '/js/app/atributes/views/index.html',
                    controller: 'AtributController'
                })
                .when('/atributes/create',{
                    templateUrl:'/atributes/form-create',
                    controller: 'AtributController'
                })
                .when('/atributes/edit/:id',{
                    templateUrl:'/atributes/form-edit',
                    controller: 'AtributController'
                })  
                //----------------------------------------------------
                  .when('/materials', {
                    templateUrl: '/js/app/materials/views/index.html',
                    controller: 'MaterialController'
                })
                .when('/materials/create',{
                    templateUrl:'/materials/form-create',
                    controller: 'MaterialController'
                })
                .when('/materials/edit/:id',{
                    templateUrl:'/materials/form-edit',
                    controller: 'MaterialController'
                }) 
                //---------------------------------------------------
                .when('/stations', {
                    templateUrl: '/js/app/stations/views/index.html',
                    controller: 'StationController'
                })
                .when('/stations/create',{
                    templateUrl:'/stations/form-create',
                    controller: 'StationController'
                })
                .when('/stations/edit/:id',{
                    templateUrl:'/stations/form-edit',
                    controller: 'StationController'
                }) 
           // ------------------------------------------------------
            .when('/types', {
                    templateUrl: '/js/app/types/views/index.html',
                    controller: 'TypeController'
                })
                .when('/types/create',{
                    templateUrl:'/types/form-create',
                    controller: 'TypeController'
                })
                .when('/types/edit/:id',{
                    templateUrl:'/types/form-edit',
                    controller: 'TypeController'
                })    

                //-------------------------------------------------------------        
             .when('/brands', {
                    templateUrl: '/js/app/brands/views/index.html',
                    controller: 'BrandController'
                })
                .when('/brands/create',{
                    templateUrl:'/brands/form-create',
                    controller: 'BrandController'
                })
                .when('/brands/edit/:id',{
                    templateUrl:'/brands/form-edit',
                    controller: 'BrandController'
                })  
            //----------------------------------------------------------------------
            .when('/warehouses', {
                    templateUrl: '/js/app/warehouses/views/index.html',
                    controller: 'WarehouseController'
                })
                .when('/warehouses/create',{
                    templateUrl:'/warehouses/form-create',
                    controller: 'WarehouseController'
                })
                
                .when('/warehouses/edit/:id',{
                    templateUrl:'/warehouses/form-edit',
                    controller: 'WarehouseController'
                }) 
                //-----------------------------------------------          
                .when('/stores', {
                    templateUrl: '/js/app/stores/views/index.html',
                    controller: 'StoreController'
                })
                .when('/stores/create',{
                    templateUrl:'/stores/form-create',
                    controller: 'StoreController'
                })
                .when('/stores/edit/:id',{
                    templateUrl:'/stores/form-edit',
                    controller: 'StoreController'
                })                
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
                .when('/products', {
                    templateUrl: '/js/app/products/views/index.html',
                    controller: 'ProductController'
                })
                .when('/products/create',{
                    templateUrl:'/products/form-create',
                    controller: 'ProductController'
                })
                .when('/products/edit/:id',{
                    templateUrl:'/products/form-edit',
                    controller: 'ProductController'
                })
                .otherwise({
                    redirectTo: '/'
                });
            $locationProvider.html5Mode(true);
        }]);

})();
