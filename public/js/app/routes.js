(function(){
    angular.module('routes',[])
        .config(['$routeProvider','$locationProvider', function ($routeProvider,$locationProvider) {
            $routeProvider
            // ------------------------------------------------------
            
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
                //RUTES CATEGORIAS
                .when('/categories', {
                    templateUrl: '/js/app/categories/views/index.html',
                    controller: 'CategoryController'
                })
                .when('/categories/create',{
                    templateUrl:'/categories/form-create',
                    controller: 'CategoryController'
                })
                .when('/categories/edit/:id',{
                    templateUrl:'/categories/form-edit',
                    controller: 'CategoryController'
                }) 
                //------------------
                //RUTES PRODUCTOS
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
                //------------------
                .otherwise({
                    redirectTo: '/'
                });
                
            $locationProvider.html5Mode(true);
        }]);

})();
